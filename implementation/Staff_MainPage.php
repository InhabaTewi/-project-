<?php include "gsdb_main.php" ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
	<title>main page</title>
    <link rel="stylesheet" href="../main.css"> </link>
</head>
<body>
	<div id="big_wrapper">
	<header id="top_header">
    	<h1>
        	 wellcome to ****shop page!
        </h1>
        <section id="shopping_Car">
        <a id="wellcomeuser">wellcome +"jobtitle"+ ###NAME</a>
        <button href="" id="loginButton_mainPage">Login</button>
</img>
		
   		</sectopn>
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
			<dl id="AItem">		
				<dt>item name 1</dt>
				
				<dd><img id="itemImg" href="" src="../shoppingCar.jpg"></img>descriptions
		<button id="EditThisItem" href="">EDIT</button>
				</dd>
			</dl>
			<dl id="AItem">	
				<dt>item name 2</dt>
				<dd><img id="itemImg" href="" src="../shoppingCar.jpg"></img>descriptions
				<button id="EditThisItem" href="">EDIT</button></dd>
			</dl>
			<dl id="AItem">		
				<dt>item name 3</dt>
				
				<dd><img id="itemImg" href="" src="../shoppingCar.jpg"></img>descriptions
				<button id="EditThisItem" href="">EDIT</button></dd>
			</dl>
			<dl id="AItem">	
				<dt>item name 4</dt>
				<dd><img id="itemImg" href="" src="../shoppingCar.jpg"></img>descriptions
				<button id="EditThisItem" href="">EDIT</button></dd>
			</dl>
		<dl id="AItem">		
				<dt>item name 5</dt>
				
				<dd><img id="itemImg" href="" src="../shoppingCar.jpg"></img>descriptions
				<button id="EditThisItem" href="">EDIT</button></dd>
			</dl>
			<dl id="AItem">	
				<dt>item name 6</dt>
				<dd><img id="itemImg" href="" src="../shoppingCar.jpg"></img>descriptions
				<button id="EditThisItem" href="">EDIT</button></dd>
			</dl>
			<dl id="AItem">			
				<dt>item name 7</dt>
				
				<dd><img id="itemImg" href="" src="../shoppingCar.jpg"></img>descriptions
				<button id="EditThisItem" href="">EDIT</button></dd>
			</dl>
			<dl id="AItem">	
			<dl id="lastItem">
				<dt>item name 8</dt>
				<dd class="last"><img id="itemImg" href="" src="../shoppingCar.jpg"></img>descriptions
				<button id="EditThisItem" href="">EDIT</button></dd>
			</dl>
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
