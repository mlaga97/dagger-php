<?php

require 'Mysql.php';

class Membership
{
    function validate_user ($un, $pwd) 
    {
        $mysql = New Mysql();

        // I chose to send the password to the database without md5 hash and use the password() function in mysql. Let the database do the hash.
        // $ensure_credentials = $mysql->verify_Username_and_Pass($un,md5($pwd));
        if (isset($_SESSION['status'])){
            unset($_SESSION['status']); //This will prevent someone from setting status to 'authorized' from index.php
        }

        if(isset($_SESSION['id']))
        {
            $value = $_SESSION['id'];
        }

        $ensure_credentials = $mysql->verify_Username_and_Pass($un,$pwd);
        if($ensure_credentials)
        {
            $_SESSION['status'] = 'authorized';
            header("location: options.php");
        } 
        else 
        {
            return "Please enter a correct username and password";
        }
    }

    function log_User_Out()
    {
        if(isset($_SESSION['status']))
        {
          //  unset($_SESSION['status']);
          //  session_destroy();
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