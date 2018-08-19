<?php

namespace App\Http\Controllers;

use App\Contenu;
use Illuminate\Http\Request;

class ContenuController extends Controller
{
    public function getContenu($id_contenu){
        //dans request : id_contenu
        $contenu = new Contenu();
        $contenu->id_contenu = $id_contenu;
        $description = $contenu->getContenu();
//        dd($description->criteres);
        if($description){
            return response()->json([
                'contenu' => $description,
                'criteres' => $description->criteres,
                'categories' => $description->categories,
            ], 200);
        }else{
            return response()->json([
                'erreur' => $description
            ], 500);
        }
    }

    public function getContenus(Request $request){
        $request->validate([
            'perimetre' => 'required|max:20|regex:#^(([0-9]{1,3})+,+([0-9]{5})+&+([0-9]{1,3})+,+([0-9]{5})+)+\|+(([0-9]{1,3})+,+([0-9]{5})+&+([0-9]{1,3})+,+([0-9]{5})+)+$#',
            'categories' => 'nullable|json'
        ]);
        $contenu = new Contenu();

    }

    public function getAllCoordonnees(Request $request){
        //echo preg_match('#^(([1-9]{1,3})+,+([1-9]{5})+&+([1-9]{1,3})+,+([1-9]{5})+)+\|+(([1-9]{1,3})+,+([1-9]{5})+&+([1-9]{1,3})+,+([1-9]{5})+)+$#', '45,12345&45,12345|45,12345&45,12345');
        //json sous la forme :
        //{
        //      "perimetre" : regex,
        //      "categories" : [
        //          {"id_categorie" : "1"}, {"id_categorie" :"2"}
        //      ]
        //}
/*        $request->validate([
            'perimetre' => 'required|max:20',
            'categories' => 'nullable|json'
        ]);*/
//        dd('coucou');

        $categories =$request->input('categories');

        $contenu = new Contenu();
//        dd($request->perimetre);
        $contenu->getContenus($request->perimetre, $categories);


        $coordonnees = $contenu ->getAllCoordonnees();

        if($coordonnees!=''){
            return response()->json([
                'coordonnees' => $coordonnees
            ], 200);
        }else{
            return response()->json([
                'erreur' => $coordonnees
            ], 500);
        }


    }
}
