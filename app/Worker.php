<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Worker extends Model
{
    use SoftDeletes;
    public $fillable = ['username', 'name', 'password',];

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
