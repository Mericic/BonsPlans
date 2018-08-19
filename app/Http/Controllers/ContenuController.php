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
        if($description != 0){
            return response()->json([
                'contenu' => $description
            ], 200);
        }else{
            return response()->json([
                'erreur' => $description
            ], 500);
        }
    }

    public function getAllCoordonnees(Request $request){
        //echo preg_match('#^(([1-9]{1,3})+,+([1-9]{5})+&+([1-9]{1,3})+,+([1-9]{5})+)+\|+(([1-9]{1,3})+,+([1-9]{5})+&+([1-9]{1,3})+,+([1-9]{5})+)+$#', '45,12345&45,12345|45,12345&45,12345');

        $request->validate([
            'perimetre' => 'required|max:20|regex:#^(([0-9]{1,3})+,+([0-9]{5})+&+([0-9]{1,3})+,+([0-9]{5})+)+\|+(([0-9]{1,3})+,+([0-9]{5})+&+([0-9]{1,3})+,+([0-9]{5})+)+$#',
            'categories' => 'nullable|json'
        ]);

        $contenu = new Contenu();
        $coordonnees = $contenu ->getAllCoordonnees($request->perimetre, $request->categories);

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
