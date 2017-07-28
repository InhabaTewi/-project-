<?php include "gsdb_main.php" ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
	<title>main page</title>
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
    <section id="main_section"><br>
     <form id="basicInfo">
  		Supplier Name:<br>
  		<input type="text" name="Supplier">
  			<br>
 		 Description:<br>
 	 <input type="text" name="Description"><br>	
	</form>
    <br>
   	Product:<br>
  		<select name="Product" style="text" id="Product">
 		 <option value ="a1">----product Name + product Price + Quantity----1</option>
 		 <option value ="a2">-------------------2</option>
 		 <option value="a3">-------------------3</option>
 		 <option value="a4">-------------------4</option>
		 </select>
     <button id="DeleteNewProducts">Delete this Products</button>
		<button id="AddNewProducts">Add New Products</button>
     <button id="">Edit This Products</button>
      
      
      <br>
      <br>
      
     <button id="Save_All">
	   	UPDATE ALL INFORMATION         
	   </button>
	    <button id="RESET_ALL" type="reset">
	   	RESET       
	   </button>
</section>
</div>
    <footer id="the_footer">
    	coyeright for something 2016 by ****shop!
    </footer>
	</div>
</body>
</html>
