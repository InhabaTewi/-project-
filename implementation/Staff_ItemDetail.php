<?php include "gsdb_main.php" ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
	<title>main page</title>
	<style>
		#ChangeItem{
			float: right;
		}
	</style>
    <link rel="stylesheet" href="../user_Info_HTML/main.css"> </link>
</head>
<body>
	<div id="big_wrapper">
	<header id="top_header">
    	<h1>
        	 wellcome to ****shop page!
        </h1>
        <section id="shopping_Car">
        <a id="wellcomeuser">wellcome ###NAME</a>        </img>
		
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
				<a href="">Salary</a>
			</li>
			<li>
				<a href="">Address</a>
			</li>
				</ul>
            </li>
			<li><a href="">WareHouses</a></li>
       		<li>
				<a href="">Customers</a>
			</li>
       		<li>
				<a href="">Suppliers</a>
			</li>
       		
        </ul>
    </nav>
    <!--nav = main information-->
    <div id="new_div">
    <section id="main_section">
		<dt><input type="text" placeholder="ItemName" id="EditItemName"/><a2>Quantity</a2></dt>
				
				<dd><img id="DetailItemImg" href="" src="../user_Info_HTML/shoppingCar.jpg"></img>
				
				
				<input id="quantity" type="number"/>
				</dd>	
				
				price:<input id="EditPrice"><br>
				WareHouse:<input id="WareHouseInput"/>
				descriptions:<input id="EditDescriptions"/>
				
	<button id="ChangeItem">Save Chage</button>	
    </section>
</div>
    <footer id="the_footer">
    	coyeright for something 2016 by ****shop!
    </footer>
	</div>
</body>
</html>
