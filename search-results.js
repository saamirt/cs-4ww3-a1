let map;
let pokestops = [
	{
		title: "University at Life Sciences",
		loc: { lat: 43.260891, lng: -79.918625 },
		img: "./public/pokestops/pokestop1.png",
		desc:
			"Bus stop outside the Life Sciences building towards the John Hodgins Engineering building."
	},
	{
		title: "Health Sciences Entrance",
		loc: { lat: 43.260274, lng: -79.918101 },
		img: "./public/pokestops/pokestop2.png",
		desc:
			"Entrance to Health Sciences building facing towards Life Sciences building."
	},
	{
		title: "Willy Dog",
		loc: { lat: 43.262887, lng: -79.918727 },
		img: "./public/pokestops/pokestop3.png",
		desc:
			"Hot Dog stand outside McMaster University Student Centre and Mills Memorial Library."
	},
	{
		title: "East Meets West Bistro",
		loc: { lat: 43.262418, lng: -79.922495 },
		img: "./public/pokestops/pokestop4.png",
		desc:
			"International restaurant-style dining featuring multicultural cuisine inside the Mary Keyes building."
	},
	{
		title: "Arts Quad",
		loc: { lat: 43.263992, lng: -79.917618 },
		// img: "https://live.staticflickr.com/7032/6700062117_108029f569_b.jpg",
		img: "./public/pokestops/pokestop5.png",
		desc:
			"Paved area located between the McMaster University Student Centre, Kenneth Taylor Hall, and Togo Salmon Hall."
	},
	{
		title: "Dalewood Recreation Centre",
		loc: { lat: 43.258357, lng: -79.912333 },
		// img:
		//   "https://www.brookfieldpropertiesretail.com/content/dam/ggp-digital-assets/Images/Mall-Images/Exteriors/baybrook-hero-04.jpg/_jcr_content/renditions/original.jpg",
		img: "./public/pokestops/pokestop6.png",
		desc:
			"Community recreation centre located near the Westdale area on Main st."
	},
	{
		title: "Dough Box Wood Fired Pizza",
		loc: { lat: 43.257474, lng: -79.924041 },
		// img:
		//   "https://www.dubai-online.com/wp-content/uploads/2012/05/ss_790728556.jpg",
		img: "./public/pokestops/pokestop7.png",
		desc:
			"Hot Dog stand outside McMaster University Student Centre and Mills Memorial Library."
	},
	{
		title: "Lazeez Shawarma",
		loc: { lat: 43.261548, lng: -79.906421 },
		// img:
		//   "https://imagevars.gulfnews.com/2019/08/16/190816-dubai-mall-dinosaur_16c9b186c33_large.jpg",
		img: "./public/pokestops/pokestop8.png",
		desc:
			"Middle Eastern fast-food restaurant located in the Westdale area."
	},
	{
		title: "OneZo Tapioca",
		loc: { lat: 43.261359, lng: -79.906909 },
		// img:
		//   "https://squareonelife.com/wp-content/uploads/2015/06/kariya-park-square-one-condos-downtown-mississauga-condos.jpg",
		img: "./public/pokestops/pokestop9.png",
		desc:
			"Bubble Tea restaurant in the Westdale area known for making their own tapioca pearls."
	}
];

// pokestops.forEach((i, j) => {
// 	// console.log("INSERT INTO `pokestopdb`.`pokestops` (`pokestopID`, `title`, `latitude`, `longitude`, `description`) VALUES ('" + j + "', '" + i.title + "', " + i.loc.lat + ", " + i.loc.lng + ", '" + i.desc + "');")
// 	console.log(
// 		"INSERT INTO `pokestopdb`.`reviews` (`reviewID`, `pokestopID`, `title`, `rating`, `text`, `author`, `created_at`) VALUES ('" +
// 			(j * 3 + 0) +
// 			"', '" +
// 			j +
// 			"', 'Best PokeStop Ever!', '5', 'This is the best pokestop I have ever been to. I have yet to go to other PokeStops but surely this one is the best. I wanna be the very best Like no one ever was To catch them is my real test To train them is my cause I will travel across the land Searching far and wide Teach Pokemon to understand The power that\\'s inside Pokemon! Gotta catch \\'em all It\\'s you and me I know it\\'s my destiny Pokemon! Oh, you\\'re my best friend In a world we must defend', 'PokemonGoUser123', NOW());"
// 	);
// 	console.log(
// 		"INSERT INTO `pokestopdb`.`reviews` (`reviewID`, `pokestopID`, `title`, `rating`, `text`, `author`, `created_at`) VALUES ('" +
// 			(j * 3 + 1) +
// 			"', '" +
// 			j +
// 			"', 'Worse PokeStop Ever', '5', 'This is the worst pokestop I have ever been to. I have yet to go to other PokeStops but surely this one is the best. I wanna be the very best Like no one ever was To catch them is my real test To train them is my cause I will travel across the land Searching far and wide Teach Pokemon to understand The power that\\'s inside Pokemon! Gotta catch \\'em all It\\'s you and me I know it\\'s my destiny Pokemon! Oh, you\\'re my best friend In a world we must defend', 'saamirt', NOW());"
// 	);
// 	console.log(
// 		"INSERT INTO `pokestopdb`.`reviews` (`reviewID`, `pokestopID`, `title`, `rating`, `text`, `author`, `created_at`) VALUES ('" +
// 			(j * 3 + 2) +
// 			"', '" +
// 			j +
// 			"', 'Pretty Good PokeStop', '5', 'This is the most okay pokestop I have ever been to. I have yet to go to other PokeStops but surely this one is the best. I wanna be the very best Like no one ever was To catch them is my real test To train them is my cause I will travel across the land Searching far and wide Teach Pokemon to understand The power that\\'s inside Pokemon! Gotta catch \\'em all It\\'s you and me I know it\\'s my destiny Pokemon! Oh, you\\'re my best friend In a world we must defend', 'ashketchum', NOW());"
// 	);
// });

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

	fillCards(pokestops);

	map = new google.maps.Map(document.getElementById("map"), {
		center: center_loc,
		zoom: 16
	});

	pokestops.forEach(stop => {
		// let flightPath = new google.maps.Polyline({
		//   path: [center_loc, stop.loc],
		//   geodesic: true,
		//   strokeColor: "#FF0000",
		//   strokeOpacity: 1.0,
		//   strokeWeight: 2
		// });

		// flightPath.setMap(map);

		stop["marker"] = new google.maps.Marker({
			position: stop.loc,
			map: map,
			title: stop.title
		});

		stop["marker"].addListener("click", function() {
			let contentString =
				'<div id="content" class="marker">' +
				'<div id="siteNotice">' +
				"</div>" +
				'<div id="bodyContent" class="marker__content text-center">' +
				`<a onclick="storeStop('${stop["title"]}',${stop["loc"].lat},${stop["loc"].lng},'${stop["img"]}', '${stop["desc"]}')" href="#">` +
				`<h5>${stop["title"]}</h5>` +
				"</a>" +
				`<p>${formatLoc(stop["loc"])}</p>` +
				"</div>" +
				`<img class="marker__img" alt="PokeStop Image" src="${stop["img"]}" data-holder-rendered="true">` +
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
		fillCards(pokestops);
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
			loc.lng >= bounds.ka.g && loc.lng <= bounds.ka.h) ||
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

function fillCards(pokestops) {
	$("#search-cards").empty();
	pokestops.sort((a, b) => {
		return getDistance(center_loc, a.loc) - getDistance(center_loc, b.loc);
	});
	pokestops.forEach(stop => {
		card =
			'<div class="col-lg-4 d-flex align-items-stretch">' +
			`    <a onclick="storeStop('${stop["title"]}',${stop["loc"].lat},${stop["loc"].lng},'${stop["img"]}', '${stop["desc"]}')" href="#" class="pokestop-card card card--clickable mb-4 shadow--sm">` +
			'        <img class="card-img-top img--search" alt="PokeStop Image"' +
			`            src="${stop["img"]}"` +
			'            data-holder-rendered="true">' +
			"        <!-- each card has some temporary hardcoded text to show what it may look like -->" +
			'        <div class="card-body">' +
			'           <div class="d-flex justify-content-between">' +
			`               <h5 class="card-title card-title--ellipsis">` +
			`                   ${stop["title"]}` +
			`               </h5>` +
			`               <h6>` +
			`                   <span class="badge badge-light badge--gray">` +
			`                       ${formatDistance(
				getDistance(center_loc, stop["loc"])
			)}` +
			`                   </span>` +
			`               </h6>` +
			"            </div>" +
			`            <p class="card-text">${stop["desc"]}</p>` +
			"        </div>" +
			`        <div class="card-footer text-muted">` +
			`          Added 10 days ago` +
			`        </div>` +
			"    </a>" +
			"</div>";

		$("#search-cards").append(card);
	});
}

function storeStop(title, lat, lng, img, desc = "") {
	sessionStorage.setItem(
		"currentStop",
		JSON.stringify({ title, loc: { lat, lng }, img, desc })
	);
	window.location.href = "./pokestop.html";
	// window.location.href = `./pokestop.html?title=${title}&lat=${lat}&lng=${lng}&img=${img}&`;
}
