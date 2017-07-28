<?php include "gsdb_main.php" ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
	<title>Cart Page</title>
    <link rel="stylesheet" href="main.css"> </link>
</head>
<body>
	<div id="big_wrapper">
	<header id="top_header">
    	<h1>
        	 Welcome To Our Store
        </h1>
        <section id="shopping_Car">
        <a id="wellcomeuser">Welcome

        <?php

            if ($gsdb->getLoggedOnUser())
                print $gsdb->getLoggedOnUser();
            else
                print "Guest";

        ?>!</a>


        <?php

        if (!$gsdb->getLoggedOnUser()) {
            ?><a href='LoginPage.php'>Login</a>
            <?php
        } else {
            ?><a href='doLogout.php'>Logout</a>
            <?php
        }
        ?>
        <!-- <button href="" id="loginButton_mainPage">Login</button> -->
        <a href="Cart.php">
        <?php

        if ($gsdb->getLoggedOnUser()) {
            $cart = $gsdb->getCart($gsdb->session_user_id);

            if (is_array($cart)) {
                $order_id = $cart["ORDER_ID"][0];

                $num_items = $gsdb->getNumOrderItems($order_id);

                print "( $num_items ) ";
            }
        }
        ?>
        <img id="carImg" href="" src="shoppingCar.jpg" align="middle"></img>
        </a>

   		</section>
    </header>
     <nav id="top_menu">
    	<ul id="main-nav">
			<li><a href="MainPage.php">Home</a></li>
			<li><a href="">MyAccount</a>
            	<ul class="sub-nav">
			<li>
				<a href="UserPage.php?user_id=<?php print $gsdb->session_user_id; ?>&role=<?php print $gsdb->session_user_role; ?>">My Profile</a>
			</li>
			<li>
				<a href="OrderPage.php">Orders</a>
			</li>
			<li>
				<a href="PaymentPage.php">Payment</a>
			</li>
			<li>
				<a href="AddressPage.php">Address</a>
			</li>
				</ul>
            </li>
			<li><a href="SupportPage.php">Support</a></li>
        </ul>
    </nav>
    <!--nav = main information-->
    <div id="new_div">
    <section id="main_section">
			<h1>Shopping Car</h1>
    <?php

        if (!$gsdb->getLoggedOnUser()) {
            print "Please log in to access your shopping cart.";
        } else {
    ?>
    <form action="CheckoutPage.php" method="post">
    <ul id="OrderItems">
    <?php
            $cart = $gsdb->getCart($gsdb->session_user_id);

            if (!is_array($cart)) {
                print "No items in the cart.";
            } else {
                $orderproducts = $gsdb->listOrderProducts($cart["ORDER_ID"][0]);
                $cartsize = 0;
                if (is_array($orderproducts) && count($orderproducts["ORDER_ID"]) != 0)
                    $cartsize = count($orderproducts["ORDER_ID"]);

                for ($i = 0; $i < $cartsize; $i++) {

    ?>
            <dl id="OneOrderItems">

				<dt><?php print $orderproducts["PNAME"][$i]; ?> <a2>Quantity</a2>
				</dt>

				<dd>
                <a href="ProductPage.php?product_id=<?php print $orderproducts["PRODUCT_ID"][$i]; ?>">
                <img id="OrderProductImg" href="somewhere" src="<?php

                    if (file_exists($orderproducts["IMAGE"][$i]))
                        print $orderproducts["IMAGE"][$i];
                    else
                        print "shoppingCar.jpg";

                    ?>"></img>
                    </a>
                    <a id="OrderItemPrice">Price: $<?php print $orderproducts["PRICE"][$i]?></a>
                    <!--<input type="checkbox" name="vehicle" value="Bike" id="carItemCheckBox">-->
                    <input name="product_id-<?php print $orderproducts["PRODUCT_ID"][$i]; ?>" id="quantity" type="number" value="<?php print $orderproducts["QUANTITY"][$i]; ?>"/>
         			 <br>
	         </dd>
			</dl>

    <?php
                    } // for
            } // else
    ?>
	</ul>
			<div id="bottomButtons">
				<input type="submit" formaction="doUpdateCart.php" id="CheckSellect" value="Apply Updates" />
				<input type="submit" id="DeleteSellect" value="Checkout" /><br>
			</div>
    </form>
    <?php
    } // else
    ?>
    </section>
    <aside id="side_news">
    	<h3>Options</h3>
        here are some special options.
		<button id="to_special_list"> Supplier specials!!!</button>
    </aside>
    </div>
</div>
</body>
</html>
