<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PayController extends Controller
{
    public function affiche()
    {
        return view('dashboard_admin');
    }
}
