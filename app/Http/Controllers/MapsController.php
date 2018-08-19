<?php

namespace App\Http\Controllers;

use App\Contenu;
use Illuminate\Http\Request;

class MapsController extends Controller
{
    public function getInfoContenu($idContenu){
        $Contenu = Contenu::where('contenu.id_Contenu', '=', $idContenu)
            ->get();
        return $Contenu;
    }

    public function doCircle($idContenu){

    }
}