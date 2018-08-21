@extends('layouts.app')

@section('content')

    <body>
    <div id="image_haut">
        <img src="{{ asset('/img/contenu/default/image.png') }}" alt="image par défaut" id="image_haut_defaut"/>
        <input type="text" style="margin: auto" class="form-control col-4" value="Titre" />
        <input type="file" class="form-control-file col-4" id="uploadImage" onclick="refreshImg(this.value)" style="margin:auto; margin-top: 5px; font-size: 1em!important;"/>
    </div>

    <div id="description" class="container-fluid">
        <div class="row">
            <section id="criteres" class="col-sm">
                <h2  style="text-decoration: underline">Criteres (qualité notée par la communauté)</h2>
                <div class="row" id="listeCriteres">


                </div>
                <div class="row">
                    <input id="CritereInput" type="text" autocomplete="off" class="form-control">
                    <div id="resultsCriteres" class="col" style="display: none;"></div>
                    <button class="col btn btn-sm btn-outline-dark" id="btn_ajout_critere" onclick="ajoutCritere()">Ajouter un critère de vote</button>
                </div>

            </section>
            <section id="categories" class="col-sm">
                <p  style="text-decoration: underline">Catégories</p>
                <div class="row" id="listeCategorie">
                </div>
                <div class="row">
                    <input id="CategorieInput" type="text" autocomplete="off" class="form-control">
                    <div id="resultsCategories" class="col" style="display: none;"></div>
                    <button class="col btn btn-sm btn-outline-dark" id="btn_ajout_critere" onclick="ajoutCategorie()">Ajouter une catégorie</button>
                </div>

            </section>
        </div>
        <div class="row">
            <section id="descriptiondetaillee" class="col-sm">
                <h2 class="col-sm-12"  style="text-decoration: underline">Description détaillée</h2>
                <div class="row">
                    <textarea class="form-control">Saisissez une description détaillée</textarea>
                </div>

            </section>

        </div>

    </div>



    <div class="modal fade" id="AjoutCommentaireModal" tabindex="-1" role="dialog" aria-labelledby="AjoutCommentaireModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AjoutCommentaireModalLabel">Ajouter un Commentaire</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('ajout_commentaire') }}" id="CommentaireForm">
                        @csrf
                        <input type="hidden" name="id_Contenu" value="">

                        <div class="form-group row">
                            <label for="Commentaire" class="col-sm-4 col-form-label text-md-right">Commentaire</label>

                            <div class="col-md-6">

                                <textarea id="Commentaire" class="form-control" name="Commentaire"></textarea>

                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="$('#CommentaireForm').submit()">Enregistrer</button>
                </div>
            </div>
        </div>
    </div>

    @if ($errors->has('id_Commentaire'))
        <div class="alert alert-danger" role="alert">
            {{ $errors->first('id_Commentaire') }}
        </div>
    @endif

    <script type='text/javascript' src='{{ asset('/js/contenu/creation.js') }}'></script>
    <script>
        (function() {

            var searchElementCategorie = document.getElementById('CategorieInput'),
                    resultsCategorie = document.getElementById('resultsCategories'),
                    selectedResultCategorie = -1, // Permet de savoir quel résultat est sélectionné : -1 signifie "aucune sélection"
                    previousRequestCategorie, // On stocke notre précédente requête dans cette variable
                    previousValueCategorie = searchElementCategorie.value; // On fait de même avec la précédente valeur



            function getResults(keywords) { // Effectue une requête et récupère les résultats

                var xhr = new XMLHttpRequest();
                console.log("{{ action('CategorieController@rechercheCategorie','/') }}/"+ encodeURIComponent(keywords))
                xhr.open('GET', "{{ action('CategorieController@rechercheCategorie','/') }}/"+ encodeURIComponent(keywords));

                xhr.addEventListener('readystatechange', function() {
                    if (xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {

                        displayResults(xhr.responseText);

                    }
                });

                xhr.send(null);

                return xhr;

            }

            function displayResults(response) { // Affiche les résultats d'une requête

                resultsCategorie.style.display = response.length ? 'block' : 'none'; // On cache le conteneur si on n'a pas de résultats

                if (response.length) { // On ne modifie les résultats que si on en a obtenu

                    response = response.split('|');
                    var responseLen = response.length;

                    resultsCategorie.innerHTML = ''; // On vide les résultats

                    for (var i = 0, div ; i < responseLen ; i++) {

                        div = resultsCategorie.appendChild(document.createElement('div'));
                        div.innerHTML = response[i];

                        div.addEventListener('click', function(e) {
                            chooseResult(e.target);
                        });

                    }

                }

            }

            function chooseResult(result) { // Choisi un des résultats d'une requête et gère tout ce qui y est attaché

                searchElementCategorie.value = previousValueCategorie = result.innerHTML; // On change le contenu du champ de recherche et on enregistre en tant que précédente valeur
                resultsCategorie.style.display = 'none'; // On cache les résultats
                result.className = ''; // On supprime l'effet de focus
                selectedResultCategorie = -1; // On remet la sélection à "zéro"
                searchElementCategorie.focus(); // Si le résultat a été choisi par le biais d'un clique alors le focus est perdu, donc on le réattribue

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

                    chooseResult(divs[selectedResultCategorie]);

                }

                else if (searchElementCategorie.value != previousValueCategorie) { // Si le contenu du champ de recherche a changé

                    previousValueCategorie = searchElementCategorie.value;

                    if (previousRequestCategorie && previousRequestCategorie.readyState < XMLHttpRequest.DONE) {
                        previousRequestCategorie.abort(); // Si on a toujours une requête en cours, on l'arrête
                    }

                    previousRequestCategorie = getResults(previousValueCategorie); // On stocke la nouvelle requête

                    selectedResultCategorie = -1; // On remet la sélection à "zéro" à chaque caractère écrit

                }

            });

        })();
    </script>


    </body>

@endsection