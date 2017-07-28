<?php
include "gsdb_main.php";
$location = "MainPage.php";

if (isset($_POST['session_user']) && isset($_POST['password'])) {
    $session_user = $_POST['session_user'];
    $password = $_POST['password'];

    if ($gsdb->startUserSession($session_user, $password)) {
        print "Login Successful.";
    } else {
        print "Login Failed!";
        $location = "LoginPage.php";
    }
}

print " Please wait for the page to redirect ...";
header( "Refresh:5; url=$location", true, 303);

?>