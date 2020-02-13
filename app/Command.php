<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Command extends Model
{
    use SoftDeletes;

    const ENCOURS = 1;
    const LIVRER = 2;
    const  ANNULER = 3;
    public $timestamps = false;
    protected $fillable = ['name', 'deliveryDate', 'status'];
    //protected $dates = ['issueDate', 'deliveryDate'];
    protected $hidden = ['products'];
    protected $appends = ['total', 'articles'];

    public function products()
    {
        return $this->belongsToMany('App\Product', 'articles')->as('article')->withPivot('id', 'qte');
    }

    public function getTotalAttribute()
    {
        return  $this->total();
    }

    public function total()
    {
        $total = 0;

        foreach ($this->products as $product) {
            $total += $product->total;
        }

        return $total;
    }

    public function getArticlesAttribute()
    {
        $articles = [];
        foreach ($this->products as $product) {
            $pivot = $product->article;
            unset($product->article);
            $articles[$product->id] = ['product' => $product, 'qte' => $pivot->qte];
        }

        return $articles;
    }
}
