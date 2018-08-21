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
        join('images', 'users.id', '=', 'images.id_proprietaire')
        ->where('images.id_proprietaire', '=', $id_user)
        ->first();
        if ($profilPic)
           return ($profilPic);
        $profilPic = new User();
        $profilPic->path = 'https://cdn1.iconfinder.com/data/icons/technology-devices-2/100/Profile-512.png';
        return ($profilPic);
    }
}
