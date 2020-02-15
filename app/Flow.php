<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flow extends Model
{

    const ENTRER = 1;
    const SORTIE = 2;
    public $timestamp = false;
    protected $fillable = [
        'type', 'name', 'desc', 'amount', 'frequency', 'category_id'
    ];

    public function category()
    {
        return $this->belongsTo('App\Flowcategory', 'category_id');
    }

    public function dues()
    {
        return $this->hasMany('App\Due');
    }

    // frequency : strtotime format , check if now > lastDueDate + frequency i.e time() >= strtotime(frequency, lastDueDate)
    // ex: time() >= strtotime('+ 1 days 4 months 2 weeks', strtotime('-5 months' ) )
}
