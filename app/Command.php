<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Command extends Model
{

    const ENCOURS = 1;
    const LIVRER = 2;
    const  ANNULER = 3;
    public $timestamps = false;

    public function products()
    {
        return $this->belongsToMany('App\Product');
    }
}
