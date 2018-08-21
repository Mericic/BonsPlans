<?php

namespace App\Http\Controllers;

use App\Contenu;
use App\User;
use App\Commentaire;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function profil($pseudo) {

        $user = User::where('pseudo', $pseudo) -> first();
        
        $profilePic = User::getProfilePic($user->id);

        $commentaire = Commentaire::getCommentaireByUser($user->id);
        return view('pages.profiltest')->with([
            'user'=>$user, 
            'commentaires'=>$commentaire,
            'profilePic'=>$profilePic
        ]);
    }

    public function contenu($id_contenu){

        $contenu = new Contenu();
        $contenu->id_contenu = $id_contenu;
        $contenu->getContenu();

        if(Auth::check()){
            $commentaire_User = Commentaire::join('users', 'commentaires.id_user', '=', 'users.id')
                ->where('commentaires.id_contenu', '=', $id_contenu)->get();
        }else{
            $commentaire_User = "";
        }


        return view('pages.detail_contenu')
            ->with(['contenu'=>$contenu->contenu[0], 'images'=>$contenu->images, 'categories'=>$contenu->categories, 'criteres'=>$contenu->criteres, 'commentaires'=>$contenu->commentaires, 'commentaire_User'=>$commentaire_User]);
    }

}
