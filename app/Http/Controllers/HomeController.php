<?php

namespace App\Http\Controllers;

use App\Contenu;
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

//        $profil =

        return view('pages.profil');
    }

    public function contenu($id_contenu){

        $contenu = new Contenu();
        $contenu->id_contenu = $id_contenu;
        $contenu->getContenu();

        return view('pages.detail_contenu')
            ->with(['contenu'=>$contenu->contenu[0], 'images'=>$contenu->images, 'categories'=>$contenu->categories, 'criteres'=>$contenu->criteres]);
    }
}
