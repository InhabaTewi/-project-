<?php include "gsdb_main.php" ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
	<title>User Page</title>
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
            print "Unable to display user info.  Please log in.";
        } else if (!isset($_GET['user_id']) || !isset($_GET['role'])) {
            print "Invalid user info";
        } else {
            $userinfo = $gsdb->getUserInfo($_GET['user_id'], $_GET['role']);

            if (!$userinfo) {
                print "Error - Invalid user info.";
                exit;
            } else if ($_GET['role'] == "staff") {
                $username = $userinfo['SNAME'][0];
            } else if ($_GET['role'] == "customer") {
                $username = $userinfo['CNAME'][0];

            }

    ?>

    <form action="doUpdateUser.php" method="post">
 	 <input type="text" name="user_id" style="display:none" value="<?php print $_GET["user_id"]; ?>">
 	 <input type="text" name="user_role" style="display:none" value="<?php print $_GET["role"]; ?>">

     Name:<br>

  	<input type="text" name="name" value="<?php print $username; ?>"><br>
 		 Password:<br>
 	 <input type="password" name="password"><br>
 	 	Confirm Password:<br>
 	 <input type="password" name="password_confirm"><br>


     <?php
        if ($_GET['role'] == "customer") {
     ?>
        <br>
        <h2>Saved Payment Methods: (click to update)</h2>
        <a href="PaymentPage.php">[ Add New Creditcard ]</a><br />
        <?php
            $creditcards = $gsdb->listCreditcards($gsdb->session_user_id);

            if (is_array($creditcards) && count($creditcards["CREDITCARD_ID"])) {
            for ($i = 0; $i < count($creditcards["CREDITCARD_ID"]); $i++) {
                     print "<a href='CreditcardPage.php?creditcard_id=".$creditcards["CREDITCARD_ID"][$i]."'>[ "
                        . $creditcards["CC_NAME"][$i] . " "
                        . $creditcards["CC_NUM"][$i] . " "
                        . " ]</a><br>";
            }
        ?>
        </select>

     <?php
            } // if
        } // if
     ?>

    <br>
    <h2>Saved Addresses: (click to update)</h2>
        <a href="AddressPage.php">[ Add New Address ]</a><br />
        <?php
            $addresses = $gsdb->listAddresses($gsdb->session_user_id);

            if (is_array($addresses) && count($addresses["ADDRESS_ID"])) {
                 for ($i = 0; $i < count($addresses["ADDRESS_ID"]); $i++) {
                     print "<a href='AddressPage.php?address_id=".$addresses["ADDRESS_ID"][$i]."'>[ "
                        . $addresses["STREET"][$i] . " "
                        . $addresses["CITY"][$i] . " "
                        . $addresses["STATE"][$i] . " "
                        . $addresses["ZIP"][$i] . " "
                        . " ]</a><br>";
                 }
            }
        ?>
    <br>
    <br>
    <?php
        if ($gsdb->session_user_role == "customer") {
    ?>
    <h2>Account Balance: $<?php print $gsdb->getAccountBalance($gsdb->session_user_id); ?></h2>
    <?php
        } // if
    ?>
    <br>
    <br>
	   <input id="Save_All" type="submit" value="UPDATE">
	    <button id="RESET_ALL" type="reset">
	   	RESET
	   </button>
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
