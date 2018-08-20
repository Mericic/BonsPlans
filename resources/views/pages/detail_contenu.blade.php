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
            <h2>Criteres (qualité notée par la communauté)</h2>
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
        <section id="categories" class="col-sm">
            <p>Catégories</p>
            <div class="row">
                @foreach($categories as $categorie)
                    <div class="categorie col">
                        <p>{{ $categorie->nom_categorie }}</p>
                    </div>
                @endforeach
            </div>


        </section>
    </div>

    <section id="descriptiondetaillee" class="row">
        <h2>Description détaillée</h2>
        <p>Adresse : {{ $contenu->adresse }}</p>
        <p>{{ $contenu->description }}</p>
    </section>
</div>


</body>

@endsection