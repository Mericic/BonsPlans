<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Critere extends Model
{
    protected $primaryKey = 'id_Critere';

    public static function getIdFromNom($nom){
        $id = Critere::where('nom', '=', $nom)
            ->select('id_Critere')->first();
        return $id['id_Critere'];
    }

}
