<?php

namespace App\Http\Controllers;

use App\Commentaire;
use Illuminate\Http\Request;

class CommentaireController extends Controller
{
    public function addCommentaire(Request $request){
        $commentaire = new Commentaire();
        $commentaire->id_Contenu = $request->id_Contenu;
        $commentaire->id_User = $request->id_User;
        $commentaire->Commentaire = $request->Commentaire;
        $commentaire->pertinence = 0;
        $commentaire->save();
        return back();
    }
}
