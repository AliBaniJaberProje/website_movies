<?php

/*
 * Errors tags/notations:
 * 
 1 Error11 : first name must contains Letters only
 2 Error12 : first name must be between 5 and 20
 3 Error21 : last name must contains Letters only
 4 Error22 : last name must be between 5 and 20
 5 Error31 : email is invalid
 6 Error32 : email already registered
 7 Error41 : password must be between 8 and 22 and has at least 1 character
 */

$error_array = array();
$fname = $lname = $pass = $regEmail = "";
if (isset($_POST['register_user'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $pass = $_POST['password'];
    $regEmail = $_POST['email'];

    $fname = validation_input($fname);
    $lname = validation_input($lname);
    $pass = validation_input($pass);
    $regEmail = validation_input($regEmail);
    if (!ctype_alpha($fname)) {
        array_push($error_array, "Error11");
    }
    if (strlen($fname) < 5 || strlen($fname) > 20) {
        array_push($error_array, "Error12");
    }

    if (!ctype_alpha($lname)) {
        array_push($error_array, "Error21");
    }
    if (strlen($lname) < 5 || strlen($lname) > 20) {
        array_push($error_array, "Error22");
    }

    if (filter_var($regEmail, FILTER_VALIDATE_EMAIL)) {
        //Check if email is for the acc owner or not
        if (emailExists($regEmail)) {
            array_push($error_array, "Error32");
        }
    } else {
        array_push($error_array, "Error31");
    }
    if ($pass !== "") {
        if (strlen($pass) < 8 || strlen($pass) > 22) {
            array_push($error_array, "Error41");
        }
    }
    if (empty($error_array)) {
        //Generate username by concatenating first name and last name
        $username = $fname . "_" . $lname;
//        $check_username_query = mysqli_query($con, "SELECT user_name FROM users WHERE user_name='$username'");
//        $i = 0;
//        //if username exists add number to username
//        while (mysqli_num_rows($check_username_query) != 0) {
//            $i++; //Add 1 to i
//            $username = $username . "_" . $i;
//            $check_username_query = mysqli_query($con, "SELECT user_name FROM users WHERE user_name='$username'");
//        }
        //Profile picture assignment
        $profile_pic = "avatar5.png";
        confirmQuery(mysqli_query($con, "insert into users values (null,'$username','$pass','$profile_pic','$fname', '$lname', "
                        . "'$regEmail','Regular')"));
        array_push($error_array, "You're all set! Go ahead and login!");
        $fname = $lname = $pass = $regEmail = "";
    }
}
