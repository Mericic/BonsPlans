<?php

namespace App\Http\Controllers;

use App\Categorie;
use App\Contenu;
use App\ContenuCategorie;
use App\ContenuCritere;
use App\ContenuImage;
use App\Critere;
use App\Image;
use App\votes_critere;
use Criteres;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;

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


    public function addContenu(Request $request){
        if(!Auth::check())
            return redirect('/login');

        if (!Input::hasFile('imageContenu'))
            return 'Pas d\'image';

        if(!Input::file('imageContenu')->isValid())
            return 'Image invalide';

        $contenu = new Contenu();
        $contenu->id_User = Auth::id();
        $contenu->nom_contenu = $request->titre;
        $contenu->Description = $request->description;
        $contenu->Annonce = 0;
        $contenu->Date = $request->date;
        $contenu->CoordonneesX = "45.459529";
        $contenu->CoordonneesY = "6.697969";
        $contenu->Adresse = "Par là";
        $contenu->save();
        $id = $contenu->id_Contenu;

        $path = 'img/contenu/'.$id;
        File::makeDirectory($path);
        $name = Input::file('imageContenu')->getClientOriginalName();
        Input::file('imageContenu')->move(public_path().'/'.$path, $name);


        $image = new Image();
        $image->nom = $name;
        $image->path = $path.'/'.$name;
        $image->id_proprietaire = Auth::id();
        $image->save();
        $id_image = $image->id;

        $contenu_image = new ContenuImage();
        $contenu_image->id_Image = $id_image;
        $contenu_image->id_Contenu = $id;
        $contenu_image->save();

        $criteres =explode ( "|", $request->inputCriteres );
        unset($criteres[count($criteres)-1]);
        foreach($criteres as $critere){
            $id_critere = Critere::getIdFromNom($critere);
            $contenu_critere = new ContenuCritere();
            $contenu_critere->id_Critere = $id_critere;
            $contenu_critere->id_Contenu = $id;
            $contenu_critere->save();
        }

        $categories =explode ( "|", $request->inputCategories );
        unset($categories[count($categories)-1]);
        foreach($categories as $categorie){
            $id_categorie = Categorie::getIdFromNom($categorie);
            $contenu_categorie= new ContenuCategorie();
            $contenu_categorie ->id_Categorie = $id_categorie;
            $contenu_categorie ->id_Contenu	= $id;
            $contenu_categorie->save();
        }
        return redirect('/contenu/'.$id);
    }

    public function getContenuApi(Request $request){
        $contenu = Contenu::getContenuBRUT($request->id_Contenu);
//        $contenu->
        return response()->json([
            'contenu' => $contenu,
            'criteres' => $contenu->criteres,
            'categories' => $contenu->categories,
            'images' => $contenu->images,
            'commentaires' => $contenu->commentaires,
        ], 200);
    }

}
