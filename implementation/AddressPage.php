<?php include "gsdb_main.php" ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
	<title>Address Page</title>
    <link rel="stylesheet" href="main1.css"> </link>
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
    <?php
    if (!$gsdb->getLoggedOnUser()) {
        print "Please login to access your address settings.";
    } else {
        $street = "";
        $city = "";
        $state = "";
        $zip = "";
        $address_id = "";

        if (isset($_GET["address_id"]) && ($address = $gsdb->getAddress($_GET["address_id"]))) {
            $street = $address["STREET"][0];
            $city = $address["CITY"][0];
            $state = $address["STATE"][0];
            $zip = $address["ZIP"][0];
            $address_id = $address["ADDRESS_ID"][0];
        }
    ?>
    <div class="Shipping Address">
    <form action="doAddressUpdate.php" method="post">
        Shipping Address:<br>
      <input type="text" name="address_id" value="<?php print $address_id; ?>" style="display:none;"/>
      <input type="text" name="street" id="Street" value="<?php print $street; ?>" placeholder="Street"><br>
      <input type="text" name="city" id="City" value="<?php print $city; ?>" placeholder="City">
      <input type="text" name="state" id="State" value="<?php print $state; ?>" placeholder="State">
      <input type="text" name="zip" id="Zip" value="<?php print $zip; ?>" placeholder="zip code">
      <br>
      <br>
      <input type="checkbox" name="default" value="default" />
      This is the default shipping address
      <br>
      <br>
	  <input id="RESET_ALL" type="reset">
      <input type="submit" name="submit" value="Save">
    </form>
    </div>
    <?php
    }
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
