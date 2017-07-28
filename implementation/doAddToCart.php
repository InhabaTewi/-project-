<?php
include "gsdb_main.php";
$location = "MainPage.php";

/*
Check if logged in
Check if an order exists, if not, create one
Get the order id
Check if the record exists in order products, if so delete it
Insert a new record for order_products with the updated quantity
*/
if (!$gsdb->getLoggedOnUser()) {
    print "You must log in before adding items to the cart.";
} else if (!isset($_POST["product_id"]) || !isset($_POST["quantity"])) {
    print "Invalid form information.";
} else {

    $product_id = $_POST["product_id"];
    $quantity = $_POST["quantity"];

    $cart = $gsdb->getCart($gsdb->session_user_id);

    if (is_array($cart))
        $order_id = $cart["ORDER_ID"][0];
    else {
        $gsdb->log("Creating new order ... " . print_r($cart, true));
        $order_id = $gsdb->createOrder($gsdb->session_user_id);
    }

    //$gsdb->log("Order ID: $order_id");
    $gsdb->removeOrderProduct($order_id, $product_id);

    if ($quantity != "0") {
        $gsdb->log("$order_id, $product_id, $quantity");
        if ($gsdb->addOrderProduct($order_id, $product_id, $quantity))
            print "Cart updated successfully.";
        else
            print "Cart update failed.  Check debug log.";

    }

}

print " Please wait for the page to redirect ...";
header( "Refresh:5; url=$location", true, 303);

?>