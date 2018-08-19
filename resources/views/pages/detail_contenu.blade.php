@extends('layouts.app')

@section('content')
<body>
    <div id="image_haut">
        <img src="{{ asset($images[0]->path) }}" alt="{{ $images[0]->nom_image }}"/>
        <h1>{{ $contenu->nom_contenu }}</h1>
        <a href="#description"><button><i class="fas fa-angle-double-down"></i></button></a>
    </div>
<div id="description">
    <section id="criteres">
        @foreach($criteres as $critere)
            <div class="critere">
                <p>{{ $critere->nom_critere }}</p>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        @endforeach
    </section>
    <section id="categories">
        @foreach($categories as $categorie)
            <div class="categorie">
                <p>{{ $categorie->nom_categorie }}</p>
            </div>
        @endforeach

    </section>
</div>


</body>

@endsection