<?php
ob_start();

require_once('../fns/profile_handler.php');

	$errors = array();
	$valid = array();
	$response = array();

    # Retrieving values ----------------------------------------------------------------------------------------------*/
    # Check if user entered their name
    if(isset($_POST['name']))
    {
        $name = $_POST['name'];
        $valid["name"] = $name;
    }

    # Check if user entered their surname
    if(isset($_POST['surname']))
    {
        $surname = $_POST['surname'];
        $valid["surname"] = $surname;
    }

	# User Name validation
	if(!$_POST['user_name'])
	{
		$errors['user_name'] = "Please enter your preferred user name";
	}
	else
	{
		$user_name = $_POST['user_name'];
		echo $user_name;
		$valid["user_name"] = $user_name;
	}

    #Email
    if(!$_POST["email"])
    {
        //echo "Please enter your date of birth <br/>";
        $errors['email'] = "Please enter your email.";
    }
    else
    {
        $email = $_POST["email"];
        $valid["email"] = $email;
    }

    #Password Validation
    if(!$_POST['password'])
    {
        $errors['password'] = "Please enter password";
    }
    else
    {
        $password = $_POST['password'];
        echo $password;

        if(!$_POST['password_confirm'])
        {
            $errors['password_confirm'] = "Please verify your password";
        }
        else
        {
            $pword = $_POST['password_confirm'];
            $compare = strcmp ($password , $pword);

            if($compare == 0) # if the strings match
            {
                $password = $_POST['password'];
                $valid["password"] = "password valid";
            }
            else
            {
                $errors['mismatch'] = "Passwords don't match";
            }
        }
    }

	#Gender
	if(!$_POST["gender"])
	{
		echo "no gender <br/>";
	}
	else
	{
		$gender = $_POST["gender"];
		$valid["gender"] = $gender;
	}

	#DOB
    if(isset($_POST["day_of_birth"]))
    {
        $day_of_birth = $_POST["day_of_birth"];
    }
    if(isset($_POST["month_of_birth"]))
    {
        $month_of_birth = $_POST["month_of_birth"];
    }
    if(isset($_POST["year_of_birth"]))
    {
        $year_of_birth = $_POST["year_of_birth"];
    }

	if($_POST["day_of_birth"] == "Select day" || $_POST["month_of_birth"] == "Select month" || $_POST["year_of_birth"] == "Select year")
	{
		$errors['dob'] = "Please enter your date of birth";
	}



    # Error Handling -------------------------------------------------------------------------------------------------*/
	echo "<br/> <b>This is the POST count: ". count($_POST) ."</b><br/>";

    //var_dump($_POST);

	$response["valid"] = $valid;
	$response["errors"] = $errors;

	if(count($errors) == 0)
	{
        $profile = new profile_handler();

        if($profile->check_user_profile(EMAIL, $email)) # check if email already exists in database
        {
            $feedback = "This email has already been registered";
        }
        else if($profile->check_user_profile(USER_NAME, $user_name)) # check if user's name already exists in the database
        {
            $feedback = "The user name '".$user_name."' has already been taken";
        }
        else
        {
            # Concatenate date of birth
            $dob = $year_of_birth."-".$month_of_birth."-".$day_of_birth;

            $feedback = "success";

            # save newly registered user
            $profile->register_user($user_name, $name, $surname, $email, $password, $dob, $gender);

            echo "<b>CONGRATS! NO ERRORS</b><br>";

            session_start();

            $_SESSION['user_email'] = $email;

            $url = "../register.php?registration_success=" . urlencode($feedback);
        }
	}
	else
	{
		echo "<b>Error count: ". count($errors) ."</b>";
       // var_dump($errors);

        echo "<b>Valid count: ". count($valid) ."</b>";
       // var_dump($valid);

		$url = "../register.php?registration=" . urlencode(serialize($response));
	}

    echo "<b>Return: </b><br>";
   // var_dump($response);

    echo "<b>URL: </b>";
    //var_dump($url);

	header("Location: ". $url);

ob_flush();
?>