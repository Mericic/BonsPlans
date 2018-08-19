<!DOCTYPE html>
<html>
<head>
    <title>Test - Map</title>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">

    <link rel="stylesheet" href="{{ asset('css/style.css')}}" type="text/css"/>

    <link rel="stylesheet" href="{{ asset('css/Control.OSMGeocoder.css')}}" type="text/css"/>

    <link rel="shortcut icon" type="image/x-icon" href="docs/images/favicon.ico" />

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.3/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==" crossorigin=""/>

    <script src="https://unpkg.com/leaflet@1.3.3/dist/leaflet.js" integrity="sha512-tAGcCfR4Sc5ZP5ZoVz0quoZDYX5aCtEm/eu1KhSLj2c9eFrylXZknQYmxUssFaVJKvvc0dJQixhGjG2yXWiV9Q==" crossorigin=""></script>

    <script src="{{ asset('js/Control.OSMGeocoder.js')}}"></script>
</head>
<body onLoad="getLocation()">
<div id="mapid"></div>
<script>
    function getLocation() {
        var verif = document.location.href.split('?');
        if(verif[1] != null){
            if(verif[1].substr(0, 8) == "latitude"){
                var position = verif[1].split('&');
                var latitude = position[0].split('=');
                var longitude = position[1].split('=');
                maps(latitude[1], longitude[1], "succes");
            }
            else
                search(verif[1]);
        }
        else{
            if(navigator.geolocation)
            {
                navigator.geolocation.watchPosition(succes, error);
            }
            else
            {
                alert("Votre navigateur ne prend pas en charge la localisation... il serait temps de se mettre au gout du jour cher ami ^^");
            }
        }
    }
    function succes(position) {
        var longitude = position.coords.longitude;
        var latitude = position.coords.latitude;
        var msg = "succes";
        maps(latitude, longitude, msg)
    }
    function error() {
        var longitude = 4.832487;
        var latitude = 45.758399;
        var msg = "error";
        maps(latitude, longitude, msg)
    }

    function maps(latitude, longitude, msg) {

        var hauteur = window.innerHeight+'px';
        var largeur = window.innerWidth+'px';
        document.getElementById('mapid').style.width = largeur;
        document.getElementById('mapid').style.height = hauteur;

        var mymap = L.map('mapid').setView([latitude, longitude], 14);

        L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
            maxZoom: 18,
            minZoom: 10,
            id: 'mapbox.streets'
        }).addTo(mymap);


        L.marker([latitude, longitude]).addTo(mymap)
            .bindPopup("<b>Night Mario Kart</b><hr>Pour la sortie du nouveau mario kart, venez-vous amusé avec nous !!!<hr>Organisateur : <a href=\"#\">Maxou</a>");

        L.marker([45.758419, 4.832507]).addTo(mymap)
            .bindPopup("<b>Night Mario Kart</b><hr>Pour la sortie du nouveau mario kart, venez-vous amusé avec nous !!!<hr>Organisateur : <a href=\"#\">Maxou</a>");

        L.circle([latitude, longitude], 500, {
            color: 'red',
            fillColor: '#f03',
            fillOpacity: 0.5
        }).addTo(mymap).bindPopup("I am a circle.");

        L.polygon([
            [51.509, -0.08],
            [51.503, -0.06],
            [51.51, -0.047]
        ]).addTo(mymap).bindPopup("I am a polygon.");


        var popup = L.popup();

        function onMapClick(e) {
            popup
                .setLatLng(e.latlng)
                .setContent("Vous avec cliquer sur le point " + e.latlng.toString())
                .openOn(mymap);
        }

        mymap.on('click', onMapClick);

        document.getElementsByClassName("leaflet-control-zoom leaflet-bar leaflet-control")[0].style.display = "none";
        //document.getElementsByClassName("leaflet-control-attribution leaflet-control")[0].style.display = "none";
    }

    function search(adress) {

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var test = this.responseText.substr(17);
                test = test.substr(0, test.length-1);
                var myObj = JSON.parse(test);

                var display_name = myObj[0].display_name.substr(myObj[0].display_name.length-6, myObj[0].display_name.length)
                console.log(display_name);
                if(display_name == "France")
                    maps(myObj[0].lat, myObj[0].lon, "succes");
                else {
                    maps(45.758399, 4.832487, "succes");
                    alert('Erreur: Aucune correspondance en France');
                }
            }
        };
        adress = adress.replace(' ', '%20');
        xmlhttp.open("GET", "https://nominatim.openstreetmap.org/search?q="+adress+"&json_callback=_l_osmgeocoder_2&format=json", true);
        xmlhttp.send();
    }

</script>
</body>
</html>
