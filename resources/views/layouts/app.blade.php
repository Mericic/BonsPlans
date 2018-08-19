<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <title>Linky's</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

</head>
<body>
<nav class="navbar navbar-expand-sm bg-light navbar-light">

    <ul class="navbar-nav">
        <li class="nav-item active">
            <a href="{{ route('accueil') }}"><img alt="petitLogo" src="{{ asset('img/logo.png')}}" width="60px"></a>
        </li>
    </ul>
    <ul class="navbar-nav mr-auto">
        <li class="nav-item">
            <a href="{{ route('accueil') }}"><h1>Tricky's</h1></a>
        </li>

    </ul>
    <ul class="navbar-nav">
        <li class="nav-item active">
            <a class="nav-link" href="#"><button type="button" class="btn btn-dark"><i class="fas fa-plus"></i>Ajouter un événement</button></a>
        </li>
    </ul>
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">Inscription</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Connexion</a>
        </li>
    </ul>
</nav>

@yield('content')

</body>
</html>