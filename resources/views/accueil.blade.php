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
            <div id="cadre">
                <div id="inputsCadre">
                    <div style="font-size: 1.2em;" class="inputCadre">
                        <input type="text" id="adresse" placeholder="Choisis un lieu..." required>
                    </div>
                    <div style="font-size: 1.2em;" class="inputCadre">
                        <select id="categorie">
                            <option value='' disabled selected>Choisis un filtre...</option>
                            <option value='1'>1</option>
                            <option value='2'>2</option>
                            <option value='3'>3</option>
                            <option value='4'>4</option>
                        </select>
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
            <div class="newDiv"></div>
            <div class="newDiv"></div>
            <div class="newDiv"></div>
            <div class="newDiv"></div>
            <div class="newDiv"></div>
            <div class="newDiv"></div>
            <div class="newDiv"></div>
            <div class="newDiv"></div>
        </div>
        <img id="imgGIF" src="{{ asset('img/wait.gif')}}">
    </div>

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
                change('droite');
            }
        })

        document.getElementById('vers-carte').addEventListener('click', function() {
            if(toggleNumber != 'vers-carte'){
                toggleNumber = 'vers-carte';
                change('gauche');
            }

        })

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



@endsection

