let map;
let pokestop = JSON.parse(sessionStorage.getItem("currentStop"));
let infoWindows = [];

populateStop();

function populateStop() {
  $("#pokestop-title").text(pokestop.title);
  $("#pokestop-loc").text(formatLoc(pokestop.loc));
}

function initMap() {
  map = new google.maps.Map(document.getElementById("map"), {
    center: pokestop.loc,
    zoom: 16
  });

  pokestop = JSON.parse(sessionStorage.getItem("currentStop"));
  console.log(pokestop);

  let marker = new google.maps.Marker({
    position: pokestop.loc,
    map: map,
    title: pokestop.title
  });

  let contentString =
    '<div id="content" class="marker">' +
    '<div id="siteNotice">' +
    "</div>" +
    '<div id="bodyContent" class="marker__content text-center">' +
    `<h5>${pokestop.title}</h5>` +
    `<p>${formatLoc(pokestop["loc"])}</p>` +
    "</div>" +
    `<img class="marker__img" alt="PokeStop Image" src="${pokestop.img}" data-holder-rendered="true">` +
    "</div>";

  let infowindow = new google.maps.InfoWindow({
    content: contentString
  });

  marker.addListener("click", function() {
    infowindow.open(map, marker);
  });

  google.maps.event.addListener(map, "click", function(event) {
    infowindow.close();
  });
}

function formatLoc(loc) {
  return `Latitude: ${loc.lat}, Longitude: ${loc.lng}`;
}
