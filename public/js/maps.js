var mapData;
var data;
var indexLength = 0;
        
function passData(data) {
    mapData = data;
    console.log('passData');
    console.log(data);
    console.log(mapData);
}

function clearList() {
    if (document.getElementById('row').children) {
        $('.newDiv').remove();
        indexLength = 0;
    }
}

function createListDivs(mapData) {
    var listChild = document.createElement('div');
    listChild.className = "col-11 col-md-7 newDiv data-toggle='tooltip' data-placement='top' title='Vers la page du contenu !'";
    listChild.style.backgroundImage = "url(" + mapData['images']['path'] + ")";
    listChild.innerHTML = '<div class="text" onclick=location.href="contenu/' + mapData['id_Contenu'] + '"> <h1>' 
                        + mapData["nom_contenu"].toUpperCase()
                        + '</h1> <i class="fas fa-map-marker-alt"></i> '
                        + mapData['Adresse'] + '</div>';
    var list = document.getElementById('row');
    list.appendChild(listChild);
}

function getMapData() {
    console.log('getMapData');
    console.log(mapData);
    var newData = mapData;
    if (!(_.isEqual(data, newData))) {
        clearList();
        data = newData;
    }
    if (data.length && indexLength < data.length) { 
        for (i = 0; i < 5 && indexLength < data.length; i++, indexLength++) {
            createListDivs(data[indexLength]);
        }
        if (indexLength == data.length)
            return (createEndDiv());
    }
    else if (indexLength == data.length)
        createEndDiv();
}

function createEndDiv() {
    var noResultDiv = document.createElement('div');
    noResultDiv.className = "col-11 col-md-7 newDiv data-toggle='tooltip' data-placement='top' title='Vers la page du contenu !'";
    noResultDiv.style.backgroundColor = '#3d5c5c';
    noResultDiv.style.color = '#b3cccc';
    noResultDiv.innerHTML = '<div class="textNoResult"><h1>Il n\'y a rien de plus a voir dans ce coin <i class="fas fa-grin-beam-sweat"></i></h1></div>';
    var list = document.getElementById('row');
    list.appendChild(noResultDiv);
    indexLength = indexLength + 1;
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
