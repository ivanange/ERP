<?php

namespace App\Http\Controllers;

use App\Worker;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class EditController extends Controller
{
    public function affiche($Worker)
    {

        $Worker = Worker::with('post')->find($Worker);
        //$Worker->load(["post"]);


        $date = $Worker->dues()->latest()->first()->created_at ?? null;

        if ($date) {
            $startDate = strftime("%a  %e %B %Y", strtotime(
                $date->format('Y-m-d')
            ));
        }

        return view('paie.edit', [
            'worker' => $Worker,
            'startDate' => $startDate ?? null
        ]);
    }
}
