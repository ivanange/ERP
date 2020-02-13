<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'manufacturer', 'weight', 'price', 'qte', 'expireDate', 'category_id'];
    public $table = "products";
    //protected $appends = ['total'];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function commands()
    {
        return $this->belongsToMany('App\Command', 'articles')->as('article')->withPivot('id', 'qte');
    }

    public function getTotalAttribute()
    {
        return $this->total();
    }

    public function total()
    {
        return ($this->article ?? false) ?
            $this->price * $this->article->qte :
            null;
    }
}
