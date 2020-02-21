<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Larapack\ConfigWriter\Facade;

class Worker extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;

    public $fillable = [
        'username', 'name', 'password', 'surname', 'telephone', 'birthdate', 'email',
        'title', 'gender', 'address', 'permissions', 'post_id', 'extraHours'
    ];
    public $timestamps = false;
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $appends = ['salary'];

    public function post()
    {
        return $this->belongsTo('App\Post');
    }

    public function department()
    {
        return $this->hasOneThrough('App\Department', 'App\Post');
    }

    public function getSalaryAttribute()
    {
        return $this->post->baseSalary + (config('app.config.payRate', 1000) * $this->extraHours);
    }

    public function dues()
    {
        return $this->morphMany('App\Due', 'dueable');
    }
}
