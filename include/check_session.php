<?php

// Start the session
session_start();

if ( !(isset($_SESSION["firstname"]) && isset($_SESSION["lastname"]) && isset($_SESSION["email"])) )
	header("Location: customer_info.php"); // redirect the user to the info page

?>