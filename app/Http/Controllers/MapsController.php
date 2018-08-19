<?php

namespace App\Http\Controllers;

use App\Contenu;
use Illuminate\Http\Request;

class MapsController extends Controller
{
    public function getContenuStart($latitude, $longitude){
        $Contenu = Contenu::join('users', 'contenus.id_User', '=', 'users.id')
            ->select('users.pseudo', 'contenus.*')
            ->where('contenus.CoordonneesX', '<=', $latitude + 0.005)
            ->where('contenus.CoordonneesY', '<=', $longitude + 0.005)
            ->where('contenus.CoordonneesX', '>=', $latitude - 0.005)
            ->where('contenus.CoordonneesY', '>=', $longitude - 0.005)
            ->distinct()
            ->get();
        return $Contenu;
    }

    public function doCircle($idContenu){

    }
}