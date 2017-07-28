<?php include "gsdb_main.php" ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
	<title>Main Page</title>
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

            $products = $gsdb->searchProducts();
            if (!isset($_GET["product_id"]) || !isset($products["PRODUCT_ID"][intval($_GET['product_id'])])) {
                print "Invalid product ID";
            } else {
                $product_id = intval($_GET['product_id']);
        ?>
		<dt><?php print $products["PNAME"][$product_id]; ?></dt>

				<dd><img id="DetailItemImg" href="" src="<?php

                if (file_exists($products["IMAGE"][$product_id]))
                    print $products["IMAGE"][$product_id];
                else
                    print "shoppingCar.jpg";

                ?>" width="200"></img><br />
                <?php print $products["DESCRIPTION"][$product_id]; ?> <br />
        <form action="doAddToCart.php" method="post">
		<a id="DetailPrice">Price: $<?php print $products["PRICE"][$product_id]; ?></a><br />
        <input type="text" name="product_id" value="<?php print $product_id; ?>" style="display:none;"/>
        Quantity: <input name="quantity" id="quantity" type="number" value="0" />
				</dd>
        <input id="AddToCar" type="submit" value="ADD TO CART" />
        </form>

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
