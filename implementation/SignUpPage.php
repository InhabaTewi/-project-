<?php include "gsdb_main.php" ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>User Sign Up</title>
	<style>
		h2 {text-align: center; letter-spacing: 12px; font-size: .2in;
		 color:black;
		text-transform: uppercase; width:auto
		}
		label {display: block; position: relative;line-height:normal; margin:20px;}
		span {color: red}
		fieldset{width: 350px; font-family: Arial;
		 color: black;
		margin: auto}
		input{position: absolute; margin-left: 20px; width: 12em; left: 100px}
		.placeButtons {position:relative; left:-10px; width: 70px}
	</style>
</head>

<body>
	<h2>Sign Up</h2>
	<form name="signup_form" action='doSignUp.php' method='post'>
		<fieldset>
			<lengend>
			</lengend>
			<label>Username: <input type="text" name="username"/><span>*</span></label>
			<label>Password: <input type="password" name="password"><span>*</span></label>
			<div align='center'><input  class="placeButtons" type="submit" value="Sign Up">
            <p><a href='MainPage.php'>Cancel</a></p>
		</fieldset>
	</form>



</body>
</html>
