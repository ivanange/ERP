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

    public function updateDues()
    {
        if ($this->amount and $this->frequency) {
            $lastDueDate = $this->dues()->orderBy('created_at')->first()->created_at;
            $now = time();
            while ($now >= ($lastDueDate = strtotime($this->frequency, $lastDueDate))) {
                $due = new \App\Due(['amount' => $this->amount]);
                $due->created_at = gmdate('Y-m-d H:i:s');
                $this->dues()->save($due);
            }
        }

        // get last due date and use it to update dues till current date
    }

    // frequency : strtotime format , check if now > lastDueDate + frequency i.e time() >= strtotime(frequency, lastDueDate)
    // ex: time() >= strtotime('+ 1 days 4 months 2 weeks', strtotime('-5 months' ) )
}
