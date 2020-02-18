<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Worker extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;

    public $fillable = [
        'username', 'name', 'password', 'surname', 'telephone', 'birthdate', 'email',
        'title', 'gender', 'address', 'permissions', 'post_id'
    ];
    public $timestamps = false;
    protected $hidden = [
        // 'password', 'remember_token',
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
