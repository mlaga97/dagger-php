<?php
session_start();

require_once('log4php/Logger.php');
Logger::configure('log4php/config.xml');
$log = Logger::getLogger('myLogger');
date_default_timezone_set('America/Chicago');$today = date('m-d-y h:i:s');

foreach($_POST as $key=>$value) 
{
    if (($key != 'status') && ($key != 'previous'))
    {
        $_SESSION[$key] = $value;
    }
}

if ($_SESSION['status'] != 'authorized' ) 
{
    header("location:../index.php");
    die("Authentication required, redirecting");
}
$_SESSION['previous'] = 'options.php';
//print_r($_SESSION);
$log->info("OPTIONS LOG: " . $today ." ". $_SERVER['REMOTE_ADDR'] ." ".  print_r($_SESSION, true));
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
    <head>
        <title>
            Welcome
        </title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="description" content="Brief Adult Assessment">
        <link rel="stylesheet" href="mystyle.css" type="text/css">
    </head>
    <body onload="clearForm();">
          <?php
    include 'menu.php';
    write_menu();
?>
        <div id="container">
            <div id="top">
                <div id="logo">
                    <?php echo $_SESSION['logo'] ?><!--Pulling string from the database-->
                </div><!-- div logo end -->
                <div id="header">
                </div><!-- div header end -->
                </div><!-- end div top -->  

        <br>
      
        <center>
            <h1>Welcome</h1>
            <p>Please make your selection from the menu at the top of the page.</p>
            
        </center>
        <br><br><br>
    </html>

       <center><footer><p> &copy; The University of Southern Mississippi <br> Funded by the Gulf Region Health Outreach Program, 2012</p></footer></center>
        <center><a href="https://www.lphi.org/home2/section/3-416/primary-care-capacity-project-"><img src="images/GRHOP.png" style="border:solid; border-color:black;" width="100" height="100" alt="G.R.H.O.P"></a></center>
