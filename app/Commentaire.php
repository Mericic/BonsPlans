<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    protected $primaryKey = 'id_commentaire';

    public static function getCommentaireByUser($id_user) {
        $commentaires = Commentaire::
        join('Contenus', 'commentaires.id_contenu', '=', 'contenus.id_contenu')
        ->where('commentaires.id_user', '=', $id_user)
        ->get();

        return ($commentaires);
    }
    
    //public  function getCommentaireByContenu($id_contenu) {}
    
}
