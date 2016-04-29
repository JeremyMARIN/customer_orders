<?php
include("include/check_session.php");
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
					Customer Order Page<br />
					<?php echo $_SESSION["firstname"]; ?>, please make your selections!
				</h3>
			</div>
		</header>

		<div id="content">
			<form action="customer_order_verification.php" method="post">
				<div id="list" class="panel round">
				
				</div>
				<div class="action-container one">
					<button type="submit" class="round green grow">Submit</button>
				</div>
			</form>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
		<script type="text/javascript" src="js/customer_order.js"></script>
	</body>
</html>