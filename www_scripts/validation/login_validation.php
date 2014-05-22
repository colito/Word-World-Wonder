<?php
ob_start();
require_once('../fns/profile_handler.php');

   # Declaring the necessary variables -------------------------------------------------------------------------------*/
    $errors = array();
    $valid = array();
    $response = array();

    $profile = new profile_handler();


   # Retrieving values -----------------------------------------------------------------------------------------------*/
    if(!empty($_POST["email"]))
    {
        $email = $_POST["email"];
        $valid["email"] = $email;
    }
    else
    {
        $errors["email"] = "Please enter your email";
    }

    if(!empty($_POST["password"]))
    {
        $password = $_POST["password"];
    }
    else
    {
        $errors["password"] = "Please enter your password";
    }


   # Matching user input against database ----------------------------------------------------------------------------*/
    if($profile->check_user_profile(EMAIL, $email))
    {
        if($profile->check_user_password($password))
        {
            # log the user in:---------------------*/
            # create session
            session_start();
            $_SESSION['user_email'] = $email;

            var_dump($_SESSION['user_email']);

            # redirect to home page
            header("Location: ../index.php");

            echo "You have successfully logged in!";
        }
        else
        {
            $errors[0] = "Invalid email or password";
        }
    }
    else
    {
        $errors[0] = "Invalid email or password";
    }


   # Send feedback if any errors are found ---------------------------------------------------------------------------*/
    if(count($errors) >= 1)
    {
        if(empty($errors[0]))
        {
            $errors[0] = "There are errors!";
        }
        $response["valid"] = $valid;
        $response["errors"] = $errors;
        $url = "../login.php?login=" . urlencode(serialize($response));
        header("Location: ".$url);
    }

ob_flush();
?>
