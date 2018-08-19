@extends('layouts.app')
@section('content')
    <iframe style="position: absolute; z-index: 1; margin-top: 0px; overflow: hidden; border: hidden;" id="iframeCarte" title="carte" src="{{URL::to('/')}}/carte.php" width="100%"></iframe>
        <div style="position: absolute; z-index: 2; margin-top: 10px; margin-left: 40%;">
            <input type="text" id="adresse">
            <button onclick="search()">Chercher</button>
        </div>
        <div style="position: absolute; z-index: 2;" class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Documentation</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div>
        <img style="position: absolute; z-index: 0; width: 200px; display: block; left: 45%; top: 35%;" src="images/wait.gif">
        <script>
            document.getElementById('iframeCarte').height = window.innerHeight;
            function search() {
                if(document.getElementById('adresse').value != ""){
                    var adress = document.getElementById('adresse').value;
                    adress = adress.replace(' ', '%20');

                    document.getElementById('iframeCarte').src = 'carte.html?'+adress;
                    console.log(document.location.href);
                }
            }
        </script>
@endsection

