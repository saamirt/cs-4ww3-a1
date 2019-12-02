function getLocation() {
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(showPosition);
	} else {
		alert("Geolocation is not supported by this browser.");
	}
}

function showPosition(position) {
	$("#latitude").val(position.coords.latitude);
	$("#longitude").val(position.coords.longitude);
}
