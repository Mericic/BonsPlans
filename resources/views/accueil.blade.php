@extends('layouts.app')
@section('content')
    <div id="main-container">
        <iframe style="position: absolute; z-index: 1; top: 0px; overflow: hidden; border: hidden;" id="iframeCarte" title="carte" src="{{route('carte')}}" width="100%"></iframe>
        <a style="text-decoration: none;" class="buttonLinks" href="#list">
            <p class="links">&#8595; Voir la liste &#8595;</p>
        </a>
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
        <a class="buttonLinks" href="#main-container" id="vers-carte">
            <p class="links">&#8593; Voir la carte &#8593;</p>
        </a>
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
    </script>

@endsection

