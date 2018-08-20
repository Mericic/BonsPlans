<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class votes_critere extends Model
{
    public $timestamps = false;

    protected $fillable = ['id_User', '	id_Contenu', 'id_Critere'];
}
