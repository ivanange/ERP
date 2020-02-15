<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'desc', 'department_id'];

    public function worker()
    {
        return $this->belongsTo('App\Worker');
    }

    public function department()
    {
        return $this->belongsTo('App\Department');
    }
}
