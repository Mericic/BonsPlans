<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Test - Map</title>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">

    <link rel="stylesheet" href="{{ asset('css/style.css')}}" type="text/css"/>

    <link rel="stylesheet" href="{{ asset('css/Control.OSMGeocoder.css')}}" type="text/css"/>

    <link rel="shortcut icon" type="image/x-icon" href="docs/images/favicon.ico" />

    {{--<link rel="stylesheet" href="http://xguaita.github.io/Leaflet.MapCenterCoord/dist/L.Control.MapCenterCoord.min.css" />--}}

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.3/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==" crossorigin=""/>

    <script src="https://unpkg.com/leaflet@1.3.3/dist/leaflet.js" integrity="sha512-tAGcCfR4Sc5ZP5ZoVz0quoZDYX5aCtEm/eu1KhSLj2c9eFrylXZknQYmxUssFaVJKvvc0dJQixhGjG2yXWiV9Q==" crossorigin=""></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script src="http://xguaita.github.io/Leaflet.MapCenterCoord/dist/L.Control.MapCenterCoord.min.js"></script>

    <script src="{{ asset('js/Control.OSMGeocoder.js')}}"></script>

    <script src="{{ asset('js/leaflet-routing-machine.min.js')}}"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
</head>
<body onLoad="getLocation()">
<div id="mapid"></div>
<script type="text/javascript" src="{{ asset('js/maps.js') }}"></script>
<script>
    function getLocation() {
        console.log(window.location.search.substring(1,8));
        var verif = document.location.href.split('?');
        console.log('verif:'+verif[1]);
        if(verif[1] != null && window.location.search.substring(1,8) != "contenu"){
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
                navigator.geolocation.getCurrentPosition(succes, error);
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
        if (window.location.search.substring(1,8) == "contenu")
            MapsOfContenu(latitude, longitude, msg);
        else
            maps(latitude, longitude, msg)
    }
    function error() {
        var longitude = 4.832487;
        var latitude = 45.758399;
        var msg = "error";
        if (window.location.search.substring(1,8) == "contenu")
            MapsOfContenu(latitude, longitude, msg);
        else
            maps(latitude, longitude, msg)
    }

    function MapsOfContenu(latitude, longitude, localisation){
        var hauteur = window.innerHeight+'px';
        var largeur = window.innerWidth+'px';
        document.getElementById('mapid').style.width = largeur;
        document.getElementById('mapid').style.height = hauteur;

        var mymap = L.map('mapid').setView([latitude, longitude], 15);
        var popup = L.popup();

        L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
            maxZoom: 18,
            minZoom: 1,
            id: 'mapbox.streets'
        }).addTo(mymap);

        if(localisation == "succes"){
            var adress = new URLSearchParams(window.location.search)
            $.ajax({
                type: "GET",
                url: "api/contenu/"+adress.get("contenu"),
                success: function(data){
                    console.log(data);
                    document.cookie = "mapData=" + JSON.stringify(data);
                    L.Routing.control({
                        waypoints: [
                            L.latLng(latitude, longitude),
                            L.latLng(data.contenu[0].coordonneesX, data.contenu[0].coordonneesY)
                        ],
                        language: 'fr',
                        routeWhileDragging: true,
                        router: L.Routing.mapbox('pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw')
                    }).addTo(mymap);
                    L.marker([latitude, longitude]).addTo(mymap)
                            .bindPopup('<h1 style="text-align:center; width: 100%;">Vous</h1>');
                    L.marker([data.contenu[0].coordonneesX, data.contenu[0].coordonneesY]).addTo(mymap)
                            .bindPopup('<h1 style="text-align:center; width: 100%;">Destination</h1>');

                }
            });
            document.getElementsByClassName("leaflet-control-zoom leaflet-bar leaflet-control")[0].style.display = "none";
        }
        else{
            alert('Impossible de vous localiser');
        }
    }

    function maps(latitude, longitude, msg) {

        var hauteur = window.innerHeight+'px';
        var largeur = window.innerWidth+'px';
        document.getElementById('mapid').style.width = largeur;
        document.getElementById('mapid').style.height = hauteur;

        var mymap = L.map('mapid').setView([latitude, longitude], 15);

        if(msg == "search"){
            var redIcon = L.icon({
                iconUrl: '{{ asset('img/marker-icon-red.png') }}',
                shadowUrl: '{{ asset('img/marker-shadow.png') }}',
                iconAnchor:   [10, 40],
                popupAnchor:  [4, -30]
            });
            L.marker([latitude, longitude], {icon: redIcon}).addTo(mymap)
                    .bindPopup('<div style="font-size: : 1.5em;">Centre de la recherche</div>');
        }

        L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
            maxZoom: 18,
            minZoom: 10,
            id: 'mapbox.streets'
        }).addTo(mymap);

        L.control.mapCenterCoord().addTo(mymap);

        startMaps(latitude, longitude);

        var markers = new Array();

        /*L.marker([45.758419, 4.832507]).addTo(mymap)
            .bindPopup("<b>Night Mario Kart</b><br>Pour la sortie du nouveau mario kart, venez-vous amusé avec nous !!!<hr>Organisateur : <a href=\"#\">Maxou</a><a href=\"#\"><i style=\"float: right; font-size: 2em;\" class=\"fas fa-long-arrow-alt-right\"></i></a>");
        */
        /*L.circle([latitude, longitude], 500, {
            color: 'red',
            fillColor: '#f03',
            fillOpacity: 0.5
        }).addTo(mymap).bindPopup("Périmètre a proximité du point recherché<br>(~1km de diamètre)");
        */

        var popup = L.popup();
        var action = 0;

        function refreshMap(){
            mymap.eachLayer(function (layer) {
                mymap.removeLayer(layer);
            });
            L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
                maxZoom: 18,
                minZoom: 10,
                id: 'mapbox.streets'
            }).addTo(mymap);
        }

        function onMapClick(e) {
            popup
                .setLatLng(e.latlng)
                .setContent("Vous avec cliquer sur le point " + e.latlng.toString())
                .openOn(mymap);
        }

        function onMapMove(e) {

            action = action + 1;
            if(action == 10){
                refreshMap();
                action = 0;
            }

            var style = document.getElementsByClassName('leaflet-proxy leaflet-zoom-animated')[0].style.transform;
            var lvl = style.substring(0,style.length-1).split("(")[2];

            var center = document.getElementsByClassName("leaflet-control-mapcentercoord leaflet-control")[0].innerHTML.split(" | ");
            var latitude = center[0].substring(0,center[0].length-1);
            var longitude = center[1].substring(0,center[1].length-1);
            console.log(latitude+'/'+longitude);

            $.ajax({
                type: "GET",
                url: "api/contenu/zoom/"+lvl+"/"+latitude+'/'+longitude,
                success: function(data){
                    document.cookie = "mapData=" + JSON.stringify(data);
                    console.log('onMapMove');
                    console.log(data);
                    data.forEach(function (element) {
                        var marker = new L.marker([element.CoordonneesX, element.CoordonneesY]).addTo(mymap)
                                .bindPopup('<div class="contenuPopUp" id="'+element.id_Contenu+'"></div>')
                                .on('click', function(){console.log(element.id_Contenu); clickOnBalise(element.id_Contenu); $('#'+element.id_Contenu).parents('.leaflet-popup-content').css('width', '300px');});
                        mymap.addLayer(marker);
                        markers[marker._leaflet_id] = marker;
                    });

                }
            });
        }

        function zoom(e){
            action = action + 1;
            if(action == 10){
                refreshMap();
                action = 0;
            }
            var style = document.getElementsByClassName('leaflet-proxy leaflet-zoom-animated')[0].style.transform;
            var lvl = style.substring(0,style.length-1).split("(")[2];
            $.ajax({
                type: "GET",
                url: "api/contenu/zoom/"+lvl+"/"+latitude+'/'+longitude,
                success: function(data){
                    console.log(data);
                    data.forEach(function (element) {
                        var marker = new L.marker([element.CoordonneesX, element.CoordonneesY]).addTo(mymap)
                                .bindPopup('<div class="contenuPopUp" id='+element.id_Contenu+'><b style="font-size: 1.5em">'+element.nom_contenu+'</b><hr><p style="font-size: 1.2em">'+element.Description+'</p><hr><a href="profil/'+element.pseudo+'" target="_parent" style="font-size: 1.4em">'+element.pseudo+'</a><a href="contenu/'+element.id_Contenu+'" target="_parent"><i style="float: right; font-size: 2em;" class="fas fa-long-arrow-alt-right"></i></a></div>');
                        mymap.addLayer(marker);
                    });
                }
            });
        }

        function clickOnBalise(id){
            console.log(id);
            $.ajax({
                type: "GET",
                url: "api/contenu/"+id,
                success: function(data){
                    console.log(data);
                    var value = '<b style="font-size: 1.5em">'+data.contenu[0].nom_contenu+'</b><hr><p style="font-size: 1.2em">'+data.contenu[0].description+'</p><hr><a href="profil/'+data.contenu[0].pseudo+'" target="_parent" style="font-size: 1.4em">'+data.contenu[0].pseudo+'</a><a href="contenu/'+id+'" target="_parent"><i style="float: right; font-size: 2em;" class="fas fa-long-arrow-alt-right"></i></a>';
                    $('#'+id).html(value);
                }
            });
        }

        function startMaps(latitude, longitude){
            console.log('markers:'+markers);
            $.ajax({
                type: "GET",
                url: "api/contenu/start/"+latitude+'/'+longitude,
                success: function(data){
                    console.log(data);
                    document.cookie = "mapData=" + JSON.stringify(data);
                    data.forEach(function (element) {
                        L.marker([element.CoordonneesX, element.CoordonneesY]).addTo(mymap)
                                .bindPopup('<div class="contenuPopUp" id="'+element.id_Contenu+'">' +
                                        '<b style="font-size: 1.5em">'+element.nom_contenu+'</b>' +
                                        '<hr><p style="font-size: 1.2em">'+element.Description+'</p>' +
                                        '<hr><a onclick="callMethod("changePage/Profile/'+element.pseudo+')" href="profil/'+element.pseudo+'" target="_parent" style="font-size: 1.4em">'+element.pseudo+'</a>' +
                                        '<a href="contenu/'+element.id_Contenu+'" target="_parent"><i style="float: right; font-size: 2em;" class="fas fa-long-arrow-alt-right"></i></a>' +
                                        '</div>');
                    });
                }
            });
        }

        function filtreMaps(latitude, longitude){
            function getCookie(cname) {
                var name = cname + "=";
                var decodedCookie = decodeURIComponent(document.cookie);
                var ca = decodedCookie.split(';');
                for(var i = 0; i < ca.length; i++) {
                    var c = ca[i];
                    while (c.charAt(0) == ' ') {
                        c = c.substring(1);
                    }
                    if (c.indexOf(name) == 0) {
                        return c.substring(name.length, c.length);
                    }
                }
                return "";
            }
            var filtre = getCookie("filtre");
            console.log(filtre);
//            $.ajax({
//                type: "GET",
//                url: "api/contenu/filtre/"+latitude+'/'+longitude+'/'+filtre,
//                success: function(data){
//                    console.log(data);
//                    document.cookie = "mapData=" + JSON.stringify(data);
//                    data.forEach(function (element) {
//                        L.marker([element.CoordonneesX, element.CoordonneesY]).addTo(mymap)
//                                .bindPopup('<div class="contenuPopUp" id="'+element.id_Contenu+'">' +
//                                        '<b style="font-size: 1.5em">'+element.nom_contenu+'</b>' +
//                                        '<hr><p style="font-size: 1.2em">'+element.Description+'</p>' +
//                                        '<hr><a onclick="callMethod("changePage/Profile/'+element.pseudo+')" href="profil/'+element.pseudo+'" target="_parent" style="font-size: 1.4em">'+element.pseudo+'</a>' +
//                                        '<a href="contenu/'+element.id_Contenu+'" target="_parent"><i style="float: right; font-size: 2em;" class="fas fa-long-arrow-alt-right"></i></a>' +
//                                        '</div>');
//                    });
//
//                }
//            });
        }

        mymap.on('click', onMapClick);
        mymap.on('zoom', zoom);
        mymap.on('moveend', onMapMove);

        document.getElementsByClassName("leaflet-control-mapcentercoord leaflet-control")[0].style.display = "none";
        document.getElementsByClassName("leaflet-control-zoom leaflet-bar leaflet-control")[0].style.display = "none";
        //document.getElementsByClassName("leaflet-control-attribution leaflet-control")[0].style.display = "none";
    }

    function search(adress) {
        adress = adress.replace('adress=', '').split('&filtre=');
        $.ajax({
            type: "GET",
            url: "https://nominatim.openstreetmap.org/search?q="+adress[0]+"&json_callback=_l_osmgeocoder_2&format=json",
            success: function(data){
                data = data.substr(17);
                data = JSON.parse(data.substr(0, data.length-1));
                var display_name = data[0].display_name.substr(data[0].display_name.length-6, data[0].display_name.length)
                console.log(display_name);
                if(display_name == "France"){
                    var filtre = adress[1];
                    console.log(filtre);
                    document.cookie = "filtres="+filtre[1];
                    maps(data[0].lat, data[0].lon, "search");
                }
                else {
                    maps(45.758399, 4.832487, "succes");
                    alert('Oups...\n\nDésolé l\'application n\'est disponible qu\'en France\nMerci pour votre intéret\n\nBisous ;)');
                }
            }
        });


//        var xmlhttp = new XMLHttpRequest();
//        xmlhttp.onreadystatechange = function() {
//            if (this.readyState == 4 && this.status == 200) {
//                var test = this.responseText.substr(17);
//                test = test.substr(0, test.length-1);
//                var myObj = JSON.parse(test);
//
//                var display_name = myObj[0].display_name.substr(myObj[0].display_name.length-6, myObj[0].display_name.length)
//                console.log(display_name);
//                if(display_name == "France"){
//                    var filtre = adress.split('filtre=');
//                    document.cookie = "filtres="+filtre[1];
//                    maps(myObj[0].lat, myObj[0].lon, "search");
//                }
//                else {
//                    maps(45.758399, 4.832487, "succes");
//                    alert('Erreur: Aucune correspondance en France');
//                }
//            }
//        };
//        adress = adress.replace(' ', '%20');
//        xmlhttp.open("GET", "https://nominatim.openstreetmap.org/search?q="+adress+"&json_callback=_l_osmgeocoder_2&format=json", true);
//        xmlhttp.send();
    }

</script>
</body>
</html>
