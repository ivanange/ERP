<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flowcategory extends Model
{
    public $timestamps = false;
    protected $table = 'flowcategory';

    public function flows()
    {
        return $this->hasMany('App\Flow');
    }
}
