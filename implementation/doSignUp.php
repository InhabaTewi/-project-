<?php
include "gsdb_main.php";
$location = "MainPage.php";

if (isset($_POST['username']) && isset($_POST['password'])) {
    $session_user = $_POST['username'];
    $password = $_POST['password'];

    if ($gsdb->createUser($session_user, $password)) {
        $gsdb->startUserSession($session_user, $password);
        print "Sign Up successful.";
    } else {
        print "Sign Up failed.";
        $location = "SignUpPage.php";
    }
}

print " Please wait for the page to redirect ...";
header( "Refresh:5; url=$location", true, 303);

?>