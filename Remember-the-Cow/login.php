<?php
/*
Nadia Kazi, CSE 190M, 
June 01, 2012, Section: MJ
The file accepts the user input password and username.
It checks if they are correct based on this it redirects the
user to another page. if either username/password is not passed it 
issues an error invalid request and exit.    
*/

session_start();

// throws an error if the username/ password is not passed correctly.
if(!isset($_POST["name"]) || !isset($_POST["password"])) { 
	header("HTTP/1.1 400 Invalid Request");
	die("An HTTP error 400 (invalid request) occurred."); // exits the page
}

$name = $_POST["name"];
$pw = $_POST["password"];

// if the username and password is correct it directs the user to the todolist page
// but otherwise directs it to the index page to relogin with username and password. 
if($name == "nadiak3" && $pw == "12345") {
	$_SESSION["name"] = $name;
	$_SESSION["password"] = $pw;
	header("Location: todolist.php");
} else {
	header("Location: index.php?name=$name&password=$pw");
}
?>