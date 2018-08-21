<?php

namespace App\Http\Controllers;

use App\Critere;
use Illuminate\Http\Request;

class CritereController extends Controller
{
    public function rechercheCritere(Request $request){
        //on récupère tous les critères dans la base
        $TousCriteres = Critere::all();
        $nbCriteres = count($TousCriteres);

        $Criteres = [];


        for($i = 0; $i < $nbCriteres && count($Criteres) < 10; $i++){
            if(stripos(strtolower($TousCriteres[$i]->nom), strtolower($request->value))===0){
                array_push($Criteres, $TousCriteres[$i]->nom);
            }
        }

        echo implode('|', $Criteres);
    }
}
