<?php

namespace App\Http\Controllers;

use App\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function rechercheCategorie(Request $request){
        $ToutesCategories = Categorie::all();
        $nb_Categories = count($ToutesCategories);

        $Categories = [];


        for($i = 0; $i < $nb_Categories && count($Categories) < 10; $i++){
            if(stripos(strtolower($ToutesCategories[$i]->nom), strtolower($request->value))===0){
                array_push($Categories, $ToutesCategories[$i]->nom);
            }
        }

        echo implode('|', $Categories);
    }
    
}
