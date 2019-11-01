function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else {
    alert("Geolocation is not supported by this browser.");
  }
}

function showPosition(position) {
  $("#latitude-input").val(position.coords.latitude);
  $("#longitude-input").val(position.coords.longitude);
}