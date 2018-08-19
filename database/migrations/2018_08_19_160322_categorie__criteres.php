<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CategorieCriteres extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorie_criteres', function (Blueprint $table) {
            $table->engine = 'InnoDB';
//            $table->increments('id_reponse');
            $table->integer('id_categories')->unsigned();
            $table->integer('id_criteres')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categorie_criteres');
    }
}
