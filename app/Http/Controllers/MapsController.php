<?php

namespace App\Http\Controllers;

use App\Contenu;
use Illuminate\Http\Request;

class MapsController extends Controller
{
    public function getContenuStart($latitude, $longitude){
        $Contenu = Contenu::join('users', 'contenus.id_User', '=', 'users.id')
            ->select('users.pseudo', 'contenus.*')
            ->where('contenus.CoordonneesX', '<=', $latitude + 0.012)
            ->where('contenus.CoordonneesY', '<=', $longitude + 0.012)
            ->where('contenus.CoordonneesX', '>=', $latitude - 0.012)
            ->where('contenus.CoordonneesY', '>=', $longitude - 0.012)
            ->distinct()
            ->get();
        return $Contenu;
    }
    public function getContenuZoom($lvl, $latitude, $longitude){
        switch ($lvl) {
            case "512":
                $zoom = 0.7;
                break;
            case "1024":
                $zoom = 0.35;
                break;
            case "2048":
                $zoom = 0.2;
                break;
            case "4096":
                $zoom = 0.4;
                break;
            case "8192":
                $zoom = 0.05;
                break;
            case "16384":
                $zoom = 0.012;
                break;
            case "32768":
                $zoom = 0.01;
                break;
            case "65536":
                $zoom = 0.005;
                break;
            case "131072":
                $zoom = 0.00075;
                break;
        }
        $Contenu = Contenu::join('users', 'contenus.id_User', '=', 'users.id')
            ->select('users.pseudo', 'contenus.*')
            ->where('contenus.CoordonneesX', '<=', $latitude + $zoom)
            ->where('contenus.CoordonneesY', '<=', $longitude + $zoom)
            ->where('contenus.CoordonneesX', '>=', $latitude - $zoom)
            ->where('contenus.CoordonneesY', '>=', $longitude - $zoom)
            ->distinct()
            ->get();
        return $Contenu;
    }

    public function doCircle($idContenu){

    }
}