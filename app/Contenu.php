<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contenu extends Model
{
    protected $primaryKey = 'id_Contenu';

    public function getContenu(Request $request){
        //dans request : id_contenu
        $request->validate([
            'id_contenu' => 'required|numeric|max:255'
        ]);

        $contenu = Contenu::join('Contenu_Categories', 'Contenus.id_Contenu', '=', 'Contenu_Categories.id_Contenu')
            ->join('Categories', 'Contenu_Categories.id_Categorie', '=', 'Categories.id_Categorie')
            ->join('Contenu_Criteres', 'Contenus.id_Contenu', '=', 'Contenu_Criteres.id_Contenu')
            ->join('Criteres', 'Contenu_Criteres.id_Critere', '=', 'Criteres.id_Critere')
            ->join('Users', 'Contenus.id_User', '=', 'Users.id')
            ->where('id_contenu', '=', $request->id_contenu)
            ->toSql();
        dd($contenu);
    }

    public function setContenu(Request $request){

    }

}
