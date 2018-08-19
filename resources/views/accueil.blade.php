@extends('layouts.app')
@section('content')
    <iframe style="position: absolute; z-index: 1; top: 0px; overflow: hidden; border: hidden;" id="iframeCarte" title="carte" src="{{route('carte')}}" width="100%"></iframe>
    <div id="cadre" class="position-ref full-height">
        <div>
            <div style="font-size: 1.2em; width: 45%; float: left;" class="form-group">
                <label>Lieu: </label>
                <input type="text" id="adresse" class="form-control" placeholder="Lyon">
            </div>
            <div style="font-size: 1.2em; width: 45%; float: right;" class="form-group">
                <label>Catégorie: </label>
                <select class="form-control">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                </select>
            </div>
            <center>
                <p id="valueRange"></p>
                <input id="range" type="range" class="custom-range" style="color: black"><br><br>
                <button type="button" class="btn btn-dark" onclick="search()">Chercher</button>
                <br>
                <div class="links">
                    <a href="#">Visionner les evénements à venir</a>
                </div>
            </center>
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
        var slider = new Slider("#range");
        slider.on("slide", function(sliderValue) {
            document.getElementById("valueRange").textContent = sliderValue;
        });
    </script>
@endsection

