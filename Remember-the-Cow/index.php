<?php include("top.html"); ?>

<?php
/*
Nadia Kazi, CSE 190M, 
June 01, 2012, Section: MJ
The purpose of this file is to create an inital page for the remember
the cow site. This page displays a login form for the user to type in the
username and password and uses submit button to login to the site. The page
prints out an error massage if the user types the username or the password wrong.    
*/


include("shared.php");
// it calls the isParameterSet to checks if the username and the password is correct if so
// then it directs the page to the todolist page.
isParameterSet("todolist.php", isset($_SESSION["name"]), isset($_SESSION["password"])); 
?>

	<p>
		The best way to manage your tasks. <br />
		Never forget the cow (or anything else) again!
	</p>

	<p>
		Log in now to manage your to-do list:
	</p>

	<form id="loginform" action="login.php" method="post">
		<div>
			<input id="name" name="name" type="text" size="12" autofocus="autofocus" /> 
			<strong>User Name</strong></div>
		<div>
			<input id="password" name="password" type="password" size="12" />
			<strong>Password</strong></div>
		<div><input id="submitbutton" type="submit" value="Log in" /></div>
	</form>
	
	<?php if(isset($_GET["name"]) && isset($_GET["password"])) { 
		// prints out an error massage if the uername and/or password is wrong ?>
		<div id="login_error">Incorrect user name / password. Please try again.</div>			
	<? } ?>
</div>

<?php include("bottom.html"); ?>
