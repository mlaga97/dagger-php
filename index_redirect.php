<?php
session_start();
session_unset();

require_once('include/Mysql.php');
$membership = new Membership();

//include('include/log4php/Logger.php');
//Logger::configure('include/log4php/config.xml');
//$log = Logger::getLogger('myLogger');
//date_default_timezone_set('America/Chicago');$today = date('m-d-y h:i:s');

// Checking to see if the username and password were entered correctly.
if ($_POST && !empty($_POST['username']) && !empty($_POST['pwd']))
{
    $response = $membership->validate_User($_POST['username'], $_POST['pwd']);
    //$log->info("GRHOP: " . $today ." ". $_SERVER['REMOTE_ADDR'] ." ". $_POST['username']);
}
//print_r($_SESSION);
// Here we set our session previous variable. This variable is used to allow user access to the next web-page.
$_SESSION['previous'] = 'index.php';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
   
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="description" content="Brief Adult Assessment">
    <link rel="stylesheet" href="include/mystyle.css" type="text/css">
    <div id="top">
        <div id="header">
        <?php date_default_timezone_set('America/Chicago');$today = date('l jS \of F Y h:i:s A');print_r($today);?><br><br>
            <div id="title">
            <title>Login Page</title>
                <div id="logo">
                <table width = "400">
                                   
                    <?php
                // This is our logo array for the starting page.    
                    $logo_array = array( 
                        '<a href="https://www.usm.edu/social-work">  <img src="include/images/usm.png" style="border:solid; border-color:black;" width="100" height="100" alt="University of Southern Mississippi, School of Social Work"></a>',
                        '<a href="https://www.southalabama.edu/gcbhrc/">   <img src="include/images/usa.png" style="border:solid; border-color:black;" width="100" height="100" alt="University of Southern Alabama,     School of Social Work"></a>',
                        '<a href="https://uwf.edu/socialwork/">                           <img src="include/images/uwf.png" style="border:solid; border-color:black;" width="100" height="100" alt="University of West Florida,         School of Social Work"></a>'
                        );
                //This little piece of code shuffles our logo array. This allows random logo placement upon page refresh. 
                    shuffle($logo_array);           
                    foreach($logo_array as $string)
                    {
                        echo "<td> $string </td>";
                    }
                    ?>

                </table>         
                </div> <!-- div logo end -->
            </div><!-- div title end -->
        </div><!-- div header end -->
    </div><!-- div top end -->
 
    <body><!-- Our HTML body starts here. -->

        <form method="post" action=""><br><br><br>

        <h2>Login<br> <small> Enter your credentials</small></h2>

        <label for="name">Username:</label>
        <input type="text" autofocus="autofocus" name="username"/><br><br>
                          
        <label for="pwd">Password:</label>
        <input type="password" name="pwd" /><br><br>

        <input type="submit" id="submit" value="Login" name="submit" />               
                           
        </form>
        <?php if (isset($response)) echo "<br><hf class='alert'>" . $response. "</hf>"; ?>
        <footer><center><p> &copy; The University of Southern Mississippi <br> Funded by the Gulf Region Health Outreach Program, 2012</p></center></footer>
        <center><a href="https://www.lphi.org/home2/section/3-416/primary-care-capacity-project-"><img src="include/images/GRHOP.png" style="border:solid; border-color:black;" width="100" height="100" alt="G.R.H.O.P"></a></center>
    </body>                       
</html>



