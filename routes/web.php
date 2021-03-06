<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('accueil');

Route::get('/carte', function () {
    return view('carte');
})->name('carte');

Route::get('/carte/search', function () {
    return view('carte');
})->name('carte_search');

Route::get('/carte/contenu', function () {
    return view('carte');
})->name('carte_contenu');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('accueil');
Route::post('/commentaire/add', 'CommentaireController@addCommentaire')->name('ajout_commentaire');
Route::post('/reponse/add', 'CommentaireController@addReponse')->name('ajout_reponse');

Route::get('/profil/{pseudo}', 'HomeController@profil')->name('profil')->where(['pseudo'=>'[a-zA-Z0-9]+']);

Route::get('/profiltest/{pseudo}', 'HomeController@profil')->name('profil')->where(['pseudo'=>'[a-zA-Z0-9]+']);

Route::get('/contenu/{id_contenu}', 'HomeController@contenu')->name('contenu')->where(['id_contenu'=>'[0-9]{1,6}']);
Route::get('/contenu/creation', 'HomeController@addContenu')->name('addcontenu');
Route::post('/contenu/nouveau', 'ContenuController@addContenu')->name('addcontenuForm');
