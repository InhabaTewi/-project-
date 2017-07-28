<?php include "gsdb_main.php" ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
	<title>main page</title>
    <link rel="stylesheet" href="main.css"> </link>
</head>
<body>
	<div id="big_wrapper">
	<header id="top_header">
    	<h1>
        	 wellcome to ****shop page!
        </h1>
        <section id="shopping_Car">
        <a id="wellcomeuser">wellcome ###NAME</a>
        <img href="" src="shoppingCar.jpg"></img>
		
   		</section>
    </header>
    <nav id="top_menu">
    	<ul id="main-nav">
			<li><a href="">Home</a></li>
			<li><a href="">MyAccount</a>
            	<ul class="sub-nav">
			<li>
				<a href="">MyProfile</a>
			</li>
			<li>
				<a href="">Order</a>
			</li>
			<li>
				<a href="">Payment</a>
			</li>
			<li>
				<a href="">Address</a>
			</li>
				</ul>
            </li>
			<li><a href="">Support</a></li>
        </ul>
    </nav>
    <!--nav = main information-->
    <div id="new_div">
    <section id="main_section">
		<h1>Address Infomation</h1>
    Default Shipping Address:<br>
 	 <select name="shippingAddress" style="text" id="shippingAddress">
 		 <option value ="a1">-------------------1</option>
 		 <option value ="a2">-------------------2</option>
 		 <option value="a3">-------------------3</option>
 		 <option value="a4">-------------------4</option>
		</select> <br><button id="New_Shipping_Address">Change default shipping address</button>
		<button id="New_shipping_Address">modify this shiping address</button>
	<br>
    <div class="Shipping Address">
               	Shipping Address:<br>
              <input type="text" id="Street" placeholder="Street"><br>
                <input type="text" id="City" placeholder="City">
                <input type="text" id="State" placeholder="State">
              <input type="number" id="Zip" placeholder="zip code">
           		<br>
           		<button id="Save_All">
	   	UPDATE NEW INFORMATION         
	   </button>
	    <button id="RESET_ALL" type="reset">
	   	RESET       
	   </button>
            </div>
	
  
    </section>
    
    <aside id="side_news">
    	<h3>Options</h3>
        here are some special options.
		<button id="to_special_list"> Supplier specials!!!</button>
    </aside>
    </div>
    <footer id="the_footer">
    	coyeright for something 2016 by ****shop!
    </footer>
	</div>
</body>
</html>
