function validate(form) {
	$("#error").text("");
	$("#error").css("visibility", "visible");
	if (!form["firstname"].value.trim()) {
		console.log("No first name entered.");
		$("#error").text("No first name entered.");
		window.alert("No first name entered.");
		return false;
	}
	if (!form["lastname"].value.trim()) {
		console.log("No last name entered.");
		$("#error").text("No last name entered.");
		window.alert("No last name entered.");
		return false;
	}
	if (
		!form["email"].value.trim() ||
		!/^[^@]+@[^@]+\.[a-zA-Z]{2,}$/.test(form["email"].value.trim())
	) {
		console.log("invalid or empty email.");
		$("#error").text("invalid or empty email.");
		window.alert("invalid or empty email.");
		return false;
	}
	if (!form["password"].value.trim()) {
		console.log("No password entered.");
		$("#error").text("No password entered.");
		window.alert("No password entered.");
		return false;
	}
	if (
		!form["birthdate"].value.trim() ||
		!/^(18|19|20)\d\d[-/](0[1-9]|1[012])[-/](0[1-9]|[12][0-9]|3[01])$/g.test(
			form["birthdate"].value.trim()
		)
	) {
		console.log("invalid or empty date.");
		$("#error").text("invalid or empty date.");
		window.alert("invalid or empty date.");
		return false;
	}
	if (
		!form["number-input"].value.trim() ||
		!/^\d+(.\d+)?$/g.test(form["number-input"].value.trim())
	) {
		console.log("No favorite number entered.");
		$("#error").text("No favorite number entered.");
		window.alert("No favorite number entered.");
		return false;
	}
	if (!form["starter-choice"].value.trim()) {
		console.log("No starter choice chosen.");
		$("#error").text("No starter choice chosen.");
		window.alert("No starter choice chosen.");
		return false;
	}
	if (!form["invalidCheck2"].checked) {
		console.log("Checkbox not checked.");
		$("#error").text("Checkbox not checked.");
		window.alert("Checkbox not checked.");
		return false;
	}
	$("#error").css("visibility", "hidden");
	return true;
}
