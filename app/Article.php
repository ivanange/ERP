<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public $timestamps = false;
    protected $fillable = ['qte'];
    protected $guarded = [];
    //public $table = "articles";
}
