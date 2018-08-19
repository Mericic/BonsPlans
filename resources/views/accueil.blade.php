@extends('layouts.app')
@section('content')
    <div id="main-container">
        <iframe style="position: absolute; z-index: 1; top: 0px; overflow: hidden; border: hidden;" id="iframeCarte" title="carte" src="{{route('carte')}}" width="100%"></iframe>
        <div style="position: absolute; z-index: 2; margin-top: 10px; margin-left: 40%;">
            <input type="text" id="adresse">
            <button onclick="search()">Chercher</button>
        </div>
        <div id="cadre" class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    Tricky's
                </div>

                <div class="links">
                    <a href="#list"> &#8595; Visionner les evénements à venir &#8595; </a>
                </div>
            </div>
        </div>
    </div>
    <div id="list">
                <div class="links" id="vers-carte">
                    <a href="#main-container"> &#8593; Visionner la carte &#8593; </a>
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

