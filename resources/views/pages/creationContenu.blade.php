@extends('layouts.app')

@section('content')

    <script>
        // global app configuration object
        var addImageRoute = "{{ action('ImageController@addImage') }}";
    </script>
    <body>
    <form method="POST" action="{{ route('addcontenuForm') }}"  enctype="multipart/form-data">
        @csrf
        <div id="image_haut">
            <img src="{{ asset('/img/contenu/default/image.png') }}" alt="image par défaut" id="image_haut_defaut"/>
            <input type="text" style="margin: auto" class="form-control col-4" value="Titre" name="titre" />
            <input name="imageContenu" onchange="readURL(this);" type="file" class="form-control-file col-4" id="uploadImage" style="margin:auto; margin-top: 5px; font-size: 1em!important;"/>

        </div>

        <div id="description" class="container-fluid">
            <div class="row">
                <section id="criteres" class="col-sm">
                    <h2  style="text-decoration: underline">Infos de Base</h2>
                    <label for="">Date (facultatif)</label>
                    <input type="text" value="" name="date" id="champ_date" size="12" maxlength="10">
                    <div id="calendarMain"></div>


                </section>
            </div>
            <div class="row">
                <section id="criteres" class="col-sm">
                    <h2  style="text-decoration: underline">Criteres (qualité notée par la communauté)</h2>
                    <input type="hidden" value="" id="inputCriteres" name="inputCriteres"/>
                    <div class="row" id="listeCriteres">
                    </div>
                    <div class="row">
                        <input id="CritereInput" type="text" autocomplete="off" class="form-control">
                        <div id="resultsCriteres" class="col" style="display: none;"></div>
                        <button type="button" class="col btn btn-sm btn-outline-dark" id="btn_ajout_critere" onclick="ajoutCritere()">Ajouter un critère de vote</button>
                    </div>

                </section>
                <section id="categories" class="col-sm">
                    <p  style="text-decoration: underline">Catégories</p>
                    <input type="hidden" value="" id="inputCategories" name="inputCategories"/>

                    <div class="row" id="listeCategorie">
                    </div>
                    <div class="row">
                        <input id="CategorieInput" type="text" autocomplete="off" class="form-control">
                        <div id="resultsCategories" class="col" style="display: none;"></div>
                        <button type="button" class="col btn btn-sm btn-outline-dark" id="btn_ajout_critere" onclick="ajoutCategorie()">Ajouter une catégorie</button>
                    </div>

                </section>
            </div>
            <div class="row">
                <section id="descriptiondetaillee" class="col-sm">
                    <h2 class="col-sm-12"  style="text-decoration: underline">Description détaillée</h2>
                    <div class="row">
                        <textarea class="form-control" name="description">Saisissez une description détaillée</textarea>
                    </div>

                </section>

            </div>
            <div clas="row">
                <button type="submit" class="btn btn-light">Enregistrer</button>
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
        window.loaded(
                calInit("calendarMain", "", "champ_date", "jsCalendar", "day", "selectedDay")
        )
        //]]>
    </script>
    <script>
        (function() {

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

        })();
    </script>


    </body>

@endsection