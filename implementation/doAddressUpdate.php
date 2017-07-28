<?php
include "gsdb_main.php";
$location = "UserPage.php?user_id=" . $gsdb->session_user_id . "&role=" . $gsdb->session_user_role;

if (!$gsdb->getLoggedOnUser() || !isset($_POST["address_id"])) {
    $location = "MainPage.php";
} else {
    $street = $_POST["street"];
    $city = $_POST["city"];
    $state = $_POST["state"];
    $zip = $_POST["zip"];
    $address_id = $_POST["address_id"];
    $default = false;
    $user_id = $gsdb->session_user_id;

    $result = $gsdb->addAddress($user_id, $address_id, $street, $city, $state, $zip);

    if ($result === "" ) {
        print "Error adding the address. ";
    } else if (isset($_POST["default"]) && $_POST["default"] == "default") {
        $gsdb->setPreferredAddress($user_id, $result);
        print("Updated profile with default address.");
    } else {
        print "Updated profile addresses.";
    }

    //print_r(array($user_id, $address_id, $street, $city, $state, $zip));
}

print " Please wait for the page to redirect ...";
header("Refresh:5; url=$location", true, 303);

?>