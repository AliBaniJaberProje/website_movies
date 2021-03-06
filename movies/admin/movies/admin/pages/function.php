<?php

function confirmQuery($query) {
    global $con;
    if (!$query) {
        die("QUERY FAILED" . " " . mysqli_error($con));
    }
}

function validation_input($data) {
    $data = trim($data);// emove spaces
    $data = stripslashes($data);//remove blackslashed
    $data = strip_tags($data); //Remove html tags
    return $data;
}

function is_Developer($username) { // true or false
    global $con;
    if (!$con) {
        include 'config/db.php';
    }
    $query = "SELECT user_type FROM users WHERE user_name ='$username'";
    $result = mysqli_query($con, $query);
    confirmQuery($result);
    $row = mysqli_fetch_array($result);
    if ($row['user_type'] == 'Developer') {
        return true;
    } else {
        return false;
    }
}

function is_Moderator($username) {
    global $con;
    if (!$con) {
        include 'config/db.php';
    }
    $query = "SELECT user_type FROM users WHERE user_name ='$username'";
    $result = mysqli_query($con, $query);
    confirmQuery($result);
    $row = mysqli_fetch_array($result);
    if ($row['user_type'] == 'Moderator') {
        return true;
    } else {
        return false;
    }
}


function valdiate_upload($name, $tmp_path, $path) {
    $error_array = array(); //Holds error messages

    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($name, PATHINFO_EXTENSION));

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        array_push($error_array, "Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
    }
    if (empty($error_array)) {
        move_uploaded_file($tmp_path, $path);
    } else {
        array_push($error_array, "Sorry, there was an error uploading your file.");
    }
    return $error_array;
}

function emailExists($email) {
    global $con;
    if (!$con) {
        include 'config/db.php';
    }
    $result = mysqli_query($con, "select user_id from users where user_email='$email'");
    confirmQuery($result);
    $count = mysqli_num_rows($result);
    if ($count > 0) {
        return true;
    } else {
        return false;
    }
}
