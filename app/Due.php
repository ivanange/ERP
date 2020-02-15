<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Due extends Model
{
    public $table = "due";
    protected $fillable = ['amount', 'flow_id'];

    public function flow()
    {
        return $this->belongsTo('App\Flow');
    }
}
