<?php

include 'config/db.php';
include 'function.php'; //includes helpful functions
include 'includes/classes/User.php'; // includes user class
$loggedIn = $_SESSION['username'];
$currentObj = "";
$moderator = new Moderator($con, $loggedIn); //create object
if (!is_Developer($loggedIn)) {//  prevent  regular user to acees the control panel
    header("Location: ../../index.php");
}
if (!isset($_SESSION['username']) && !isset($_SESSION['role'])) {
    header("Location: ../../index.php");
}

