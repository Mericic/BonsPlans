<?php

namespace App\Http\Controllers;

use App\Reponse;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getInfo($pseudo){
        $user = User::getInfoByPseudo($pseudo);
        return $user->toJson(JSON_PRETTY_PRINT);
    }
}
