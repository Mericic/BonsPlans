<?php

use App\Categorie;
use App\Critere;
use App\User;
use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');


Artisan::command('getCriteres', function(){
    $this->info(Critere::getCriteres());
})->describe('affiche tous les criteres actuellement stockés en base');

Artisan::command('addCriteres {nom}', function($nom){
    $this->info(Critere::addCritere($nom));
})->describe('ajout un critere dans la base, puis affiche son id et un rappel de son nom');

Artisan::command('delCriteres {id_Critere}', function($id_Critere){
    $this->info(Critere::delCritere($id_Critere));
})->describe('Supprime un critere grâce à son id');

Artisan::command('getCategories', function(){
    $this->info(Categorie::getCategories());
})->describe('affiche toutes les Catégories actuellement stockés en base');

Artisan::command('addCategorie {nom}', function($nom){
    $this->info(Categorie::addCategorie($nom));
})->describe('ajout une catégorie dans la base, puis affiche son id et un rappel de son nom');

Artisan::command('delCategorie {id_Categorie}', function($id_Categorie){
    $this->info(Categorie::delCategorie($id_Categorie));
})->describe('Supprime une categorie grâce à son id');

