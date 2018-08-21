@extends('layouts.app')


@section('content')

<div id="profile-container">
    <div id="user-info-container">
        <div id="profile-picture"><img id="avatar" src="{{ asset($profilePic->path) }}"></div>
        <div id="username">{{ $user->pseudo }} <br> {{ ucfirst($user->first_name) }} {{  ucfirst($user->last_name) }}  </div>
        <div id="user-info">Créé le : {{ isset(Auth::user()->created_at) ? Auth::user()->created_at->toDateString() : Auth::user()->email }} </div>
    </div>
    <div id="profile-wrapper">
        <div id="fav-categories">
            <div class="profil-progress">
                <p>Categorie 1</p>
                <div class="progress">
                    <div class="progress-bar .fav" role="progressbar" style="width: 95%" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <div class="profil-progress">
                <p>Categorie 2</p>
                <div class="progress">
                    <div class="progress-bar .fav" role="progressbar" style="width: 65%" aria-valuenow="3" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <div class="profil-progress">
                <p>Categorie 3</p>
                <div class="progress">
                    <div class="progress-bar .fav" role="progressbar" style="width: 55%" aria-valuenow="4" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <div class="profil-progress">
                <p>Categorie 4</p>
                <div class="progress">
                    <div class="progress-bar .fav" role="progressbar" style="width: 45%" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
        <div id="com-historique">
            @foreach ($commentaires as $commentaire)
            <div class="profil-com">
                <p class="com-title"> {{ strtoupper($commentaire->nom_contenu) }} </p>
                <div class="progress .com-bar">
                    <div class="progress-bar" role="progressbar" style="width: 45%" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="com-main"> {{ $commentaire->Commentaire }} </p>
            </div>
            @endforeach
        </div>
        <div id="participation">
            <div class="participation-div">
                <p class="participation-title">Participation-Title</p>
                <div class="participation-info"> 
                    <div class="progress .participation-bar">
                        <div class="progress-bar" role="progressbar" style="width: 45%" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100"><p>Categorie</p></div>
                    </div>
                    <div class="progress .participation-bar">
                        <div class="progress-bar" role="progressbar" style="width: 45%" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100"><p>Categorie</p></div>
                    </div>
                    <div class="progress .participation-bar">
                        <div class="progress-bar" role="progressbar" style="width: 45%" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100"><p>Categorie</p></div>
                    </div>
                    <div class="progress .participation-bar">
                        <div class="progress-bar" role="progressbar" style="width: 45%" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100"><p>Categorie</p></div>
                    </div>
                </div>
            </div>
            <div class="participation-div">
                <p class="participation-title">Participation-Title</p>
                <div class="participation-info"> 
                    <div class="progress .participation-bar">
                        <div class="progress-bar" role="progressbar" style="width: 45%" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100"><p>Categorie</p></div>
                    </div>
                    <div class="progress .participation-bar">
                        <div class="progress-bar" role="progressbar" style="width: 45%" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100"><p>Categorie</p></div>
                    </div>
                    <div class="progress .participation-bar">
                        <div class="progress-bar" role="progressbar" style="width: 45%" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100"><p>Categorie</p></div>
                    </div>
                    <div class="progress .participation-bar">
                        <div class="progress-bar" role="progressbar" style="width: 45%" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100"><p>Categorie</p></div>
                    </div>
                </div>
            </div>
            <div class="participation-div">
                <p class="participation-title">Participation-Title</p>
                <div class="participation-info"> 
                    <div class="progress .participation-bar">
                        <div class="progress-bar" role="progressbar" style="width: 45%" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100"><p>Categorie</p></div>
                    </div>
                    <div class="progress .participation-bar">
                        <div class="progress-bar" role="progressbar" style="width: 45%" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100"><p>Categorie</p></div>
                    </div>
                    <div class="progress .participation-bar">
                        <div class="progress-bar" role="progressbar" style="width: 45%" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100"><p>Categorie</p></div>
                    </div>
                    <div class="progress .participation-bar">
                        <div class="progress-bar" role="progressbar" style="width: 45%" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100"><p>Categorie</p></div>
                    </div>
                </div>
            </div>
            <div class="participation-div">
                <p class="participation-title">Participation-Title</p>
                <div class="participation-info"> 
                    <div class="progress .participation-bar">
                        <div class="progress-bar" role="progressbar" style="width: 45%" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100"><p>Categorie</p></div>
                    </div>
                    <div class="progress .participation-bar">
                        <div class="progress-bar" role="progressbar" style="width: 45%" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100"><p>Categorie</p></div>
                    </div>
                    <div class="progress .participation-bar">
                        <div class="progress-bar" role="progressbar" style="width: 45%" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100"><p>Categorie</p></div>
                    </div>
                    <div class="progress .participation-bar">
                        <div class="progress-bar" role="progressbar" style="width: 45%" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100"><p>Categorie</p></div>
                    </div>
                </div>
            </div>
        </div>
        <div id="creation">
            <div class="participation-div">
                <p class="participation-title">Creation-Title</p>
                <div class="participation-info"> 
                    <div class="progress .participation-bar">
                        <div class="progress-bar" role="progressbar" style="width: 45%" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100"><p>Categorie</p></div>
                    </div>
                    <div class="progress .participation-bar">
                        <div class="progress-bar" role="progressbar" style="width: 45%" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100"><p>Categorie</p></div>
                    </div>
                    <div class="progress .participation-bar">
                        <div class="progress-bar" role="progressbar" style="width: 45%" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100"><p>Categorie</p></div>
                    </div>
                    <div class="progress .participation-bar">
                        <div class="progress-bar" role="progressbar" style="width: 45%" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100"><p>Categorie</p></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var participation = document.getElementById('participation');
    var participationDivs = document.getElementsByClassName('participation-div');
    var participationInfo = document.getElementsByClassName('participation-info');
    var height = participation.clientHeight;
    var h = height.toString() + 'px';
    for (i = 0; i < participationDivs.length; i++){
        participationDivs[i].style.height = h;
    }
    for (i = 0; i < participationInfo.length; i++){
        participationInfo[i].style.height = h;
    }
</script>


@endsection