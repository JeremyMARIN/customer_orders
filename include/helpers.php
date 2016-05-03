<?php

function checkInfo($firstname, $lastname, $nyu_id) {
	if ( (strlen($firstname) < 1) || (strlen($lastname) < 1) ) {
		return false;
	}
	if (!preg_match("#^[a-zA-Z]{2,}\d+$#", $nyu_id)) {
		return false;
	}
	return true;
}

// updates is an array of IDs corresponding to the items that have been ordered
function updateInventoryAfterOrder($updates) {
	$inventory = array();

	// open the file for reading
	$fp = fopen("../inventory/inventory_db.csv", "r") or die("Can't open file '../inventory/inventory_db.csv' for reading...");

	while (!feof($fp)) {
		$line = fgetcsv($fp, 1024);
		$id = $line[0];

		if ($id != null) {  // check if the line is not an empty line
			if (in_array($id, $updates)) // if the item is ordered
				$line[3]--; // decrement the stock
			$inventory[] = $line;
		}
	}

	fclose($fp) or die("Can't close file '../inventory/inventory_db.csv'...");


	// open the file for writing
	$fp = fopen("../inventory/inventory_db.csv", "w") or die("Can't open file '../inventory/inventory_db.csv' for writing...");

	foreach ($inventory as $value) {
		fputcsv($fp, $value); // write the updated value
	}

	fclose($fp) or die("Can't close file '../inventory/inventory_db.csv'...");

	return true;
}

?>