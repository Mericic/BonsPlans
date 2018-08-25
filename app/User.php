<?php

namespace App;

use Egulias\EmailValidator\Warning\Comment;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'pseudo', 'id_imageprofil', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public static function getProfilePic($id_user) {
        $profilPic = User::
        join('images', 'users.id_imageprofil', '=', 'images.id')
        ->where('images.id_proprietaire', '=', $id_user)
        ->first();

        return ($profilPic);
    }

    public static function getInfoByPseudo($pseudo){
        $user = User::where('pseudo', $pseudo)
            ->join('images', 'users.id_imageprofil', '=', 'images.id')
            ->select('users.id','first_name', 'last_name', 'pseudo', 'id_imageprofil', 'path', 'nom', 'users.created_at')
            ->first();
        if($user==null) {
            $user = User::where('pseudo', $pseudo)->first();
            $user->id_imageprofil = 1;
            $user->save();
            $user = User::leftjoin('images', 'users.id', '=', 'images.id_proprietaire')
                ->select('users.id','first_name', 'last_name', 'pseudo', 'id_imageprofil', 'path', 'nom', 'users.created_at')
                ->where('pseudo', $pseudo)->first();
        }
        $contenus = Contenu::where('id_User', '=', $user->id)->get();
        foreach($contenus as $key=>$contenu){
            $votes = Contenu::select(DB::raw('criteres.nom as nom_critere, criteres.id_critere, AVG(votes_criteres.value) as moyenne'))
                ->join('Contenu_Criteres', 'contenus.id_Contenu', '=', 'Contenu_Criteres.id_Contenu')
                ->join('criteres', 'Contenu_Criteres.id_Critere', '=', 'criteres.id_critere')
                ->leftjoin('votes_criteres', function($join){
                    $join->on('contenus.id_contenu',  '=', 'votes_criteres.id_contenu');
                    $join->on('criteres.id_critere', '=', 'votes_criteres.id_critere');
                })
                ->where('contenus.id_contenu', '=', $contenu->id_Contenu)
                ->groupby('criteres.id_critere')
                ->get();
            $contenus[$key]->votes = $votes;
        }

        $user->contenus = $contenus;

        $commentaires = Commentaire::getCommentaireByUser($user->id);
        $user->commentaires = $commentaires;

        return $user;
    }
}
