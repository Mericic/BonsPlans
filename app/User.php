<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
        $user = User::where('pseudo', $pseudo)->join('images', 'users.id_imageprofil', '=', 'images.id')->first();
        if($user!=null)
            return $user;

        $user = User::where('pseudo', $pseudo)->first();
        $user->id_imageprofil = 1;
        $user->save();
        $user2 = User::leftjoin('images', 'users.id', '=', 'images.id_proprietaire')
            ->where('pseudo', $pseudo)->first();
        return $user2;
    }
}
