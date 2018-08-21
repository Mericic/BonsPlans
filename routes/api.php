<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/contenu/{id_contenu}', 'ContenuController@getContenu')->where('id_contenu', '[0-9]{1,6}')->name('getContenu');
Route::get('/contenu/start/{latitude}/{longitude}', 'MapsController@getContenuStart')->name('getContenuStart');
Route::get('/contenu/zoom/{lvl}/{latitude}/{longitude}', 'MapsController@getContenuZoom')->name('getContenuZoom');


Route::get('/contenu/getAllCoordonnees', 'ContenuController@getAllCoordonnees')->name('getAllCoordonnees');

Route::post('/contenu/categorie/vote/plus', 'ContenuController@categorie_vote_plus')->name('categorie_vote_plus');
Route::post('/contenu/categorie/vote/moins', 'ContenuController@categorie_vote_moins')->name('categorie_vote_moins');


Route::post('/commentaire/delete', 'CommentaireController@delCommentaire')->name('delCommentaire');
