<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'desc'];


    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function workers()
    {
        return $this->hasManyThrough('App\Worker', 'App\Post');
    }
}
