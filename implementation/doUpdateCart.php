<?php
include "gsdb_main.php";
$location = "Cart.php";

/*
Iterate each product
Get the product id and quantity
Delete the product from cart
Add to cart with the new quantity
Repeat for next product
*/
if (!$gsdb->getLoggedOnUser()) {
    print "You must log in before updating the cart.";
} else {

    $cart = $gsdb->getCart($gsdb->session_user_id);

    $product_quantities = array();

    foreach ($_POST as $name => $quantity) {
        $temp = explode("-", $name);
        if (isset($temp[0]) && isset($temp[1])) {
            $product_quantities []= array($temp[1], $quantity);
        }
    }

    //print "cart: " . print_r($cart, true);

    foreach($product_quantities as $row) {
        //print print_r($product_quantities, true) . "<br/>";
        $gsdb->removeOrderProduct($cart["ORDER_ID"][0], $row[0]);
        if ($row[1] != "0")
            $gsdb->addOrderProduct($cart["ORDER_ID"][0], $row[0], $row[1]);
    }

    print "Cart updated successfully.";
}

print " Please wait for the page to redirect ...";
header( "Refresh:5; url=$location", true, 303);

?>