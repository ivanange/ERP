<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FlowCategory extends Model
{
    public $timestamps = false;
    protected $table = 'flowcategory';
    protected $fillable = ['name', 'desc', 'id'];

    public function flows()
    {
        return $this->hasMany('App\Flow', 'category_id');
    }
}
