<?php 
/*
Nadia Kazi, CSE 190M, 
June 01, 2012, Section: MJ
The purpose of this page is to allow the user create an todolist 
and allows the user to add/remove items as desired from the list.
*/
include("top.html");
include("shared.php");
 
// it calls the it isParameterSet so that it prohibits the user from entering directly to
// the todolist page without loging in.
isParameterSet("index.php", !isset($_SESSION["name"]), !isset($_SESSION["password"]));
?>
		
	<h2><?= $_SESSION["name"] ?>'s To-Do List</h2>

	<ul id="todolist"></ul>
	<div id="buttons">
		<input id="itemtext" type="text" size="30" autofocus="autofocus" />
		<button id="add">Add to Bottom</button>
		<button id="delete">Delete Top Item</button>
	</div>
	
	<ul>
		<li><a href="logout.php">Log Out</a></li>
	</ul>
</div>

<?php include("bottom.html"); ?>
