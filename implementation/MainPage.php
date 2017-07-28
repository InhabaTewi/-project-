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
		<input type="text" name="SEARCH" placeholder="search">
		<select name="itemType" style="text" id="typeSelect">
 		 <option value ="ti">food</option>
 		 <option value ="t2">office</option>
 		 <option value="t3">-------------------3</option>
 		 <option value="t4">-------------------4</option>
		</select>
		<button>Search</button><br><br>
		<h6>  </h6>
	<ul>

    <?php

    $products = $gsdb->searchProducts();

    //debug
    //print_r($products);

    if (!$products) {
        print "No products found";
    } else {
        for ($i = 0; $i < sizeof($products['PRODUCT_ID']); $i++) {
        ?>
                <dl>
                    <a href="ProductPage.php?product_id=<?php print $products['PRODUCT_ID'][$i]; ?>">
                    <dt><?php print $products['PNAME'][$i]?></dt>

                    <dd><img id="itemImg" href="" src="<?php

                    if (file_exists($products["IMAGE"][$i]))
                        print $products["IMAGE"][$i];
                    else
                        print "shoppingCar.jpg";

                    ?>"></img>
                    </a><?php print $products['DESCRIPTION'][$i]?></dd>
                </dl>
        <?php
        }
    }
    ?>
	</ul>
<h5></h5><br>
<button id="lastPageButton">LAST PAGE</button>
<button id="nextPageButton">NEXT PAGE</button><br>
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
