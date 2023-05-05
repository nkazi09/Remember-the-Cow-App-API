<?php
/*
Nadia Kazi
The purpose of this file is saving/loading the currect state of the user's to-do list   
*/

// it throws an HTTP 400 error and exit if a post is made to the  web service
// without the required parameter.
if($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST["todolist"])) { 
	header("HTTP/1.1 400 Invalid Request");
	die("An HTTP error 400 (invalid request) occurred.");
}

$list = "list.json";
// on a post request it doesnt produce any output to the web service
if($_SERVER["REQUEST_METHOD"] == "POST") {
	file_put_contents($list, $_POST["todolist"]);
}

// if the file exist it prints the list to the webservice
if(file_exists($list)) {
	print file_get_contents($list, FILE_IGNORE_NEW_LINES);
}
?>
