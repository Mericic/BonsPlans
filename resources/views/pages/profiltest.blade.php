@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="card">
            <div class="card hovercard">
                <div class="card-background">
                    <img class="card-bkimg" alt="" src="{{ asset($profilePic->path) }}">
                </div>
                <div class="blur"></div>
                <div class="useravatar fg">
                    <img class="avatar mx-auto d-block" src="{{ asset($profilePic->path) }}" alt="Card image cap">
                </div>
                <div class="card-body fg">
                    <h5 class="card-title">{{ $user->pseudo }} <br> {{ ucfirst($user->first_name) }} {{  ucfirst($user->last_name) }}</h5>
                    <p class="card-text">Créé le :  {{ isset($user->created_at) ? $user->created_at->toDateString() : 'pas de date' }}</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-secondary profilBtn" onclick="showDivs('com-historique')"><i class="fas fa-comment-alt"></i> <p>Commentaires</p></button>
                <button type="button" class="btn btn-secondary profilBtn" onclick="showDivs('creation')"><i class="fas fa-plus"></i> <p>Creations</p></button>
            </div>
        </div>
        <div class="row justify-content-center">
            <div id="main-frame" class="col-11 col-sm-8">
                <div class="w3-content w3-display-container w3-animate-opacity">
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
                    <div id="creation" class="mySlides" style="margin: auto">
                        <div class="row justify-content-center">
                            @foreach($contenus as $contenu)
                                <a class="participation-div col-11 col-sm-5" href="{{ route('contenu', $contenu->id_Contenu) }}">
                                        <p class="participation-title">{{ $contenu->nom_contenu }}</p>
                                        <div class="participation-info">
                                            <div class="row justify-content-center">
                                                @foreach($contenu->votes as $vote)
                                                    <div class="progress .participation-bar col-11 col-sm-5">
                                                        <p>{{ $vote->nom_critere }}</p>
                                                        <div class="progress-bar" role="progressbar" style="width: {{ $vote->moyenne *100 }}%" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        showDivs('com-historique');

        function showDivs(id) {
            $('.mySlides').css('display', 'none');
            $('#' + id).css('display', 'block');
        }
    </script>

@endsection