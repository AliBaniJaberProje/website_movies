<?php
$email = $pass = $errorLogin = "";
if (isset($_POST['signIn'])) {
    $email = validation_input($_POST['user-email']);
    $pass = validation_input($_POST['user-pass']);
    $result = mysqli_query($con, "call login('$email','$pass');");//proc
    confirmQuery($result);
    $row = mysqli_fetch_array($result);
    if ($row['username'] !== "NAN") {
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];
            mysqli_close($con);
    }
    else {
    $errorLogin = "Password or Email is incorrent";
    }
    $con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
}
