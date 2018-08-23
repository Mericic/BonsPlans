<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Critere extends Model
{
    protected $primaryKey = 'id_Critere';
    public $timestamps = false;

    public static function getIdFromNom($nom){
        $id = Critere::where('nom', '=', $nom)
            ->select('id_Critere')->first();
        return $id['id_Critere'];
    }

    public static function getCriteres(){
        $criteres = Critere::all();
        $liste = "";
        foreach($criteres as $critere){
            $liste .= $critere->id_Critere." - ".$critere->nom." "."\n";
        }
        return $liste;
    }

    public static function addCritere($nom){
        $critere = new Critere();
        $critere->nom = $nom;
        $critere->save();
        return "id : ".$critere->id_Critere.", nom : ".$critere->nom;
    }

    public static function delCritere($id_Critere){
        $critere = Critere::findOrFail($id_Critere);
        $critere->delete();
        return "critere supprimé";
    }

}
