@extends('layouts.app')
@section('content')
    <div id="switchContainer">
        <div class="inner-switchContainer">
            <div class="switchToggle" id="vers-list">
                <p class="toList">Liste (490)</p>
            </div>
            <div class="switchToggle" id="vers-carte">
                <p class="toMap">Carte (490)</p>
            </div>
        </div>
        <div class="inner-switchContainer" id='toggle-switchContainer'>
            <div class="switchToggle" id="vers-list">
                <p class="toList">Liste (490)</p>
            </div>
            <div class="switchToggle" id="vers-carte">
                <p class="toMap">Carte (490)</p>
            </div>
        </div>
    </div>
    <div style="position: absolute; width: 100%; height: 100%; transition-duration: 0.7s;" class="UP" id="all">
        <div id="main-container">
            <iframe style="position: absolute; z-index: 1; top: 0px; overflow: hidden; border: hidden;" id="iframeCarte" title="carte" src="{{route('carte')}}" width="100%"></iframe>
            <div id="Categories">
                @foreach($Categories as $Categorie)
                    <p id="{{  $Categorie->nom }}" class="Categorie">{{  $Categorie->nom }}</p>
                @endforeach
            </div>
            <p>Selected: <strong id="address-value">none</strong></p>
            <div id="cadre">
                <div id="categoriesSelected" style="display: block; width: 100%;">
                    <div id="filtre1" class="categorieSelected"></div>
                    <div id="filtre2" class="categorieSelected"></div>
                    <div id="filtre3" class="categorieSelected"></div>
                </div>
                <div id="inputsCadre">
                    <div style="font-size: 1.2em;" class="inputCadre">
                        <input id="inputCategorie" type="text" placeholder="Catégorie (max 3)" name="categorie">
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
                    <br>
                    <div style="font-size: 1.2em; width: 100%; margin-top: 5px;" class="inputCadre">
                        <input type="search" id="adresse" placeholder="Choisis un lieu..." required>
                    </div>
                </div>
                <button type="button" class="btn" id="chercher" onclick="search()"><i class="fas fa-search"></i></button>
            </div>
        </div>
        <div id="list">
            <div class="row justify-content-center list" id="row">
            </div>
        </div>
        <img id="imgGIF" src="{{ asset('img/wait.gif')}}">
    </div>
    <script src="{{ asset('js/lodash.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/maps.js') }}"></script>
    <script type="text/javascript">
        function getCookie(cname) {
            var name = cname + "=";
            var decodedCookie = decodeURIComponent(document.cookie);
            var ca = decodedCookie.split(';');
            for(var i = 0; i < ca.length; i++) {
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
    </script>
    <script>
        $(document).ready(function(){
            document.cookie = "Url=";
            $("#inputCategorie").focusin(function(){
                $("#Categories").css("display", "block");
            });
            $(".Categorie").click(function(){
                for(var i=1; i <= 3; i++){
                    if(document.getElementById('filtre'+i).innerText == ''){
                        document.getElementById(this.innerText).style.display = 'none';
                        document.getElementById('filtre'+i).innerHTML = this.innerText+'<i style="color: red;  cursor: pointer;  float: right;  margin-top: 3px;" onclick="deleteCategorieSelected(this);" class="fas fa-times"></i>';
                        document.getElementById('filtre'+i).style.display = 'inline-block';
                        var val = getCookie('Url')+'&filtre'+i+'='+this.innerText;
                        document.cookie = "Url="+val;
                        break;
                    }
                }
            });
            $("#inputCategorie").blur(function(e){
                setTimeout(function () {
                    if (e.type == 'blur') {
                        $("#Categories").css("display", "none");
                    }
                }, 150);
            });
            $("#inputCategorie").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#Categories p").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
        function deleteCategorieSelected(elem){
            document.getElementById($(elem).parent()[0].innerText).style.display = 'block';
            document.getElementById($(elem).parent()[0].id).style.display = 'none';
            document.getElementById($(elem).parent()[0].id).innerHTML = '';
            var content = []
            for(var i=1; i <= 3; i++){
                if(document.getElementById('filtre'+i).innerHTML != '')
                    content[i] = '&filtre'+i+'='+document.getElementById('filtre'+i).innerText;
                else
                    content[i] = '';
            }
            document.cookie = "Url="+content[1]+content[2]+content[3];
            document.getElementById('inputCategorie').disabled = false;
        }
    </script>
    <script>
        document.getElementById('iframeCarte').height = window.innerHeight;
        function search() {
            if(document.getElementById('adresse').value == '')
                document.cookie = "LocalisationSearch=";
            document.getElementById('iframeCarte').src = '{{route('carte')}}/search';
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
                try {
                    getMapData();
                } finally {
                    toggleContainer.style.clipPath = 'inset(0 0 0 50%)';
                    toggleContainer.style.backgroundColor = 'black';
                }
            } else {
                toggleContainer.style.clipPath = 'inset(0 50% 0 0)';
                toggleContainer.style.backgroundColor = 'black';
            }
        };
    </script>
    <script src="https://cdn.jsdelivr.net/npm/places.js@1.9.0"></script>
    <script>
        (function() {
            var placesAutocomplete = places({
                container: document.querySelector('#adresse')
            });
            var $address = document.querySelector('#address-value');
            document.getElementById("algolia-places-listbox-0").style.top = '-320px';
            document.getElementById("algolia-places-listbox-0").style.color = 'black';
            placesAutocomplete.on('change', function(e) {
                $address.textContent = e.suggestion.value;
                document.cookie = "LocalisationSearch="+$address.textContent+', '+e.suggestion.latlng.lat+', '+e.suggestion.latlng.lng;
            });
            placesAutocomplete.on('clear', function() {
                $address.textContent = 'none';
                document.cookie = "LocalisationSearch=";
            });
        })();
    </script>
    <script type="text/javascript" src="{{ asset('js/infiniteScroll.js') }}"></script>

@endsection

