<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public $timestamps = false;

    public function workers()
    {
        return $this->hasMany('App\Worker');
    }

    public function posts()
    {
        return $this->hasMany('App\Post');
    }
}
