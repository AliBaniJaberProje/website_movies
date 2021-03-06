<?php
include 'config/init.php';// handllers & classes &
$currentObj = $loggedIn = "";

if (isset($_SESSION['role']) && isset($_SESSION['username'])) {
    switch ($_SESSION['role']) {

        case 'Developer':
			$currentObj = new Moderator($con, $_SESSION['username']);// as  developer
            break;

        case 'Regular' :
            $currentObj = new Person($con, $_SESSION['username']);
            break;
    }
    $loggedIn = $_SESSION['username'];
    //echo $loggedIn;
    //die();
}
//$result = mysqli_query($con, "select setting_status, setting_period from settings where setting_type='Maintenance'");
//$row = mysqli_fetch_array($result);
//$Maintenance = $row['setting_status'];
//$time = '';
//if (!isset($_COOKIE['role']) || $_COOKIE['role'] == "Regular" ) {
//    if ($Maintenance == 'ON') {
//        $time = $row['setting_period'];
//        include 'config/settings/maintenance.php';
//        die();
//    }
//}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Define Charset -->
        <meta charset="utf-8"/>
        <!-- Page Title -->
        <title>YourMovies</title>
        <!-- Responsive Metatag -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <!-- global colors -->
        <style>
            :root {
                --para-color: #8da5b9;
                --head-color: #dde6ed;
                --login-bg: #204562;
                --slider-color-responsive: #fff;
                /*******************************/
                --header-bg: rgba(22,40,54,0.9);
                --header-bg-hover: #162836;
                --header-elements-color: #000;
                /*******************************/
                --movies-list-bg: #04111f;
                /*******************************/
                --widget-elements-bg: #000;
                /*******************************/
                --pricing-bg: #04111f;
                /*******************************/
                --footer-bg: #0f283e;
                --footer-elements-color: #000;
                
            }
        </style>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <!-- CSS -->
        <link rel="stylesheet" href="css/vendors/bootstrap.min.css">

        <!-- Font icons -->
        <link rel="stylesheet" href="css/vendors/fontello.css" >

        <!-- Owl Carousel -->
        <link rel="stylesheet" href="js/vendors/owl-carousel/owl.carousel.css">
        <link rel="stylesheet" href="js/vendors/owl-carousel/owl.theme.css">

        <!-- Animate.css -->
        <link rel="stylesheet" href="css/vendors/animate.css">

        <!-- Custom CSS -->
        <link rel="stylesheet" href="css/styles.css" />
        <!-- Custom Media-Queties -->
        <link rel="stylesheet" href="css/media-queries.css" />

        <!-- Player -->
        <link rel='stylesheet' id='amy-movie-style-css'  href='css/myStyle.css' type='text/css' media='all' />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">

    </script>
    <div id="preloder">
        <div class="loader"></div>
    </div>



