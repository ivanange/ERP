<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Worker extends Model
{
    use SoftDeletes;

    public $fillable = [
        'username', 'name', 'password', 'surname', 'telephone', 'birthdate', 'email',
        'title', 'gender', 'address', 'permissions', 'post_id'
    ];
    public $timestamps = false;
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function post()
    {
        return $this->hasOne('App\Post');
    }

    public function department()
    {
        return $this->hasOneThrough('App\Department', 'App\Post');
    }
}
