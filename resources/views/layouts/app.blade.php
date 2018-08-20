<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <title>Tricky's</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
            <a class="nav-link" href="#"><button type="button" class="btn btn-dark"><i class="fas fa-plus"></i> &nbsp; Ajouter un événement</button></a>
        </li>
    </ul>
    <ul class="navbar-nav" style="background-color: rgba(128, 128, 128, 0.7)">
        @if(!Auth::check())
        <li class="nav-item">
            <a style="color: white" class="nav-link" href="{{ route('register') }}">Inscription</a>
        </li>
        <li class="nav-item">
            <a style="color: white" class="nav-link" data-toggle="modal" data-target="#ConnexionModal" id="boutonModal">Connexion</a>
        </li>
        @else
            <li class="nav-item">
                <a style="color: white" class="nav-link" href="{{ route('profil', ['pseudo'=>Auth::user()->pseudo]) }}">Mon Profil</a>
            </li>
            <li class="nav-item">
                <a style="color: white" class="nav-link" onclick="$('#formdeco').submit()">Deconnexion</a>
                <form method="post" action="{{  route('logout') }}" id="formdeco">@csrf</form>
            </li>
        @endif
    </ul>

</nav>

@yield('content')


<div class="modal fade" id="ConnexionModal" tabindex="-1" role="dialog" aria-labelledby="ConnexionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ConnexionModalLabel">Connexion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                    @csrf

                    <div class="form-group row">
                        <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Login') }}
                            </button>

                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" onclick="$('#repriseForm').submit()">Enregistrer</button>
            </div>
        </div>
    </div>
</div>

<script src="\js\smoothJump.js"></script>
<script src="\js\infiniteScroll.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>