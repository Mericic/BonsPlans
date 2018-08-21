<?php

namespace App\Http\Controllers;

use App\Contenu;
use App\votes_critere;
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
                'images' => $description->images,
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

    //return 2 si déjà voté, 200 si tout ok
    public function categorie_vote_plus(Request $request){
        //on regarde si il a pas déjà voté
        $dejavote = votes_critere::where('id_User', '=', $request->id_user)
            ->where('id_Contenu', '=', $request->id_contenu)
            ->where('id_Critere', '=', $request->id_critere)
            ->get();
//        dd($dejavote);

        if(count($dejavote))
            return 2;

            $vote = new votes_critere();
            $vote->id_User = $request->id_user;
            $vote->id_Contenu = $request->id_contenu;
            $vote->id_Critere = $request->id_critere;
            $vote->value = 1;
            $vote->save();
            return 200;
    }

    public function categorie_vote_moins(Request $request){
        //on regarde si il a pas déjà voté
        $dejavote = votes_critere::where('id_User', '=', $request->id_user)
            ->where('id_Contenu', '=', $request->id_contenu)
            ->where('id_Critere', '=', $request->id_critere)
            ->get();
//        dd($dejavote);

        if(count($dejavote))
            return 2;

        $vote = new votes_critere();
        $vote->id_User = $request->id_user;
        $vote->id_Contenu = $request->id_contenu;
        $vote->id_Critere = $request->id_critere;
        $vote->value = 0;
        $vote->save();
        return 200;
    }

    public function getAllCoordonnees(Request $request){

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



    public function addContenu(Request $request){

        $contenu = new Contenu();

        return back();
    }
}
