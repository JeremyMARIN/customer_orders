function init() {
	var listContent = document.getElementById("list");

	displayList(listContent);
}

function displayList(listContent) {
	var xhr = new XMLHttpRequest();

	xhr.open("GET", "../inventory/inventory.php");

	xhr.addEventListener("readystatechange", function() {
		if (xhr.readyState == 4 && xhr.status == 200) {
			processListData(xhr.responseText, listContent);
			addOrderButtons();
		} else if (xhr.readyState == 4) {
			listContent.innerHTML = "Error " + xhr.status + ".";
		}
	}, false);

	xhr.send();
}

function processListData(data, listContent) {
	var formatedData = ""; // HTML formated data

	data = JSON.parse(data);

	for (var i = 0, length = data.length; i < length; i++) {
		console.log(data[i]);
		if (data[i].title != null && data[i].file != null && data[i].stock != null && data[i].price != null) {
			var line = "";
			if (i % 4 == 0) // every 4 games, start a new row
				line += "<div class=\"row\">";

			line += "<div class=\"game\">";
			line += "<div class=\"game-container radius\"><div>";
			if (data[i].stock == 0)
				line += "<div class=\"picture sold-out\"></div>";
			line += "<div class=\"picture ";
			if (data[i].stock == 0)
				line += "gray";
			line += "\" style=\"background-image: url('../inventory/img/" + data[i].file + "');\"></div>";
			line += "</div><div class=\"information radius\" data-id=\"" + data[i].id + "\" data-stock=\"" + data[i].stock + "\" >";
			line += "<h4 class=\"title\">" + data[i].title + "</h4>";
			line += "<h5 class=\"price\">$" + data[i].price + "</h5>";
			line += "<input type=\"hidden\" name=\"" + data[i].id + "\" value=\"0\"></input>";
			line += "</div></div></div>";

			if (i % 4 == 3) // close the row
				line += "</div>";

			formatedData += line;
		} else {
			console.log("Problem with: " + data[i].title);
		}
	}

	listContent.innerHTML = formatedData;
}

function addOrderButtons() {
	var informationDivs = $(".information");
	// console.log(informationDivs);
	for (var i = 0, max = informationDivs.length; i < max; i++) {
		if ($(informationDivs[i]).data("stock") > 0) {
			var button = $("<button>", {
				text: "Order",
				type: "button",
				class: "radius green grow",
				click: function() {
					if ($(this).hasClass("green")) {
						console.log("Ordering product of id: " + $(this).parent().data("id"));
						$(this).removeClass("green").addClass("red");
						$(this).text("In Cart");
						$(this).parent().find("input").val(1);
					} else {
						console.log("Unordering product of id: " + $(this).parent().data("id"));
						$(this).removeClass("red").addClass("green");
						$(this).text("Order");
						$(this).parent().find("input").val(0);
					}
				}
			});
			console.log(informationDivs[i]);
			$(informationDivs[i]).append(button);
		}
	}
}