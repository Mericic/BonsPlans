<?php

namespace App\Http\Controllers;

use App\Categorie;
use App\Critere;
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
        $categorie = Categorie::getAllCategorie();
        return view('accueil')->with(['Categories'=>$categorie]);
    }

    public function profil($pseudo) {

        $user = User::getInfoByPseudo($pseudo);
        $picture=(object)'profilePic';
        $picture->path=$user->path;
        $picture->nom=$user->nom;

        return view('pages.profiltest')->with([
            'user'=>$user, 
            'commentaires'=>$user->commentaires,
            'profilePic'=>$picture,
            'contenus'=>$user->contenus
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
            ->with(['contenu'=>$contenu->contenu, 'images'=>$contenu->images, 'categories'=>$contenu->categories, 'criteres'=>$contenu->criteres, 'commentaires'=>$contenu->commentaires, 'commentaire_User'=>$commentaire_User]);
    }


    public function addContenu(Request $request){
        if(!Auth::check())
            return redirect('/login');
        $categorie = Categorie::getAllCategorie();     
        $critere = Critere::all();
        return view('pages.creationContenu')->with(['Categories'=>$categorie, 'Criteres'=>$critere]);
    }

}
