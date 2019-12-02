function validate(form) {

	$("#error").text("");
	if (!form["name-input"].value.trim()) {
		$("#error").text("No name entered.");
		window.alert("No name entered.");
		return false;
	}
	if (
		!form["email-input"].value.trim() ||
		!/^[^@]+@[^@]+\.[a-zA-Z]{2,}$/.test(form["email-input"].value.trim())
	) {
		$("#error").text("invalid or empty email.");
		window.alert("invalid or empty email.");
		return false;
	}
	if (!form["password-input"].value.trim()) {
		$("#error").text("No password entered.");
		window.alert("No password entered.");
		return false;
	}
	if (
		!form["date-input"].value.trim() ||
		!/^(18|19|20)\d\d[-/](0[1-9]|1[012])[-/](0[1-9]|[12][0-9]|3[01])$/g.test(
			form["date-input"].value.trim()
		)
	) {
		$("#error").text("invalid or empty date.");
		window.alert("invalid or empty date.");
		return false;
	}
	if (
		!form["number-input"].value.trim() ||
		!/^\d+(.\d+)?$/g.test(form["number-input"].value.trim())
	) {
		$("#error").text("No favorite number entered.");
		window.alert("No favorite number entered.");
		return false;
	}
	if (!form["starter-choice"].value.trim()) {
		$("#error").text("No starter choice chosen.");
		window.alert("No starter choice chosen.");
		return false;
	}
	if (!form["invalidCheck2"].checked) {
		$("#error").text("Checkbox not checked.");
		window.alert("Checkbox not checked.");
		return false;
	}
	return true;
}

("use strict");
window.addEventListener(
	"load",
	function() {
		// Fetch all the forms we want to apply custom Bootstrap validation styles to
		var forms = $(".needs-validation");
		// Loop over them and prevent submission
		var validation = Array.prototype.filter.call(forms, function(form) {
			form.addEventListener(
				"submit",
				function(event) {
					if (form.checkValidity() === false) {
						event.preventDefault();
						event.stopPropagation();
					}
					form.classList.add("was-validated");
				},
				false
			);
		});
	},
	false
);
