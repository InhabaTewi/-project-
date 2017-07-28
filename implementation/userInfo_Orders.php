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
        <img href="somewhere" src="shoppingCar.jpg"></img>
		
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
		<h1>MyOrder</h1>
		<a>Order Number: ###############</a>
    <ul id="OrderItems">
			<dl id="OneOrderItems">		
				<dt>item name 1</dt>
				
				<dd><img id="OrderProductImg" href="somewhere" src="shoppingCar.jpg"></img>
						<a id="OrderItemStatus"> shipping</a><a id="OrderItemPrice">$1000</a>
		        </dd>
		        
			</dl>
			<dl id="OneOrderItems">		
				<dt>item name 2</dt>
				
				<dd><img id="OrderProductImg" href="somewhere" src="shoppingCar.jpg"></img>
						<a id="OrderItemStatus"> shipping</a><a id="OrderItemPrice">$1000</a>
		        </dd>
		        
			</dl>
			<dl id="OneOrderItems">		
				<dt>item name 3</dt>
				
				<dd><img id="OrderProductImg" href="somewhere" src="shoppingCar.jpg"></img>
						<a id="OrderItemStatus"> shipping</a><a id="OrderItemPrice">$1000</a>
		        </dd>
		        
			</dl>
			<dl id="OneOrderItems">		
				<dt>item name 4</dt>
				
				<dd><img id="OrderProductImg" href="somewhere" src="shoppingCar.jpg"></img>
						<a id="OrderItemStatus"> shipping</a><a id="OrderItemPrice">$1000</a>
		        </dd>
		        
			</dl>
			<dl id="OneOrderItems">		
				<dt>item name 5</dt>
				
				<dd><img id="OrderProductImg" href="somewhere" src="shoppingCar.jpg"></img>
						<a id="OrderItemStatus"> shipping</a><a id="OrderItemPrice">$1000</a>
		        </dd>
		        
			</dl>
	</ul>
			<div id="PageButtons">
			<button id="lastPageButton">LAST PAGE</button>
			<button id="nextPageButton">NEXT PAGE</button><br>	
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
