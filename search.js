let x = document.getElementById("latlong");

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else {
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}

function storeLocation(lat, lng) {
  sessionStorage.setItem("location", JSON.stringify({ lat, lng }));
  window.location.href = "./search-results.php";
}

function showPosition(position) {
  x.innerHTML = `Latitude: ${position.coords.latitude}<br\>Longitude: ${position.coords.longitude}`;
  storeLocation(position.coords.latitude, position.coords.longitude);
  alert(
    `Latitude: ${position.coords.latitude}\nLongitude: ${position.coords.longitude}`
  );
}

function submitForm(e) {
  e.preventDefault();
  storeLocation(null, null);
  return false;
}
