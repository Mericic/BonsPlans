@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/contenuCreation.css') }}">

<script>
    // global app configuration object
    var addImageRoute = "{{ action('ImageController@addImage') }}";
</script>
<body>
<form method="POST" action="{{ route('addcontenuForm') }}"  enctype="multipart/form-data" id="creationForm">
    @csrf
    <div id="image_haut">
        <img src="" alt="image par défaut" style="display: none" id="image_haut_defaut"/>
        <div id="upload" class="row justify-content-center input-group col-12">
            <label class="input-group-btn">
                <span id="uploadSpan" class="btn btn-primary">
                    <i class="fas fa-images"></i> Ajouter une image<input required name="imageContenu" onchange="readURL(this);" type="file" class="form-control-file" id="uploadImage" style="display: none;" multiple>
                </span>
            </label>
        </div>
        <input required type="text" style="margin: auto" id="contentName" class="form-control col-8 col-md-4" value="" name="titre" placeholder="Nom d'affichage"/>
    </div>
    <div id="description" class="container-fluid">
        <div class="row creationRow justify-content-center">
            <div id="criteres" class="row creationRow justify-content-center input-group col-3 col-md-2">
                <span class="input-group-text col-3" id="basic-addon2"><i class="fas fa-calendar-alt"></i></span>
                <input type="text" value="" class="form-control" name="date" id="champ_date" placeholder="Date (facultatif)" size="12" maxlength="10">
                <div id="calendarMain"></div>
            </div>
        </div>
        <div class="row creationRow justify-content-center">
            <div id="criteres" class="row creationRow justify-content-center input-group col-10 col-md-8">
                <div class="row creationRow justify-content-center col-12">
                    <input required type="hidden" value="" id="inputCriteres" name="inputCriteres"/>
                    <div class="row creationRow justify-content-center col-12" id="listeCritere"></div>
                </div>
                <div class="row creationRow justify-content-center col-12">   
                    <div id="elemCritCreation" class="col-10 col-md-8">
                        @foreach($Criteres as $Critere)
                            <p id="{{  $Critere->id_Critere }}" class="critere">{{  $Critere->nom }}</p>
                        @endforeach
                    </div>                 
                    <span class="input-group-text col-2" id="basic-addon2"><i class="fas fa-hashtag" style="margin-right: 3%"></i></i>Criteres</span>
                    <input id="inputCritere" type="text" class="form-control col-9" placeholder="(3 au maximum)" aria-label="(3 au maximum)" aria-describedby="basic-addon2">
                    <div id="resultsCriteres" style="display: none;"></div>
                   <!-- <button type="button" class="btn btn-primary" id="btn_ajout_critere" onclick="ajoutCritere()"><i class="fas fa-plus"></i></button> -->
                </div>
            </div>
        </div>
        <div class="row creationRow justify-content-center">
            <div id="categories" class="row creationRow justify-content-center input-group col-10 col-md-8">
                <div class="row creationRow justify-content-center col-12">
                    <input required type="hidden" value="" id="inputCategories" name="inputCategories"/>
                    <div class="row creationRow justify-content-center col-12" id="listeCategorie"></div>
                </div>
                <div class="row creationRow justify-content-center col-12">   
                    <div id="elemCateCreation" class="col-10 col-md-8">
                        @foreach($Categories as $Categorie)
                            <p id="{{  $Categorie->id_Categorie }}" class="categorie">{{  $Categorie->nom }}</p>
                        @endforeach
                    </div>                 
                    <span class="input-group-text col-2" id="basic-addon2"><i class="fas fa-list-ul" style="margin-right: 3%;"></i>Catégories</span>
                    <input id="inputCategorie" type="text" class="form-control col-9" placeholder="(3 au maximum)" aria-label="(3 au maximum)" aria-describedby="basic-addon2">
                    <div id="resultsCategories" style="display: none;"></div>
                     <!-- <button type="button" class="btn btn-primary" id="btn_ajout_categorie" onclick="ajoutCategorie()"><i class="fas fa-plus"></i></button> -->
                </div>
            </div>
        </div>
        <div class="row creationRow justify-content-center">
            <div id="descriptiondetaillee" class="row creationRow justify-content-center input-group col-10 col-md-7">
                <span class="input-group-text col-2 col-md-2"><i class="fas fa-align-left" style="margin-right: 4%;"></i>Description</span>
                <textarea required id="descriptionArea" class="form-control col-10 col-md-10" aria-label="With textarea" maxlength="200" name="description"></textarea>
                <span class="input-group-text col-md-2" id="charactersRemaining">200 / 200</span>
            </div>
        </div>
        <div class="row creationRow justify-content-center">
            <button type="button" class="btn btn-primary col-10 col-md-7" data-toggle="modal" data-target="#confirmModal"><i style="height: 30px; width: auto;" class="fas fa-check"></i></button>
        </div>
        <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> Creation du contenu</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Es-tu sûr de vouloir creer ce contenu ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
                        <button type="submit" class="btn btn-primary">Oui !</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@if ($errors->has('id_Commentaire'))
    <div class="alert alert-danger" role="alert">
        {{ $errors->first('id_Commentaire') }}
    </div>
@endif

<script type='text/javascript' src='{{ asset('/js/contenu/creation.js') }}'></script>
<script type='text/javascript' src='{{ asset('/js/contenu/datePicker.js') }}'></script>

<script type="text/javascript">
    //<![CDATA[
    window.onload = calInit("calendarMain", "", "champ_date", "jsCalendar", "day", "selectedDay")
    //]]>
</script>
<script>
    $(document).ready(function(){
        $("#inputCategorie").focusin(function(){
            $("#elemCateCreation").css("display", "block");
        });
        $(".categorie").click(function(){
            console.log(this.innerHTML);
            var listeCategorie = document.getElementById('listeCategorie');
            if (listeCategorie.children.length < 3) {
                var btn = document.createElement("button")
                btn.setAttribute('class', 'btn btn-secondary categorie')
                btn.addEventListener('click', function(){this.parentElement.removeChild(this)});
                btn.innerHTML = this.innerHTML;
                document.getElementById('listeCategorie').appendChild(btn);
            }
            var nb = document.getElementById('resultsCategories').children.length;
            if (nb == 3){
                document.getElementById('inputCategorie').disabled = true;
            }
        });
        $("#inputCategorie").blur(function(e){
            setTimeout(function () {
                if (e.type == 'blur') {
                    $("#elemCateCreation").css("display", "none");
                }
            }, 100);

        });
        $("#inputCategorie").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#elemCateCreation p").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        $("#adresse").click(function(){
            adresseFiltre();
        });
        $("#inputCritere").focusin(function(){
            $("#elemCritCreation").css("display", "block");
        });
        $(".critere").click(function(){
            console.log(this.innerHTML);
            var listeCritere = document.getElementById('listeCritere');
            if (listeCritere.children.length < 3) {
                var btn = document.createElement("button")
                btn.setAttribute('class', 'btn btn-secondary critere')
                btn.addEventListener('click', function(){this.parentElement.removeChild(this)});
                btn.innerHTML = this.innerHTML;
                document.getElementById('listeCritere').appendChild(btn);
            }
            var nb = document.getElementById('resultsCriteres').children.length;
            if (nb == 3){
                document.getElementById('inputCritere').disabled = true;
            }
        });
        $("#inputCritere").blur(function(e){
            setTimeout(function () {
                if (e.type == 'blur') {
                    $("#elemCritCreation").css("display", "none");
                }
            }, 100);
        });
        $("#inputCritere").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#elemCritCreation p").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        $("#adresse").click(function(){
            adresseFiltre();
        });
    });
    $(document).ready(function() {
        var text_max = 200;
        $('#charactersRemaining').html(text_max + ' / 200');

        $('#descriptionArea').keyup(function() {
            var text_length = $('#descriptionArea').val().length;
            var text_remaining = text_max - text_length;

            $('#charactersRemaining').html(text_remaining + ' / 200');
        });
    });

    $('#creationForm').on('keyup keypress', function(e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) { 
            e.preventDefault();
            return false;
        }
    });
    /*(function() {

        var searchElementCategorie = document.getElementById('CategorieInput'),
                resultsCategorie = document.getElementById('resultsCategories'),
                selectedResultCategorie = -1, // Permet de savoir quel résultat est sélectionné : -1 signifie "aucune sélection"
                previousRequestCategorie, // On stocke notre précédente requête dans cette variable
                previousValueCategorie = searchElementCategorie.value; // On fait de même avec la précédente valeur

        var searchElementCritere = document.getElementById('CritereInput'),
                resultsCritere = document.getElementById('resultsCriteres'),
                selectedResultCritere = -1, // Permet de savoir quel résultat est sélectionné : -1 signifie "aucune sélection"
                previousRequestCritere, // On stocke notre précédente requête dans cette variable
                previousValueCritere = searchElementCritere.value; // On fait de même avec la précédente valeur



        function getResults(keywords, url, type) { // Effectue une requête et récupère les résultats

            var xhr = new XMLHttpRequest();
            console.log(url+"/"+ encodeURIComponent(keywords))
            xhr.open('GET', url+"/"+ encodeURIComponent(keywords));

            xhr.addEventListener('readystatechange', function() {
                if (xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
                    if(type=='categorie')
                        displayResultsCategorie(xhr.responseText);
                    else if(type=='critere')
                        displayResultsCritere(xhr.responseText);


                }
            });

            xhr.send(null);

            return xhr;

        }

        function displayResultsCategorie(response) { // Affiche les résultats d'une requête

            resultsCategorie.style.display = response.length ? 'block' : 'none'; // On cache le conteneur si on n'a pas de résultats

            if (response.length) { // On ne modifie les résultats que si on en a obtenu

                response = response.split('|');
                var responseLen = response.length;

                resultsCategorie.innerHTML = ''; // On vide les résultats

                for (var i = 0, div ; i < responseLen ; i++) {

                    div = resultsCategorie.appendChild(document.createElement('div'));
                    div.innerHTML = response[i];

                    div.addEventListener('click', function(e) {
                        chooseResultCategorie(e.target);
                    });

                }

            }

        }
        function displayResultsCritere(response) { // Affiche les résultats d'une requête

            resultsCritere.style.display = response.length ? 'block' : 'none'; // On cache le conteneur si on n'a pas de résultats

            if (response.length) { // On ne modifie les résultats que si on en a obtenu

                response = response.split('|');
                var responseLen = response.length;

                resultsCritere.innerHTML = ''; // On vide les résultats

                for (var i = 0, div ; i < responseLen ; i++) {

                    div = resultsCritere.appendChild(document.createElement('div'));
                    div.innerHTML = response[i];

                    div.addEventListener('click', function(e) {
                        chooseResultCritere(e.target);
                    });

                }

            }

        }

        function chooseResultCategorie(result) { // Choisi un des résultats d'une requête et gère tout ce qui y est attaché

            searchElementCategorie.value = previousValueCategorie = result.innerHTML; // On change le contenu du champ de recherche et on enregistre en tant que précédente valeur
            resultsCategorie.style.display = 'none'; // On cache les résultats
            result.className = ''; // On supprime l'effet de focus
            selectedResultCategorie = -1; // On remet la sélection à "zéro"
            searchElementCategorie.focus(); // Si le résultat a été choisi par le biais d'un clique alors le focus est perdu, donc on le réattribue
        }
        function chooseResultCritere(result) { // Choisi un des résultats d'une requête et gère tout ce qui y est attaché

            searchElementCritere.value = previousValueCritere = result.innerHTML; // On change le contenu du champ de recherche et on enregistre en tant que précédente valeur
            resultsCritere.style.display = 'none'; // On cache les résultats
            result.className = ''; // On supprime l'effet de focus
            selectedResultCritere = -1; // On remet la sélection à "zéro"
            searchElementCritere.focus(); // Si le résultat a été choisi par le biais d'un clique alors le focus est perdu, donc on le réattribue
        }



        searchElementCategorie.addEventListener('keyup', function(e) {

            var divs = resultsCategorie.getElementsByTagName('div');

            if (e.keyCode == 38 && selectedResultCategorie > -1) { // Si la touche pressée est la flèche "haut"

                divs[selectedResultCategorie--].className = '';

                if (selectedResultCategorie > -1) { // Cette condition évite une modification de childNodes[-1], qui n'existe pas, bien entendu
                    divs[selectedResultCategorie].className = 'result_focus';
                }

            }

            else if (e.keyCode == 40 && selectedResultCategorie < divs.length - 1) { // Si la touche pressée est la flèche "bas"

                resultsCategorie.style.display = 'block'; // On affiche les résultats

                if (selectedResultCategorie > -1) { // Cette condition évite une modification de childNodes[-1], qui n'existe pas, bien entendu
                    divs[selectedResultCategorie].className = '';
                }

                divs[++selectedResultCategorie].className = 'result_focus';

            }

            else if (e.keyCode == 13 && selectedResultCategorie > -1) { // Si la touche pressée est "Entrée"

                chooseResultCategorie(divs[selectedResultCategorie]);

            }

            else if (searchElementCategorie.value != previousValueCategorie) { // Si le contenu du champ de recherche a changé

                previousValueCategorie = searchElementCategorie.value;

                if (previousRequestCategorie && previousRequestCategorie.readyState < XMLHttpRequest.DONE) {
                    previousRequestCategorie.abort(); // Si on a toujours une requête en cours, on l'arrête
                }

                previousRequestCategorie = getResults(previousValueCategorie, "{{ action('CategorieController@rechercheCategorie','/') }}", 'categorie'); // On stocke la nouvelle requête

                selectedResultCategorie = -1; // On remet la sélection à "zéro" à chaque caractère écrit

            }

        });

        searchElementCritere.addEventListener('keyup', function(e) {

            var divs = resultsCritere.getElementsByTagName('div');

            if (e.keyCode == 38 && selectedResultCritere > -1) { // Si la touche pressée est la flèche "haut"

                divs[selectedResultCritere--].className = '';

                if (selectedResultCritere > -1) { // Cette condition évite une modification de childNodes[-1], qui n'existe pas, bien entendu
                    divs[selectedResultCritere].className = 'result_focus';
                }

            }

            else if (e.keyCode == 40 && selectedResultCritere < divs.length - 1) { // Si la touche pressée est la flèche "bas"

                resultsCritere.style.display = 'block'; // On affiche les résultats

                if (selectedResultCritere > -1) { // Cette condition évite une modification de childNodes[-1], qui n'existe pas, bien entendu
                    divs[selectedResultCritere].className = '';
                }

                divs[++selectedResultCritere].className = 'result_focus';

            }

            else if (e.keyCode == 13 && selectedResultCritere > -1) { // Si la touche pressée est "Entrée"

                chooseResultCritere(divs[selectedResultCritere]);

            }

            else if (searchElementCritere.value != previousValueCritere) { // Si le contenu du champ de recherche a changé

                previousValueCritere = searchElementCritere.value;

                if (previousRequestCritere && previousRequestCritere.readyState < XMLHttpRequest.DONE) {
                    previousRequestCritere.abort(); // Si on a toujours une requête en cours, on l'arrête
                }

                previousRequestCritere = getResults(previousValueCritere, "{{ action('CritereController@rechercheCritere','/') }}", 'critere'); // On stocke la nouvelle requête

                selectedResultCritere = -1; // On remet la sélection à "zéro" à chaque caractère écrit

            }

        });

    })();*/
</script>


</body>

@endsection