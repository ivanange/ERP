<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flow extends Model
{

    const ENTRER = 1;
    const SORTIE= 2;

    public function category()
    {
        return $this->belongsTo('App\Flowcategory');
    }

}
