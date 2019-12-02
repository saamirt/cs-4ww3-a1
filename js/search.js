let map;
// let pokestops = [];
let infoWindows = [];

function getDistance(loc1, loc2) {
	return google.maps.geometry.spherical.computeDistanceBetween(
		new google.maps.LatLng(loc1),
		new google.maps.LatLng(loc2)
	);
}

function initMap() {
	center_loc = JSON.parse(sessionStorage.getItem("location"));
	if (!center_loc || center_loc.lat == null || center_loc.lng == null) {
		center_loc = { lat: 43.260949, lng: -79.913004 };
	}

	map = new google.maps.Map(document.getElementById("map"), {
		center: center_loc,
		zoom: 16
	});

	pokestops.forEach(stop => {
		// let flightPath = new google.maps.Polyline({
		//   path: [center_loc, { lat: stop[2], lng: stop[3] }],
		//   geodesic: true,
		//   strokeColor: "#FF0000",
		//   strokeOpacity: 1.0,
		//   strokeWeight: 2
		// });

		// flightPath.setMap(map);

		stop["loc"] = { lat: parseFloat(stop[2]), lng: parseFloat(stop[3]) };

		stop["marker"] = new google.maps.Marker({
			position: stop["loc"],
			map: map,
			title: stop[1]
		});

		stop["marker"].addListener("click", function() {
			let contentString =
				'<div id="content" class="marker">' +
				'<div id="siteNotice">' +
				"</div>" +
				'<div id="bodyContent" class="marker__content text-center">' +
				`<a onclick="storeStop('${stop[1]}',${stop["loc"].lat},${stop["loc"].lng},'${stop["image"]}', '${stop["description"]}')" href="#">` +
				`<h5>${stop[1]}</h5>` +
				"</a>" +
				`<p>${formatLoc(stop["loc"])}</p>` +
				"</div>" +
				`<img class="marker__img" alt="PokeStop Image" src="${stop["image"]}" data-holder-rendered="true">` +
				"</div>";

			let infowindow = new google.maps.InfoWindow({
				content: contentString
			});

			closeInfoWindows();
			infoWindows.push(infowindow);
			infowindow.open(map, stop["marker"]);
		});
	});

	google.maps.event.addListener(map, "click", function(event) {
		closeInfoWindows();
	});
	let onMapChange = () => {
		center_loc = { lat: map.getCenter().lat(), lng: map.getCenter().lng() };
		// let results = [];
		// pokestops.forEach(i => {
		//   if (isWithinBounds(map, i.loc)) {
		//     results.push(i);
		//   }
		// });
		// if (results.length < 1) {
		//   fillCards(pokestops);
		// } else {
		//   fillCards(results);
		// }
		// fillCards(pokestops);
	};
	google.maps.event.addListener(map, "dragend", onMapChange);
	google.maps.event.addListener(map, "zoom_changed", onMapChange);
}

function isWithinBounds(map, loc) {
	let bounds = map.getBounds();
	// console.log(bounds.pa.g, bounds.ka.g);
	// console.log(loc.lat, loc.lng);
	// console.log(bounds.pa.h, bounds.ka.h);
	// console.log("\n\n");
	return (
		(((loc.lat >= bounds.pa.g && loc.lat <= bounds.pa.h) ||
			(loc.lat <= bounds.pa.g && loc.lat >= bounds.pa.h)) &&
			loc.lng >= bounds.ka.g &&
			loc.lng <= bounds.ka.h) ||
		(loc.lng <= bounds.ka.g && loc.lng >= bounds.ka.h)
	);
}

function closeInfoWindows() {
	infoWindows.forEach(infowindow => {
		infowindow.close();
	});
	infoWindows = [];
}

function formatDistance(dist) {
	if (dist > 1000) {
		return `${Math.round(dist / 10) / 100}km`;
	} else {
		return `${Math.round(dist)}m`;
	}
}

function formatLoc(loc) {
	return `${loc.lat}, ${loc.lng}`;
}

function storeStop(title, lat, lng, img, desc = "") {
	sessionStorage.setItem(
		"currentStop",
		JSON.stringify({ title, loc: { lat, lng }, img, desc })
	);
	window.location.href = "./pokestop.php";
	// window.location.href = `./pokestop.php?title=${title}&lat=${lat}&lng=${lng}&img=${img}&`;
}

function getLocation() {
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(showPosition);
	} else {
		alert("Geolocation is not supported by this browser.");
	}
}

function storeLocation(lat, lng) {
	sessionStorage.setItem("location", JSON.stringify({ lat, lng }));
}

function showPosition(position) {
	storeLocation(position.coords.latitude, position.coords.longitude);
	alert(
		`Latitude: ${position.coords.latitude}\nLongitude: ${position.coords.longitude}`
	);
	map.setCenter(
		new google.maps.LatLng(
			position.coords.latitude,
			position.coords.longitude
		)
	);
}

function submitForm(e) {
	e.preventDefault();
	storeLocation(null, null);
	return false;
}
