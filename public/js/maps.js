var data;
var indexLength = 0;

function clearList() {
    var list = document.getElementById('row');
    if (list.children) {
        console.log('clear');
        $('.newDiv').remove();
        indexLength = 0;
    }
}

function createListDivs(data) {
    var listChild = document.createElement('div');
    listChild.className = "col-11 col-md-7 newDiv data-toggle='tooltip' data-placement='top' title='Vers la page du contenu !'";
    listChild.style.backgroundImage = "url(" + data['images']['path'] + ")";
    listChild.innerHTML = '<div class="text" onclick=location.href="contenu/' + data['id_Contenu'] + '"> <h1>' 
                        + data["nom_contenu"].toUpperCase()
                        + '</h1> <i class="fas fa-map-marker-alt"></i> '
                        + data['Adresse'] + '</div>';
    var list = document.getElementById('row');
    list.appendChild(listChild);
}

function getMapData() {
    var newData = JSON.parse(getCookie('mapData'));
    if (!(_.isEqual(data, newData))) { //nouveau cookie
        if (data.length) //si data pas vide alors efface anciennes divs
            clearList();
        data = newData; //recupere nouveau cookie
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
