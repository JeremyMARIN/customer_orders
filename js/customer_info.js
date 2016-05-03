function checkForm() {
	var message = "";

	var firstname = document.forms["info"]["firstname"].value;
	var lastname = document.forms["info"]["lastname"].value;
	var nyuId = document.forms["info"]["nyu-id"].value;

	var regex = /^[a-zA-Z]{2,}\d+$/;

	if (firstname == null || firstname == "")
		message += "Firstname required.\n";
	if (lastname == null || lastname == "")
		message += "Lastname required.\n";
	if (nyuId == null || nyuId == "")
		message += "NYU ID required.\n";
	else if (!regex.test(nyuId))
		message += "NYU ID invalid.\n";

	if (message != "") {
		alert(message);
		return false;
	}
}