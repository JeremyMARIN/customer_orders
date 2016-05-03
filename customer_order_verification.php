<?php
include("include/check_session.php");
include("include/helpers.php");

function getOrders($form) {
	$orders = array();

	foreach ($form as $key => $value) { // only keep ordered IDs
		if ($value == 1)
			$orders[] = $key;
	}

	return $orders;
}

function getList($orders) {
	$list = array();

	$fp = fopen("../inventory/inventory_db.csv", "r") or die("Can't open file 'inventory_db.csv'...");

	while (!feof($fp)) {
		$line = fgetcsv($fp, 1024);
		if (in_array($line[0], $orders))
			$list[] = array("id" => $line[0], "title" => $line[1], "file" => $line[2], "stock" => intval($line[3]), "price" => $line[4] );
	}

	fclose($fp) or die("Can't close file 'db.csv'...");

	return $list;
}

function getTotal($list) {
	$total = 0;

	foreach ($list as $game) {
		$total += $game["price"];
	}

	return $total;
}

function buildTableContent($list) {
	$total = getTotal($list);
	$tax = round($total * (8.875/100), 2);
	$grandTotal = $total + $tax;

	$tableHTML = 
		"<tr>
			<th colspan=\"2\">Item</th>
			<th>Price</th>
		</tr>";

	foreach ($list as $item) {
		$tableHTML .= 
		"<tr>
			<td><div class=\"picture-container\"><div class=\"picture\" style=\"background-image: url('../inventory/img/" . $item['file'] . "');\"></div></div></td>
			<td>" . $item["title"] . "</td>
			<td>$" . $item["price"] . "</td>
		</tr>";
	}

	$tableHTML .=
	"<tr>
		<td colspan=\"2\">Sub-Total</td>
		<td>$" . $total . "</td>
	</tr>
	<tr>
		<td colspan=\"2\">Sales Tax of 8.875%</td>
		<td>$" . $tax . "</td></td>
	</tr>
	<tr>
		<td colspan=\"2\">Grand Total</td>
		<td>$" . $grandTotal . "</td></td>
	</tr>";

	return $tableHTML;
}

function sendEmail($list) {
	$to = $_SESSION["email"];
	$subject = "[Best Video Games Online Shop] Hey " . $_SESSION["firstname"] . "!";
	
	$content = "<body style=\"background-image: url('http://i6.cims.nyu.edu/~jgm438/inventory/img/background.jpg'); background-size: cover;\">";
	$content .= "<div style=\"margin: auto; width: 80%; max-width: 400px; background-color: #eee; border-radius: 20px; padding: 0 16px;\">";
	$content .= "<h1>Your Command:</h1>";
	$content .= "<table style=\"width: 100%; margin: auto; text-align: center;\">" . buildTableContent($list) . "</table>";
	$content .= "<p style=\"text-align: right\">See you soon!</p>";
	$content .= "</div></body>";

	$headers = "Content-type: text/html; charset=utf-8\n";
	$headers .= "From: bestvideogames.onlineshop@nyu.edu\n";

	mail($to, $subject, $content, $headers);
}

$list = array();

if (count($_POST) > 0) {
	$orders = getOrders($_POST);
	$list = getList($orders);

	if (isset($_POST["confirm"])) {
		if (updateInventoryAfterOrder($orders)) {
			sendEmail($list);
			header("Location: customer_order_final.php"); // redirect the user to the final page
		}
	}
} else {
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
					Customer Order Verification
				</h3>
			</div>
		</header>

		<div id="content">
			<div class="panel round">
				<h4 class="text-centered">
					Thank you, 
					<?php echo $_SESSION["firstname"]; ?>, for your order!<br />
					Here is your total:<br />
					Please press "Confirm"
				</h4>
				<div>
					<table class="verification">
						<?php
							if (!empty($list))
								echo buildTableContent($list);
							else
								echo "An error occured...";
						?>
					</table>
				
				</div>
				<form method="post">
					<input type="hidden" name="confirm" />
					<div class="action-container one">
						<?php
							foreach ($orders as $value) {
								echo "<input type=\"hidden\" name=\"$value\" value=\"1\" />";
							}
						?>
						<button type="submit" class="round green grow">Confirm</button>
					</div>
				</form>
			</div>
		</div>
	</body>
</html>