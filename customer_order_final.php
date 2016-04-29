<?php
include("include/check_session.php");

if ($_POST <= 0) {
	echo "Bad request...";
	exit(0);
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
				<h3 class="text-centered">
					Customer Order Final
				</h3>
			</div>
		</header>

		<div id="content" class="final">
			<div class="panel round">
				<h4 class="text-centered">
					Thank you, <?php echo $_SESSION["firstname"]; ?>!<br /><br />
					Your order is on the way and a verification email has been sent to <?php echo $_SESSION["email"]; ?>.
				</h4>
			</div>
		</div>
	</body>
</html>

?>