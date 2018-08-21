@extends('layouts.app')
@section('content')

<div class="container">
    <div class="card">
        <div class="card hovercard">
            <div class="card-background">
                <img class="card-bkimg" alt="" src="{{ asset($profilePic->path) }}">
            </div>
            <div class="useravatar fg">
                <img class="avatar mx-auto d-block" src="{{ asset($profilePic->path) }}" alt="Card image cap">
            </div>
            <div class="card-body fg">
                <h5 class="card-title">{{ $user->pseudo }} <br> {{ ucfirst($user->first_name) }} {{  ucfirst($user->last_name) }}</h5>
                <p class="card-text">Créé le : {{ isset(Auth::user()->created_at) ? Auth::user()->created_at->toDateString() : Auth::user()->email }}</p>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="btn-group" role="group" aria-label="Basic example">
            <button type="button" class="btn btn-secondary profilBtn" onclick="showDivs(1)"><i class="fas fa-star"></i> <p>Categories Favorites</p></button>
            <button type="button" class="btn btn-secondary profilBtn" onclick="showDivs('com-historique')"><i class="fas fa-comment-alt"></i> <p>Commentaires</p></button>
            <button type="button" class="btn btn-secondary profilBtn" onclick="showDivs('participation')"> <i class="fas fa-flag-checkered"></i> <p>Activite</p></button>
            <button type="button" class="btn btn-secondary profilBtn" onclick="showDivs('creation')"><i class="fas fa-plus"></i> <p>Creations</p></button>
        </div>
    </div>
    <div class="row justify-content-center">
        <div id="main-frame" class="col-11 col-sm-8">
            <div class="w3-content w3-display-container w3-animate-opacity">
                <div id="1" class="mySlides">
                    <div class="row justify-content-center">
                        <div class="col-11 col-sm-5 profil-progress">
                            <p>Categorie 1</p>
                            <div class="progress">
                                <div class="progress-bar .fav" role="progressbar" style="width: 95%" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="col-11 col-sm-5 profil-progress">
                            <p>Categorie 2</p>
                            <div class="progress">
                                <div class="progress-bar .fav" role="progressbar" style="width: 65%" aria-valuenow="3" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-11 col-sm-5 profil-progress">
                            <p>Categorie 3</p>
                            <div class="progress">
                                <div class="progress-bar .fav" role="progressbar" style="width: 55%" aria-valuenow="4" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="col-11 col-sm-5 profil-progress">
                            <p>Categorie 4</p>
                            <div class="progress">
                                <div class="progress-bar .fav" role="progressbar" style="width: 45%" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="com-historique" class="mySlides">
                    @foreach ($commentaires as $commentaire)
                        <div class="profil-com col-11 col-sm-7" style="margin: auto">
                            <p class="com-title"> {{ strtoupper($commentaire->nom_contenu) }} </p>
                            <div class="progress .com-bar">
                                <div class="progress-bar" role="progressbar" style="width: 45%" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="com-main"> {{ $commentaire->Commentaire }} </p>
                        </div>
                    @endforeach
                </div>
                <div id="participation" class="mySlides" style="margin: auto">
                    <div class="row justify-content-center">
                        <div class="participation-div col-11 col-sm-5">
                            <p class="participation-title">Participation-Title</p>
                            <div class="participation-info"> 
                                <div class="row justify-content-center"> 
                                    <div class="progress .participation-bar col-11 col-sm-5">
                                        <div class="progress-bar" role="progressbar" style="width: 45%" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100"><p>Categorie</p></div>
                                    </div>
                                    <div class="progress .participation-bar col-11 col-sm-5">
                                        <div class="progress-bar" role="progressbar" style="width: 45%" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100"><p>Categorie</p></div>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="progress .participation-bar col-11 col-sm-5">
                                        <div class="progress-bar" role="progressbar" style="width: 45%" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100"><p>Categorie</p></div>
                                    </div>
                                    <div class="progress .participation-bar col-11 col-sm-5">
                                        <div class="progress-bar" role="progressbar" style="width: 45%" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100"><p>Categorie</p></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="participation-div col-11 col-sm-5">
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
                    <div class="row justify-content-center">
                        <div class="participation-div col-11 col-sm-5">
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
                        <div class="participation-div col-11 col-sm-5">
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
                </div>
                <div id="creation" class="mySlides" style="margin: auto">
                    <div class="row justify-content-center">
                        <div class="participation-div col-11 col-sm-5">
                            <p class="participation-title">Participation-Title</p>
                            <div class="participation-info"> 
                                <div class="row justify-content-center"> 
                                    <div class="progress .participation-bar col-11 col-sm-5">
                                        <div class="progress-bar" role="progressbar" style="width: 45%" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100"><p>Categorie</p></div>
                                    </div>
                                    <div class="progress .participation-bar col-11 col-sm-5">
                                        <div class="progress-bar" role="progressbar" style="width: 45%" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100"><p>Categorie</p></div>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="progress .participation-bar col-11 col-sm-5">
                                        <div class="progress-bar" role="progressbar" style="width: 45%" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100"><p>Categorie</p></div>
                                    </div>
                                    <div class="progress .participation-bar col-11 col-sm-5">
                                        <div class="progress-bar" role="progressbar" style="width: 45%" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100"><p>Categorie</p></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="participation-div col-11 col-sm-5">
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
                    <div class="row justify-content-center">
                        <div class="participation-div col-11 col-sm-5">
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
                        <div class="participation-div col-11 col-sm-5">
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
                </div>
            </div>
        </div>
    </div>
</div>
<script>
showDivs(1);

function showDivs(id) {
    $('.mySlides').css('display', 'none');
    $('#' + id).css('display', 'block');
}
</script>

@endsection