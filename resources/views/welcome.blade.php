<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

        <title>Linky's</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-sm bg-light navbar-light">

            <ul class="navbar-nav">
                <li class="nav-item active">
                    <img alt="petitLogo" src="{{ asset('img/logo.png')}}" width="60px">
                </li>
            </ul>
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Disabled</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#"><button type="button" class="btn btn-dark"><i class="fas fa-plus"></i> &nbsp; Ajouter un événement</button></a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#">Inscription</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Connexion</a>
                </li>
            </ul>
        </nav>
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
    </body>
</html>
