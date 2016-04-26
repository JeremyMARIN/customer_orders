<?php

function checkInfo($firstname, $lastname, $nyu_id) {
	if ( (strlen($firstname) < 1) || (strlen($lastname) < 1) ) {
		return false;
	}
	if (!preg_match("#^\w{2,}\d+$#", $nyu_id)) {
		return false;
	}
	return true;
}

?>