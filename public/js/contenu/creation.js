/**
 * Created by Aymeric on 21/08/2018.
 */

function ajoutCritere(){
    var critere = $('#CritereInput').val()

    if(critere==null || critere=='')
        return;

    if (document.getElementById('listeCriteres').hasChildNodes()) {
        var listeCriteres = document.getElementById('listeCriteres').childNodes
        for(var i = 0; i < listeCriteres.length; i++){
            if(listeCriteres[i].hasChildNodes())
                if(listeCriteres[i].innerText == critere){
                    $('#CritereInput').val('')
                    return
                }

        }
    }


    var div = document.createElement("div");
    div.setAttribute('class', 'critere col-6')
    var p = document.createElement("p")
    p.setAttribute('class', 'critere col-6 col-md-3')
    p.innerHTML=critere
    document.getElementById('listeCriteres').appendChild(p)

    //on ajoute au input hidden la valeur
    var hidden = $('#inputCriteres').val();
    hidden += critere+'|';
    $('#inputCriteres').val(hidden)
    console.log(hidden)

    $('#CritereInput').val('')
    console.log('fini')
}

function ajoutCategorie(){
    var categorie = $('#CategorieInput').val()

    if(categorie==null || categorie=='')
        return;

    if (document.getElementById('listeCategorie').hasChildNodes()) {
        var listeCategorie = document.getElementById('listeCategorie').childNodes
        for(var i = 0; i < listeCategorie.length; i++){
            if(listeCategorie[i].hasChildNodes())
                if(listeCategorie[i].innerText == categorie){
                    $('#CategorieInput').val('')
                    return
                }

        }
    }


    var div = document.createElement("div");
    div.setAttribute('class', 'categorie col-6')
    var p = document.createElement("p")
    p.setAttribute('class', 'categorie col-6 col-md-3')
    p.innerHTML=categorie
    document.getElementById('listeCategorie').appendChild(p)

    //on ajoute au input hidden la valeur
    var hidden = $('#inputCategories').val();
    hidden += categorie+'|';
    $('#inputCategories').val(hidden)
    console.log(hidden)

    $('#CategorieInput').val('')
    console.log('fini')
}




function readURL(input) {
    console.log('coucou')
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#image_haut_defaut').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
