var DivClass = "col-11 col-md-7 newDiv";

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
        maps(latitude, longitude, msg)
}
function error() {
    var longitude = 4.832487;
    var latitude = 45.758399;
    var msg = "error";
    if (window.location.search.substring(1,8) == "contenu")
        MapsOfContenu(latitude, longitude, msg);
    else
        maps(latitude, longitude)
}

function maps(latitude, longitude) {
    $.ajax({
        type: "GET",
        url: "api/contenu/start/"+latitude+'/'+longitude,
        success: function(data){
            console.log(data);
            for (i = 0; i < data.length; i++) {
                var listChild = document.createElement('div');
                listChild.className = "col-11 col-md-7 newDiv";
                listChild.style.backgroundImage = "url(" + data[i]['images']['path'] + ")";
                

                var list = document.getElementById('row');
                list.appendChild(listChild);
            }
        }
    });
}

