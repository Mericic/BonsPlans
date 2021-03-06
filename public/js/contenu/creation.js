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

    var listeCriteres = document.getElementById('listeCriteres');
    if (listeCriteres.children.length < 3) {
        var btn = document.createElement("button");
        btn.setAttribute('class', 'critere btn btn-secondary');
        btn.setAttribute('type', 'button');
        btn.addEventListener("click", function() {this.parentElement.removeChild(this)});
        btn.innerHTML=critere;
        listeCriteres.appendChild(btn)
    }

    //on ajoute au input hidden la valeur
    var hidden = $('#inputCriteres').val();
    hidden += critere+'|';
    $('#inputCriteres').val(hidden)

    $('#CritereInput').val('')
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


    var listeCategorie = document.getElementById('listeCategorie');
    if (listeCategorie.children.length < 3) {
        var btn = document.createElement("button")
        btn.setAttribute('class', 'btn btn-secondary categorie')
        btn.addEventListener('click', function(){this.parentElement.removeChild(this)});
        btn.innerHTML=categorie;
        document.getElementById('listeCategorie').appendChild(btn);
    }

    //on ajoute au input hidden la valeur
    var hidden = $('#inputCategories').val();
    hidden += categorie+'|';
    $('#inputCategories').val(hidden)
    console.log(hidden)

    $('#CategorieInput').val('')
    console.log('fini')
}

function readURL(input) {
    if (input.files && input.files[0]) {
        let reader = new FileReader();
        var data = new FormData();
        data = input.files[0]
        reader.onload = function(e) {
            var img = $('#image_haut_defaut');
            img.attr('src', e.target.result);
            img.css('display', 'block');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
