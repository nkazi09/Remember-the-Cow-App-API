<?php
/*
Nadia Kazi
This page allows the user to logout, the page gets redirect to the main page
whcih is the index page.  
*/

session_start();
session_destroy();	// erases the old session	
session_regenerate_id(TRUE);   # flushes out session ID number
session_start();	// starts a new session
header("Location: index.php");	// redirects the logout user to the index.php
?>
