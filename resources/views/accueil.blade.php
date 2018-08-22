@extends('layouts.app')
@section('content')
    <div id="switchContainer">
        <div class="inner-switchContainer">
            <div class="switchToggle" id="vers-list">
                <p class="toList">Liste</p>
            </div>
            <div class="switchToggle" id="vers-carte">
                <p class="toMap">Carte</p>
            </div>
        </div>
        <div class="inner-switchContainer" id='toggle-switchContainer'>
            <div class="switchToggle" id="vers-list">
                <p class="toList">Liste</p>
            </div>
            <div class="switchToggle" id="vers-carte">
                <p class="toMap">Carte</p>
            </div>
        </div>
    </div>
    <div style="position: absolute; width: 100%; height: 100%; transition-duration: 0.7s;" class="UP" id="all">
        <div id="main-container">
            <iframe style="position: absolute; z-index: 1; top: 0px; overflow: hidden; border: hidden;" id="iframeCarte" title="carte" src="{{route('carte')}}" width="100%"></iframe>
            <div id="elementCategorie" style="display: none; left: 10px; bottom: 85px; z-index: 5; position: absolute; background-color: white; width: 180px; overflow: auto; max-height: 300px;">
                <p class="categorie">Sport</p>
                <p class="categorie">Sortie</p>
                <p class="categorie">Game</p>
                <p class="categorie">Lecture</p>
                <p class="categorie">Sport</p>
                <p class="categorie">Sortie</p>
                <p class="categorie">Game</p>
                <p class="categorie">Lecture</p>
            </div>
            <div id="cadre">
                <div id="categoriesSelected" style="display: block; width: 100%;"></div>
                <div id="inputsCadre">
                    <div style="font-size: 1.2em;" class="inputCadre">
                        <input type="text" id="adresse" placeholder="Choisis un lieu..." required>
                    </div>
                    <div style="font-size: 1.2em;" class="inputCadre">
                        <input id="inputCategorie" type="text" placeholder="Catégorie (max 3)" name="categorie">
                        {{--<select id="categorie">--}}
                            {{--<option value='' disabled selected>Choisis un filtre...</option>--}}
                            {{--<option value='1'>1</option>--}}
                            {{--<option value='2'>2</option>--}}
                            {{--<option value='3'>3</option>--}}
                            {{--<option value='4'>4</option>--}}
                        {{--</select>--}}
                    </div>
                    <div style="font-size: 1.2em;" class="inputCadre">
                        <select id="range">
                            <option value='' disabled selected>Choisis un rayon...</option>
                            <option value='2000'>2000m</option>
                            <option value='1500'>1500m</option>
                            <option value='1000'>1000m</option>
                            <option value='500'>500m</option>
                        </select>
                    </div>
                </div>
                <button type="button" class="btn" id="chercher" onclick="search()">GO!</button>
            </div>
        </div>
        <div id="list">
            <div class="row justify-content-center list" id="row">
                <div class="col-11 col-md-7 newDiv"></div>
                <div class="col-11 col-md-7 newDiv"></div>
                <div class="col-11 col-md-7 newDiv"></div>
                <div class="col-11 col-md-7 newDiv"></div>
                <div class="col-11 col-md-7 newDiv"></div>
                <div class="col-11 col-md-7 newDiv"></div>
                <div class="col-11 col-md-7 newDiv"></div>
                <div class="col-11 col-md-7 newDiv"></div>
            </div>
        </div>
        <img id="imgGIF" src="{{ asset('img/wait.gif')}}">
    </div>
    <script type="text/javascript" src="/bonplan/public/js/maps.js"></script>
    <script>
        $(document).ready(function(){
            $("#inputCategorie").focusin(function(){
                $("#elementCategorie").css("display", "block");
            });
            $(".categorie").click(function(){
                console.log(this.innerHTML);
                document.getElementById('categoriesSelected').innerHTML += '<div id="categorieSelected">'+this.innerHTML+' <i onclick="deleteCategorieSelected(this);" style="color: red; cursor: pointer;" class="fas fa-times"></i></div>';
                var nb = document.getElementById('categoriesSelected').innerHTML.split('<div');
                nb = nb.length-1;
                console.log('nb:'+nb);
                if (nb == 3){
                    document.getElementById('inputCategorie').disabled = true;
                }
            });
            $("#inputCategorie").blur(function(e){
                setTimeout(function () {
                    if (e.type == 'blur') {
                        $("#elementCategorie").css("display", "none");
                    }
                }, 100);

            });
            $("#inputCategorie").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#elementCategorie p").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
        function deleteCategorieSelected(elem){
            $(elem).parent().remove();
            document.getElementById('inputCategorie').disabled = false;
        }
    </script>

    <script>
        document.getElementById('iframeCarte').height = window.innerHeight;
        function search() {
            if(document.getElementById('adresse').value != ""){
                var adress = document.getElementById('adresse').value;
                adress = adress.replace(' ', '%20');

                document.getElementById('iframeCarte').src = '{{route('carte')}}?'+adress;
                console.log(document.location.href);
            }
        }
        var all = document.querySelector("#all");
        var UP = document.querySelector("#vers-carte");
        var DOWN = document.querySelector("#vers-list");

        UP.addEventListener("click", function () {
            all.className = 'UP';
        });
        DOWN.addEventListener("click", function () {
            all.className = 'DOWN';
        });

        var toggle = document.getElementById('switchContainer');
        var toggleContainer = document.getElementById('toggle-switchContainer');
        var toggleNumber = 'vers-carte';

        document.getElementById('vers-list').addEventListener('click', function() {
            if(toggleNumber != 'vers-list'){
                toggleNumber = 'vers-list';
                $('#list').css('display', 'grid');
                change('droite');
            }
        })

        document.getElementById('vers-carte').addEventListener('click', function() {
            if(toggleNumber != 'vers-carte'){
                toggleNumber = 'vers-carte';
                setTimeout(() => {
                    $('#list').css('display', 'none');
                }, 700);
                change('gauche');
                window.scrollTo(0, 0);
            }
        });

        function change(position) {
            if (position == 'droite') {

                toggleContainer.style.clipPath = 'inset(0 0 0 50%)';
                toggleContainer.style.backgroundColor = 'black';
            } else {
                toggleContainer.style.clipPath = 'inset(0 50% 0 0)';
                toggleContainer.style.backgroundColor = 'black';
            }
        };
    </script>
<script src="\bonplan\public\js\infiniteScroll.js"></script>


@endsection

