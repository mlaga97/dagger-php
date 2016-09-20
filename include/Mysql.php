<?php
// Though we are not yet using the log, it has been included.
openlog("MSIHDP", LOG_PID, LOG_USER);
require_once'constants.php';

//This class will allow for easy connection to Mysql
class Mysql 
{
    private $conn;

    function __construct()
    {
        $this->conn = new mysqli(DB_SERVER,DB_USER,DB_Password,DB_NAME)
        or die('There was a problem connecting to the database.');
    }

    function verify_Username_and_Pass($un, $pwd)
    {
        $query = "SELECT id,university_id, clinic_id, admin, grouping, test_acc FROM users WHERE uname =  ?  AND pswd =  ?  AND active = 1 LIMIT 1";
        $query_logo = "SELECT logo FROM university WHERE id =  ? LIMIT 1";
        if($stmt = $this->conn->prepare($query))
        {           
            $stmt->bind_param( 'ss', $un, $pwd);
            $stmt->execute();
            $stmt->bind_result($id_copy, $university_id, $clinic_id, $admin, $grouping, $test_acc);
            if ($stmt->fetch())
            {
                $_SESSION['user_id']   = $id_copy;
                $_SESSION['clinic_id'] = $clinic_id;
                $_SESSION['admin']     = $admin;
                $_SESSION['university_id'] = $university_id;
                $_SESSION['grouping'] = $grouping;
                $_SESSION['test_acc'] = $test_acc;
                $stmt->close();
                if($stmt = $this->conn->prepare($query_logo))
                {    
                    $stmt->bind_param( 's', $university_id);
                    $stmt->execute();
                    $stmt->bind_result($_SESSION['logo']);
                    ($stmt->fetch());
                    $stmt->close();
                }
                return TRUE;
            }
        }
    }
}

closelog();

// Our Membership class is called in index.php whenever we sign into the initial code. It is being used hand in hand with the Mysql class to verify the user. 
class Membership
{
    function validate_user ($un, $pwd) 
    {
        $mysql = New Mysql();

        if(isset($_SESSION['id']))
        {
            $value = $_SESSION['id'];
        }

        $ensure_credentials = $mysql->verify_Username_and_Pass($un,$pwd);

        if($ensure_credentials)
        {
            $_SESSION['status'] = 'authorized';
            header("location: include/options.php");
            
        } 

        else 
        {
           return "Please enter a correct username and password.";
        }
    }


    function confirm_Member()
    {
       session_start();
       if($_SESSION['status'] !='authorized'){
        header("location: ../index.php");
        die("Authentication required, redirecting");
       } 
    }
}

?>
