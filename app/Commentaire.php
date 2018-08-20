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
    
    public static function getCommentaireByContenu($id_contenu) {
        $commentaires = Commentaire::join('users', 'commentaires.id_User', '=', 'users.id')
            ->leftjoin('reponses', 'commentaires.id_commentaire', '=', 'reponses.id_commentaire')
            ->where('commentaires.id_contenu', '=', $id_contenu)
            ->get();

        return ($commentaires);
    }
    
}
