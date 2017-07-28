<?php include "gsdb_main.php" ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
	<title>Payments Page</title>
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
        print "Please login to access your payment settings.";
    } else {
        $num = "";
        $exp = "";
        $ccv = "";
        $name = "";
        $creditcard_id = "";

        if (isset($_GET["creditcard_id"]) && ($creditcard = $gsdb->getCreditcard($_GET["creditcard_id"]))) {
            $street = $creditcard["CC_NUM"][0];
            $exp = $creditcard["CC_EXP"][0];
            $ccv = $creditcard["CC_CCV"][0];
            $name = $creditcard["CC_NAME"][0];
            $creditcard_id = $creditcard["CREDITCARD_ID"][0];
        }
    ?>
    <div class="Shipping Address">
    <form id="cardInfo" action="doPaymentsUpdate.php" method="post">
    <input type="text" name="creditcard_id" style="display:none;" value="<?php print $creditcard_id; ?>" />
  		Name On Card: <br>
  		<input type="text" name="cc_name" value="<?php print $name; ?>" /><br>
  		CreditCard Number: <br>
  		<input type="text" name="cc_num" value="<?php print $num; ?>" /><br>

	   CVV:(3 or 4 digits usually found on the signature strip)
       <div class="cvv-input">
           <input type="text" name="cc_ccv" placeholder="CVV" value="<?php print $ccv; ?>" /><br>
      </div>
  		Expiration: <br>
  		<input type="text" name="cc_exp" value="<?php print $exp; ?>" /><br>
      <br />
      <br />
      Billing Address:
      <br />
    <select name="billing_address" style="text" id="shippingAddress">
    <?php
        $user_id = $gsdb->session_user_id;
        $addresses = $gsdb->listAddresses($user_id);
        $billing_address = $gsdb->getAddress($creditcard_id);

        //print "test" . print_r($addresses, true);
        //print $_GET["user_id"];
        if (is_array($addresses) && count($addresses["ADDRESS_ID"]) != 0) {
            for ($i = 0; $i < count($addresses["ADDRESS_ID"]); $i++) {
                print "<option value='" . $addresses["ADDRESS_ID"][$i] . "' ";

                if (is_array($billing_address) && $billing_address["ADDRESS_ID"][0] == $addresses["ADDRESS_ID"][$i])
                    print "selected";
                print ">" . $addresses["STREET"][$i]
                    . " " . $addresses["CITY"][$i]
                    . " " . $addresses["STATE"][$i]
                    . " " . $addresses["ZIP"][$i] . "</option>\n";
            }
        }

    ?>
    </select>
    <br>
    <br>
    <input type="submit" name="submit" value="Save"/>
	</form>

    </div>
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
