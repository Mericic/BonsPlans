<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $primaryKey = 'id_Categorie';
    public $timestamps = false;


    public static function getIdFromNom($nom){
        $id = Categorie::where('nom', '=', $nom)
            ->select('id_Categorie')->first();
        return $id['id_Categorie'];
    }

    public static function getAllCategorie(){
        $id = Categorie::all();
        return $id;
    }

    public static function getCategories(){
        $categories = Categorie::all();
        $liste = "";
        foreach($categories as $categorie){
            $liste .= $categorie->id_Categorie." - ".$categorie->nom." "."\n";
        }
        return $liste;
    }

    public static function addCategorie($nom){
        $categorie = new Categorie();
        $categorie->nom = $nom;
        $categorie->save();
        return "id : ".$categorie->id_Categorie.", nom : ".$categorie->nom;
    }

    public static function delCategorie($id_Categorie){
        $categorie = Categorie::findOrFail($id_Categorie);
        $categorie->delete();
        return "categorie supprimé";
    }
}
