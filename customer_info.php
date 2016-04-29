<?php

// Start the session
session_start();

include("include/helpers.php");

// If the request's method is POST
if (isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["nyu-id"])) {
	if ( checkInfo($_POST["firstname"], $_POST["lastname"], $_POST["nyu-id"]) ) {
		$_SESSION["firstname"] = $_POST["firstname"];
		$_SESSION["lastname"]  = $_POST["lastname"];
		$_SESSION["email"]     = $_POST["nyu-id"] . "@nyu.edu";
		header("Location: customer_order.php"); // redirect the user to front page
	}
}

?>

<html>
	<head>
		<title>Best Video Games eShop</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="css/main.css">
	</head>
	<body onload="init();">
		<header id="header">
			<div class="panel round">
				<h2 class="text-centered">Best Video Games Online Shop</h2>
				<h3 class="text-centered">Customer Info Page</h3>
			</div>
		</header>

		<div id="content" class="info">
			<div class="panel round">
				<form method="post">
					<div id="input-container">
						<table class="info">
							<tr>
								<td>
									<label for="firstname">Firstname: </label>
								</td>
								<td colspan="2">
									<input id="firstname" name="firstname" type="text" placeholder="Georges" />
								</td>
							</tr>
							<tr>
								<td>
									<label for="lastname">Lastname: </label>
								</td>
								<td colspan="2">
									<input id="lastname" name="lastname" type="text" placeholder="Washington" />
								</td>
							</tr>
							<tr>
								<td>
									<label for="nyu-id">NYU Email Addr: </label>
								</td>
								<td>
									<input id="nyu-id" name="nyu-id" type="text" placeholder="gw123" />
								</td>
								<td>
									@nyu.edu
								</td>
							</tr>
						</table>
					</div>
					<div class="action-container two">
						<button type="submit" class="round green grow">Continue to Order Page</button>
						<button type="reset" class="round orange grow">Reset</button>
					</div>
				</form>
			</div>
		</div>
	</body>
</html>