<?php
include "gsdb_main.php";
$location = "UserPage.php?user_id=" . $gsdb->session_user_id . "&role=" . $gsdb->session_user_role;

if (!$gsdb->getLoggedOnUser() || !isset($_POST["creditcard_id"])) {
    $location = "MainPage.php";
} else {
    $creditcard_id = $_POST["creditcard_id"];
    $cc_name = $_POST["cc_name"];
    $cc_num = $_POST["cc_num"];
    $cc_ccv = $_POST["cc_ccv"];
    $cc_exp = $_POST["cc_exp"];
    $billing_address_id = $_POST["billing_address"];
    $user_id = $gsdb->session_user_id;

    $result = $gsdb->addPayment($user_id, $creditcard_id, $cc_name, $cc_num, $cc_ccv, $cc_exp, $billing_address_id);

    if ($result === "" ) {
        print "Error adding the stored payment. ";
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