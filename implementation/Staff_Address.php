<?php include "gsdb_main.php" ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
	<title>main page</title>
	<style>
		#AddressInput{
			margin-left: 23%;
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
		<h1>Address Infomation</h1>
    <br>
    <br>
    <br>
    <div class="Shipping Address">
               <div id="AddressInput">
				<input type="text" id="Street" placeholder="Street"><br>
                <input type="text" id="City" placeholder="City">
                <input type="text" id="State" placeholder="State">
              <input type="number" id="Zip" placeholder="zip code">
           		<br>
           		<br>
           		<br>
		</div>
           		<br>
           		<br>
           		<button id="Save_All">
	   	UPDATE NEW INFORMATION         
	   </button>
	    <button id="RESET_ALL" type="reset">
	   	RESET       
	   </button>
            </div>
	
  
    </section>
</div>
    <footer id="the_footer">
    	coyeright for something 2016 by ****shop!
    </footer>
	</div>
</body>
</html>
