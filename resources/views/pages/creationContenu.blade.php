@extends('layouts.app')

@section('content')

    <body>
    <div id="image_haut">
        <img src="{{ asset('/img/contenu/default/image.png') }}" alt="image par défaut"/>
        <input type="text" style="margin: auto" class="form-control col-4" value="Titre" />
        <input type="file" class="form-control-file col-4" style="margin:auto; margin-top: 5px; font-size: 1em!important;"/>
    </div>

    <div id="description" class="container-fluid">
        <div class="row">
            <section id="criteres" class="col-sm">
                <h2  style="text-decoration: underline">Criteres (qualité notée par la communauté)</h2>
                <div class="row">
                    <div class="critere col-6" >
                        <p class="col">Critère 1</p>
                    </div><div class="critere col-6" >
                        <p class="col">Critère 1</p>
                    </div><div class="critere col-6" >
                        <p class="col">Critère 1</p>
                    </div>
                    <button class="col btn btn-outline-dark">Ajouter un critère de vote</button>

            </section>
            <section id="categories" class="col-sm">
                <p  style="text-decoration: underline">Catégories</p>
                <div class="row">
                        <div class="categorie col">
                            <p>Catégorie</p>
                        </div>
                    <button class="col btn btn-outline-dark">Ajouter un critère de vote</button>

                </div>


            </section>
        </div>
        <div class="row">
            <section id="descriptiondetaillee" class="col-sm">
                <h2 class="col-sm-12"  style="text-decoration: underline">Description détaillée</h2>
                <div class="row">
                   <textarea class="form-control">Saisissez une description détaillée</textarea>
                </div>

            </section>

        </div>

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
                        {{--@if(Auth::check())
                            <input type="hidden" name="id_User" value="{{ Auth::user()->id }}">
                        @endif--}}
                        <input type="hidden" name="id_Contenu" value="{{--{{ $contenu->id_contenu }}--}}">
                        {{--<div class="form-group row">
                            <label for="note" class="col-sm-4 col-form-label text-md-right">Note</label>

                            <div class="col-md-6">
                                <input id="note" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>--}}

                        <div class="form-group row">
                            <label for="Commentaire" class="col-sm-4 col-form-label text-md-right">Commentaire</label>

                            <div class="col-md-6">

                                <textarea id="Commentaire" class="form-control" name="Commentaire"></textarea>
                                {{--@if ($errors->has('Commentaire'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('Commentaire') }}</strong>
                                    </span>
                                @endif--}}
                            </div>
                        </div>


                        {{--<div class="form-group row mb-0">--}}
                        {{--<div class="col-md-8 offset-md-4">--}}
                        {{--<button type="submit" class="btn btn-primary">--}}
                        {{--{{ __('Connexion') }}--}}
                        {{--</button>--}}

                        {{--<a class="btn btn-link" href="{{ route('password.request') }}">--}}
                        {{--{{ __('Mot de passe oublié ?') }}--}}
                        {{--</a>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="$('#CommentaireForm').submit()">Enregistrer</button>
                </div>
            </div>
        </div>
    </div>
    {{--@if(Auth::check() && $contenu->id_user == Auth::user()->id )
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
    @endif--}}

    @if ($errors->has('id_Commentaire'))
        <div class="alert alert-danger" role="alert">
            {{ $errors->first('id_Commentaire') }}
        </div>
    @endif



    </body>

@endsection