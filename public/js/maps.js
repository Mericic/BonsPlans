
function getLocation() {
    if(navigator.geolocation)
    {
        navigator.geolocation.getCurrentPosition(succes, error);
    }
    else
    {
        alert("Votre navigateur ne prend pas en charge la localisation... il serait temps de se mettre au gout du jour cher ami ^^");
    }
}

function succes(position) {
    var longitude = position.coords.longitude;
    var latitude = position.coords.latitude;
    var msg = "succes";
    if (window.location.search.substring(1,8) == "contenu")
        MapsOfContenu(latitude, longitude, msg);
    else
        maps()
}
function error() {
    var longitude = 4.832487;
    var latitude = 45.758399;
    var msg = "error";
    if (window.location.search.substring(1,8) == "contenu")
        MapsOfContenu(latitude, longitude, msg);
    else
        maps()
}

function maps() {
    var data = getCookie('mapData');
    data = JSON.parse(data);
    for (i = 0; i < data.length; i++) {
        var listChild = document.createElement('div');
        listChild.className = "col-11 col-md-7 newDiv data-toggle='tooltip' data-placement='top' title='Vers la page du contenu !'";
        listChild.style.backgroundImage = "url(" + data[i]['images']['path'] + ")";
        listChild.innerHTML = '<div class="text" onclick=location.href="contenu/' + data[i]['id_Contenu'] + '"> <h1>' 
                            + data[i]["nom_contenu"].toUpperCase()
                            + '</h1> <i class="fas fa-map-marker-alt"></i> '
                            + data[i]['Adresse'] + '</div>';
        var list = document.getElementById('row');
        list.appendChild(listChild);
    };
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
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
