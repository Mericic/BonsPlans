@extends('layouts.app')

@section('content')
<body>
    <div id="image_haut">
        <img src="{{ asset($images[0]->path) }}" alt="{{ $images[0]->nom_image }}"/>
        <h1>{{ $contenu->nom_contenu }}</h1>
    </div>
<div id="description" class="container-fluid">
    <div class="row">
        <section id="criteres" class="col-sm">
            <h2  style="text-decoration: underline">Criteres (qualité notée par la communauté)</h2>
            <div class="row">
            @foreach($criteres as $critere)
                <div class="critere col-6" >
                    <p>{{ $critere->nom_critere }}</p>
                    <div class="div_progress">
                        @if(Auth::check() && $critere->prenom == '')
                            <i id="moins_{{ $critere->id_critere }}" class="clicable fas fa-minus-circle" onclick="votemoins({{ $contenu->id_contenu }}, {{ $critere->id_critere }})" style="color: red; float: left;"> </i>
                        @endif
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: {{ $critere->moyenne*100 }}%; background-color: red;"  aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        @if(Auth::check()  && $critere->prenom == '')
                            <i id="plus_{{ $critere->id_critere }}" class="clicable fas fa-plus-circle"  onclick="voteplus({{ $contenu->id_contenu }}, {{ $critere->id_critere }})" style="color: green; float: right"> </i>
                        @endif
                    </div>
                </div>
            @endforeach
            </div>
        </section>
        <section id="categories" class="col-sm">
            <p  style="text-decoration: underline">Catégories</p>
            <div class="row">
                @foreach($categories as $categorie)
                    <div class="categorie col">
                        <p>{{ $categorie->nom_categorie }}</p>
                    </div>
                @endforeach
            </div>


        </section>
    </div>
    <div class="row">
        <section id="descriptiondetaillee" class="col-sm">
            <h2 class="col-sm-12"  style="text-decoration: underline">Description détaillée</h2>
            <div class="row">
                <p class="col-sm-6">Adresse : {{ $contenu->adresse }}</p>
                <p class="col-sm-6">Créateur :  {{ $contenu->pseudo }}</p>
                <p class="col-sm">{{ $contenu->description }}</p>
            </div>

        </section>
        <section id="commentaires" class="col-sm">
            <h2 class="col-sm-12"  style="text-decoration: underline">Commentaires des voyageurs</h2>
            <div class="row">
            @foreach($commentaires as $commentaire)
                <div class="commentaire col-sm-6">
                    <p style="text-decoration: underline">{{ $commentaire->pseudo }}</p>
                    <p>{{ $commentaire->Commentaire }}</p>
                    @if($commentaire->Reponse!='')
                        <div class="reponse">
                            <p style="text-decoration: underline">L'organisateur a répondu</p>
                            <p>{{ $commentaire->Reponse }}</p>
                        </div>
                    @endif
                </div>
            @endforeach
            </div>
            @if(Auth::check())
            <button class="btn btn-secondary">Ajoutez votre commentaire</button>
            @endif
        </section>
    </div>
</div>
    <script>
        function votemoins(id_contenu, id_critere){
                    @if(Auth::check())
            var id_profil = {{ Auth::user()->id }};
            @endif

            $.ajax({
                method: 'post',
                url: "{{ action('ContenuController@categorie_vote_moins') }}",
                data : {'id_user': id_profil, 'id_contenu': id_contenu, 'id_critere': id_critere}
            }).done(function(data){
                if(data==2){
                    console.log('deja voté');
                }else if(data==200)
                    console.log('vote pris en compte');
                else
                    console.log('must be a mistake somewhere');
                $('#moins_'+id_critere).hide();
                $('#plus_'+id_critere).hide();
            })


        }

        function voteplus(id_contenu, id_critere){
                    @if(Auth::check())
            var id_profil = {{ Auth::user()->id }};
            @endif
            $.ajax({
                method: 'post',
                url: "{{ action('ContenuController@categorie_vote_plus') }}",
                data : {'id_user': id_profil, 'id_contenu': id_contenu, 'id_critere': id_critere}
            }).done(function(data){
                if(data==2){
                    console.log('deja voté');
                }else if(data==200)
                    console.log('vote pris en compte');
                else
                    console.log('must be a mistake somewhere');
                $('#moins_'+id_critere).hide();
                $('#plus_'+id_critere).hide();
            })

        }
    </script>


</body>

@endsection