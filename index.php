<?php

// Start the session
session_start();

include("include/check_session.php");

header("Location: customer_order.php"); // redirect the user to the order page

?>