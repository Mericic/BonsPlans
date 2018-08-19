@extends('layouts.app')
@section('content')
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
                <a href="#">Visionner les evénements à venir</a>
            </div>
        </div>
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

