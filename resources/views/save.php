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
            <a class="nav-link" href="{{ route('addcontenu') }}"><button type="button" class="btn btn-dark"><i class="fas fa-plus"></i> &nbsp; Ajouter un événement</button></a>
        </li>
    </ul>
    <ul class="navbar-nav" id="auth" style="background-color: rgba(128, 128, 128, 0.7)">
        @if(!Auth::check())
        <li class="nav-item">
            <a style="color: white" class="nav-link" href="{{ route('register') }}">Inscription</a>
        </li>
        <li class="nav-item">
            <a style="color: white" class="nav-link" data-toggle="modal" data-target="#ConnexionModal" id="boutonModal">Connexion</a>
        </li>
        @else
            <li class="nav-item">
                <a style="color: white" class="nav-link" href="{{ route('profil', ['pseudo'=>Auth::user()->pseudo]) }}"><i class="fas fa-user"></i> Mon Profil</a>
            </li>
            <li class="nav-item">
                <a style="color: white" class="nav-link" onclick="$('#formdeco').submit()">Deconnexion</a>
                <form method="post" action="{{  route('logout') }}" id="formdeco">@csrf</form>
            </li>
        @endif
    </ul>

</nav>