<?php
include "gsdb_main.php";
$location = "MainPage.php";

if (isset($_POST["order_id"])) {
    $order_id = $_POST["order_id"];
    $address_id = $_POST["address_id"];
    //$gsdb->updateOrderAddress($order_id, $address_id);
    $gsdb->updateOrderStatus($order_id, "paid");
    $gsdb->updateBalance($gsdb->session_user_id, $gsdb->getOrderTotal($order_id));
    print "Order has been submitted.";
}

print " Please wait for the page to redirect ...";
header( "Refresh:5; url=$location", true, 303);

?>