<?php

namespace App\Http\Controllers;

use App\Worker;
use App\Post;
use Illuminate\Http\Request;

class BulltinController extends Controller
{
    public function index()
    {
        $workers = Worker::with('post')->get();
        $posts = Post::all();

        return view('paie.index',[
            'workers' => $workers,
            'posts' => $posts, 
        ]);  
    }
}
