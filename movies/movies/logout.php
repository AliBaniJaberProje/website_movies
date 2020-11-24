<?php
include 'config/init.php';
unset($_SESSION['role']);
unset($_SESSION['username']);
session_unset();
header("Location: index.php");
exit();
