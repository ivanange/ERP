<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    public $timestamps = false;
    protected $hidden = ['password'];

    public function post()
    {
        return $this->hasOne('App\Post');
    }

    public function department()
    {
        return $this->belongsTo('App\Department');
    }
    
}
