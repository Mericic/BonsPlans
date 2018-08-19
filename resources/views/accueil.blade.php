@extends('layouts.app')
@section('content')
    <div id="main-container">
        <iframe style="position: absolute; z-index: 1; top: 0px; overflow: hidden; border: hidden;" id="iframeCarte" title="carte" src="{{route('carte')}}" width="100%"></iframe>
        <div class="links">
            <a href="#list"> &#8595; Voir la liste &#8595; </a>
        </div>
        <div id="cadre">
                <div style="font-size: 1.2em;" class="form-group">
                    <input type="text" id="adresse" placeholder="Choisis un lieu..." required>
                </div>
                <div style="font-size: 1.2em;" class="form-group">
                    <select id="categorie">
                        <option value='' disabled selected>Choisis un filtre...</option>
                        <option value='1'>1</option>
                        <option value='2'>2</option>
                        <option value='3'>3</option>
                        <option value='4'>4</option>
                    </select>
                </div>
                <div id="rangeDiv">
                    <div style="font-size: 1.2em;" class="form-group">
                        <select id="range">
                            <option value='' disabled selected>Choisis un rayon...</option>
                            <option value='2000'>2000m</option>
                            <option value='1500'>1500m</option>
                            <option value='1000'>1000m</option>
                            <option value='500'>500m</option>
                        </select>
                    </div>
                    <button type="button" class="btn" id="chercher" onclick="search()">GO!</button>
                </div>
        </div>
    </div>  
    <div id="list">
                <div class="links" id="vers-carte">
                    <a href="#main-container"> &#8593; Voir la carte &#8593; </a>
                </div>
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
    <script src="\js\smoothJump.js"></script>
    <script src="\js\infiniteScroll.js"></script>
@endsection

