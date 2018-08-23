@extends('layouts.app')

@section('content')

<body>
    <div id="image_haut">
        @if(count($images))
        <img src="{{ asset($images[0]->path) }}" alt="{{ $images[0]->nom_image }}"/>
        @else
            <img src="{{ asset('img/contenu/default/image.png') }}" alt="pas d'image"/>
        @endif
            <h1 style="background-color: #9BA2AB30">{{ $contenu->nom_contenu }}</h1>
    </div>

    <script>

        function dellComm(id_commentaire){
            $.ajax({
                method: 'post',
                url: "{{ action('CommentaireController@delCommentaire') }}",
                data : {'id_commentaire': id_commentaire}
            }).done(function(data){
                if(data==200){
                    $('#commentaire_'+id_commentaire).hide();
                    $('#commentaire_'+id_commentaire).hide();
                    $('#btn_commentaire').show();
                }
            })

        }

    </script>
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
                            <div class="progress-bar" role="progressbar" style="width: {{ $critere->moyenne*100 }}%; background-color: @if($critere->moyenne*100 >= 70) green @elseif($critere->moyenne*100 >= 40) orange @else red @endif;"  aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
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
            @if($commentaires)
            @foreach($commentaires as $commentaire)
                <div class="commentaire col-sm-6" id="commentaire_{{ $commentaire->id_commentaire }}">
                     @if(Auth::check())
                        @if($commentaire->id == Auth::user()->id)
                        <button type="button" class="close" onclick="dellComm({{ $commentaire->id_commentaire }})">
                            <span aria-hidden="true"><i class="fas fa-trash-alt" style="color: red;"></i></span>
                        </button>
                        @endif
                    @endif
                    <p style="text-decoration: underline">{{ $commentaire->pseudo }}</p>
                    <p>{{ $commentaire->Commentaire }}</p>
                    @if($commentaire->Reponse!='')
                        <div class="reponse">
                            <p style="text-decoration: underline">L'organisateur a répondu</p>
                            <p>{{ $commentaire->Reponse }}</p>
                        </div>
                    @elseif($contenu->id_user == Auth::user()->id && $commentaire->Reponse=='')
                        <button class="btn btn-secondary"  data-toggle="modal" data-target="#AjoutReponseModal" data-id_commentaire="{{ $commentaire->id_commentaire }}">Répondre</button>
                    @endif
                </div>
            @endforeach
            @endif
            </div>
            @if( Auth::check() && $contenu->id_user != Auth::user()->id)
            <button class="btn btn-secondary"  data-toggle="modal" id="btn_commentaire" data-target="#AjoutCommentaireModal" style="@if(count($commentaire_User)) display:none @endif">Ajoutez votre commentaire</button>
            @endif
        </section>
    </div>
    <div class="row">
        <iframe style="overflow: hidden; border: hidden; height: 500px; width: 100%;" id="iframeCarte" title="carte" src="{{route('carte')}}?contenu={{ $contenu->id_contenu }}" width="100%"></iframe>
    </div>
    </iframe>
</div>



    <div class="modal fade" id="AjoutCommentaireModal" tabindex="-1" role="dialog" aria-labelledby="AjoutCommentaireModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AjoutCommentaireModalLabel">Ajouter un Commentaire</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('ajout_commentaire') }}" id="CommentaireForm">
                        @csrf
                        @if(Auth::check())
                        <input type="hidden" name="id_User" value="{{ Auth::user()->id }}">
                        @endif
                        <input type="hidden" name="id_Contenu" value="{{ $contenu->id_contenu }}">

                        <div class="form-group row">
                            <label for="Commentaire" class="col-sm-4 col-form-label text-md-right">Commentaire</label>

                            <div class="col-md-6">

                                <textarea id="Commentaire" class="form-control" name="Commentaire"></textarea>
                                @if ($errors->has('Commentaire'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('Commentaire') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="$('#CommentaireForm').submit()">Enregistrer</button>
                </div>
            </div>
        </div>
    </div>
    @if(Auth::check() && $contenu->id_user == Auth::user()->id )
    <div class="modal fade" id="AjoutReponseModal" tabindex="-1" role="dialog" aria-labelledby="AjoutReponseModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AjoutReponseModalLabel">Ajouter une Réponse</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('ajout_reponse') }}" id="ReponseForm">
                        @csrf

                        <input type="hidden" id="id_Commentaire_reponse" name="id_Commentaire" value="{{ old('id_Commentaire') }}">

                        <div class="form-group row">
                            <label for="Reponse" class="col-sm-4 col-form-label text-md-right">Réponse</label>
                            <div class="col-md-6">
                                <textarea id="Reponse" class="form-control @if($errors->has('Reponse')) is-invalid @endif" name="Reponse" value="{{ old('Reponse') }}"></textarea>
                                @if ($errors->has('Reponse'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('Reponse') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="$('#ReponseForm').submit()">Enregistrer</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if ($errors->has('id_Commentaire'))
        <div class="alert alert-danger" role="alert">
            {{ $errors->first('id_Commentaire') }}
        </div>
    @endif
<script>
    $('#AjoutReponseModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id_commentaire = button.data('id_commentaire') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
//        $('#id_Commentaire_reponse').val(id_commentaire)
        modal.find('#id_Commentaire_reponse').val(id_commentaire)
        console.log('id_commentaire '+id_commentaire)
    })
</script>
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
        @if($errors->has('Reponse'))
                window.onload = function(){
            $('#AjoutReponseModal').modal('show')
        }
        @endif
    </script>
    @if (!$errors->isEmpty())
        <div class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

</body>

@endsection