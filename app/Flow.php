<?php

namespace App;

use DateTime;
use DateTimeZone;
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
        return $this->morphMany('App\Due', 'dueable');
    }

    public function updateDues()
    {
        if (!is_null($this->amount) && !is_null($this->frequency)) {
            $dues = [];
            $now = time();

            $lastDueDate = $this->dues()->latest()->first()->created_at ?? gmdate('Y-m-d H:i:s e', $now);
            $lastDueDate = is_object($lastDueDate) ? $lastDueDate->format('Y-m-d H:i:s e') : $lastDueDate;
            $lastDueDate =  strtotime($lastDueDate);


            while ($now >= ($lastDueDate = strtotime($this->frequency, $lastDueDate))) {
                $created_at = (new DateTime("now", new DateTimeZone('UTC')))
                    ->setTimestamp($lastDueDate)
                    ->format('Y-m-d H:i:s');

                $due = new \App\Due(['amount' => $this->amount]);
                $due->created_at = $created_at;
                $dues[] = $due;
            }
            if (count($dues)) {
                $this->dues()->saveMany($dues);
            }
        }

        // get last due date and use it to update dues till current date
    }

    // frequency : strtotime format , check if now > lastDueDate + frequency i.e time() >= strtotime(frequency, lastDueDate)
    // ex: time() >= strtotime('+ 1 days 4 months 2 weeks', strtotime('-5 months' ) )
}
