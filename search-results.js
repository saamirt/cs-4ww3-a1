let map;
let pokestops = [
  {
    title: "University at Life Sciences",
    loc: { lat: 43.260891, lng: -79.918625 },
    img: "./public/pokestops/pokestop1.png"
  },
  {
    title: "Health Sciences Entrance",
    loc: { lat: 43.260274, lng: -79.918101 },
    // img:
    //   "https://www.homesinhamiltonontario.com/account/2b7e81c6291f26fe/pages/134502_17.jpg",
    img: "./public/pokestops/pokestop2.png"
  },
  {
    title: "Willy Dog",
    loc: { lat: 43.262887, lng: -79.918727 },
    // img:
    //   "https://cdn.hpm.io/wp-content/uploads/2019/08/22150125/IMG_1186-1000x562.jpg",
    img: "./public/pokestops/pokestop3.png"
  },
  {
    title: "East Meets West Bistro",
    loc: { lat: 43.262418, lng: -79.922495 },
    // img:
    //   "http://static1.squarespace.com/static/5605ab7ee4b0d59ead0d6e68/5616b80fe4b036a0b93c1939/57361fa307eaa0bc96fcdc3d/1496368931528/toronto-premium-outlets-38308e481552ab9ad83ced7596690acf.jpg?format=1500w",
    img: "./public/pokestops/pokestop4.png"
  },
  {
    title: "Arts Quad",
    loc: { lat: 43.263992, lng: -79.917618 },
    // img: "https://live.staticflickr.com/7032/6700062117_108029f569_b.jpg",
    img: "./public/pokestops/pokestop5.png"
  },
  {
    title: "Dalewood Recreation Centre",
    loc: { lat: 43.258357, lng: -79.912333 },
    // img:
    //   "https://www.brookfieldpropertiesretail.com/content/dam/ggp-digital-assets/Images/Mall-Images/Exteriors/baybrook-hero-04.jpg/_jcr_content/renditions/original.jpg",
    img: "./public/pokestops/pokestop6.png"
  },
  {
    title: "Dough Box Wood Fired Pizza",
    loc: { lat: 43.257474, lng: -79.924041 },
    // img:
    //   "https://www.dubai-online.com/wp-content/uploads/2012/05/ss_790728556.jpg",
    img: "./public/pokestops/pokestop7.png"
  },
  {
    title: "Lazeez Shawarma",
    loc: { lat: 43.261548, lng: -79.906421 },
    // img:
    //   "https://imagevars.gulfnews.com/2019/08/16/190816-dubai-mall-dinosaur_16c9b186c33_large.jpg",
    img: "./public/pokestops/pokestop8.png"
  },
  {
    title: "OneZo Tapioca",
    loc: { lat: 43.261359, lng: -79.906909 },
    // img:
    //   "https://squareonelife.com/wp-content/uploads/2015/06/kariya-park-square-one-condos-downtown-mississauga-condos.jpg",
    img: "./public/pokestops/pokestop9.png"
  }
];
let infoWindows = [];

fillCards(pokestops);

function initMap() {
  map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: 43.260949, lng: -79.913004 },
    zoom: 16
  });

  pokestops.forEach(stop => {
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
        '<a href="./pokestop.html">' +
        `<h5>${stop["title"]}</h5>` +
        "</a>" +
        `<p>${formatLoc(stop["loc"])}</p>` +
        "</div>" +
        `<img class="marker__img" alt="PokeStop Image" src="${
          stop["img"]
        }" data-holder-rendered="true">` +
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
}

function closeInfoWindows() {
  infoWindows.forEach(infowindow => {
    infowindow.close();
  });
  infoWindows = [];
}

function formatLoc(loc) {
  return `${loc.lat}, ${loc.lng}`;
}

function fillCards(pokestops) {
  pokestops.forEach(stop => {
    card =
      '<div class="col-lg-4">' +
      `    <a onclick="storeStop('${stop["title"]}',${stop["loc"].lat},${
        stop["loc"].lng
      },'${
        stop["img"]
      }')" href="#" class="card card--clickable mb-4 shadow--sm">` +
      '        <img class="card-img-top img--search" alt="PokeStop Image"' +
      `            src="${stop["img"]}"` +
      '            data-holder-rendered="true">' +
      "        <!-- each card has some temporary hardcoded text to show what it may look like -->" +
      '        <div class="card-body">' +
      `            <h5 class="card-title">${stop["title"]}</h5>` +
      `            <p class="card-text">${formatLoc(stop["loc"])}</p>` +
      `            <p class="card-text"><small class="text-muted">Added 10 days ago</small></p>` +
      "        </div>" +
      "    </a>" +
      "</div>";

    $("#search-cards").append(card);
  });
}

function storeStop(title, lat, lng, img) {
  sessionStorage.setItem(
    "currentStop",
    JSON.stringify({ title, loc: { lat, lng }, img })
  );
  window.location.href = "./pokestop.html";
  // window.location.href = `./pokestop.html?title=${title}&lat=${lat}&lng=${lng}&img=${img}&`;
}
