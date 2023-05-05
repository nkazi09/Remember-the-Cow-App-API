<?php
/*
Nadia Kazi
This file contains any shared PHP code or function
used by multiple other file.
*/

session_start();

// it takes a url, username and password as parameter and redirect
// the page to the given url.
function isParameterSet($url, $name, $password) {
	if($name && $password) {
		header("Location: $url");
		die();
	} 
}
?>
