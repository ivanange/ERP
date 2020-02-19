<?php

namespace App\Http\Controllers;

use App\Worker;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class EditController extends Controller
{
    public function affiche($Worker)
    {
        $Worker = Worker::find($Worker);
        $Worker->load("post");
        return view('paie.edit',[
            'worker' => $Worker,
        ]);
    }

}
