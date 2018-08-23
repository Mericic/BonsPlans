<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $primaryKey = 'id_Categorie';

    public static function getIdFromNom($nom){
        $id = Categorie::where('nom', '=', $nom)
            ->select('id_Categorie')->first();
        return $id['id_Categorie'];
    }

    public static function getAllCategorie(){
        $id = Categorie::all();
        return $id;
    }
}
