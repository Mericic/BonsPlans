<?php

namespace App\Http\Controllers;

use App\Contenu;
use App\User;
use App\Commentaire;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('accueil');
    }

    public function profil($pseudo){

        $user = User::where('pseudo', $pseudo) -> first();

        $commentaire = Commentaire::getCommentaireByUser($user->id);
        
        return view('pages.profil') ->with(['user'=>$user, 'commentaires'=>$commentaire]);
    }

    public function contenu($id_contenu){

        $contenu = new Contenu();
        $contenu->id_contenu = $id_contenu;
        $contenu->getContenu();

        return view('pages.detail_contenu')
            ->with(['contenu'=>$contenu->contenu[0], 'images'=>$contenu->images, 'categories'=>$contenu->categories, 'criteres'=>$contenu->criteres]);
    }
}
