var DBdata = "hello";

function getLocation() {
    if(navigator.geolocation)
    {
        navigator.geolocation.watchPosition(succes, error);
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

function maps(latitude, longitude, msg) {
    $.ajax({
        type: "GET",
        url: "api/contenu/start/"+latitude+'/'+longitude,
        success: function(data){
            console.log(data);
        }
    });
}

