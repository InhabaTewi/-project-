<?php
include "gsdb_main.php";
$location = "MainPage.php";

if (isset($_POST['password']) && isset($_POST['password_confirm'])) {
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    $user_id = $_POST["user_id"];
    $user_role = $_POST["user_role"];

    if ($password != $password_confirm) {
        print "Passwords didn't match -- passwords not changed.";
    } else if ($gsdb->updateUserPassword($user_id, $user_role, $password)) {
        print "Password change successful.";
    } else {
        print "Password change failed.";
        //$location = "SignUpPage.php";
    }
}

print " Please wait for the page to redirect ...";
header( "Refresh:5; url=$location", true, 303);

?>