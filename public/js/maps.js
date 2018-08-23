function clearList() {
    var list = document.getElementById('row');
    if (list.children) {
        console.log('clear');
        $('.newDiv').remove();
    };
}

function getMapData() {
    let data = getCookie('mapData');
    data = JSON.parse(data);
    clearList();
    if (data.length) {
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
        }
    }
    else {
        var noResultDiv = document.createElement('div');
        noResultDiv.className = "col-11 col-md-7 newDiv data-toggle='tooltip' data-placement='top' title='Vers la page du contenu !'";
        noResultDiv.style.backgroundColor = '#3d5c5c';
        noResultDiv.style.color = '#b3cccc';
        noResultDiv.innerHTML = '<div class="textNoResult" onclick=location.href="home"><h1>Il n\'y a rien a voir dans ce coin <i class="fas fa-grin-beam-sweat"></i>, <br> Clic ici pour retourner a ta position ! </h1></div>';
        var list = document.getElementById('row');
        list.appendChild(noResultDiv);
    }

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
