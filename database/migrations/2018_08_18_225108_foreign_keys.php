<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::table('users', function($table) {
//            $table->foreign('id_imageprofil')->references('id')->on('images');
//        });
//        Schema::table('images', function($table) {
//            $table->foreign('id_proprietaire')->references('id')->on('users');
//        });
//        Schema::table('votes', function($table) {
//            $table->foreign('id_Contenu')->references('id_Contenu')->on('contenu');
//            $table->foreign('id_User')->references('id')->on('users');
//        });
//        Schema::table('contenus', function($table) {
//            $table->foreign('id_User')->references('id')->on('users');
//        });
//        Schema::table('contenu_images', function($table) {
//            $table->foreign('id_Image')->references('id')->on('images');
//            $table->foreign('id_Contenu')->references('id_Contenu')->on('contenus');
//        });
//        Schema::table('contenu_categories', function($table) {
//            $table->foreign('id_Categorie')->references('id_Categorie')->on('categories');
//            $table->foreign('id_Contenu')->references('id_Contenu')->on('contenus');
//        });
//        Schema::table('categorie_criteres', function($table) {
//            $table->foreign('id_Categorie')->references('id_Categorie')->on('categories');
//            $table->foreign('id_Critere')->references('id_Critere')->on('criteres');
//        });
//        Schema::table('contenu_criteres', function($table) {
//            $table->foreign('id_Critere')->references('id_criteres')->on('criteres');
//            $table->foreign('id_Contenu')->references('id_contenu')->on('contenu');
//        });
//        Schema::table('vote_criteres', function($table) {
//            $table->foreign('id_User')->references('id')->on('users');
//            $table->foreign('id_Contenu')->references('id_contenu')->on('contenu');
//            $table->foreign('id_Critere')->references('id_critere')->on('critere');
//        });
//        Schema::table('commentaires', function($table) {
//            $table->foreign('id_Contenu')->references('id_Contenu')->on('contenu');
//            $table->foreign('id_User')->references('id')->on('users');
//        });
//        Schema::table('reponses', function($table) {
//            $table->foreign('id_Commentaire')->references('id_Commentaire')->on('commentaires');
//        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
