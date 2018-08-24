<?php
/**
 * Created by PhpStorm.
 * User: PC-Fixe
 * Date: 24/08/2018
 * Time: 16:43
 */

namespace App\Http\Controllers;

use App\User;
use App\Commentaire;

class ProfilController extends Controller
{
    public function profil($pseudo) {

        $user = User::where('pseudo', $pseudo) -> first();

        $img = User::getProfilePic($user->id);

        $com = Commentaire::getCommentaireByUser($user->id);
        
        echo str_replace('\\', '', json_encode($img.$com));
    }
}