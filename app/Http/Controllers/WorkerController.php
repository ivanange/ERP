<?php

namespace App\Http\Controllers;

use App\Worker;
use App\Post;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $workers = Worker::with('post')->get();
        $posts = Post::all();

        return view('workers.index',[
            'workers' => $workers,
            'posts' => $posts, 
        ]);  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        request()->validate([
            'username' => ['required'],
            'name' => ['required'],
            'surname' => ['required'],
            'telephone' => ['required'],
            'birthday' => ['required'],
            'genre' => ['required'],
            'adresse' => ['required'],
            'email' => ['email'],
            'pass' => ['required'],
            'poste' => ['required'],
            'titre' => ['required']
        ]);

        $worker = Worker::create([
            'username' => request('username'),
            'name' => request('name'),
            'surname' => request('surname'),
            'telephone' => request('telephone'),
            'birthday' => request('birthday'),
            'gender' => request('genre'),
            'email' => request('email'),
            'address' => request('adresse'),
            'password' => request('pass'),
            'post_id' => request('poste'),
            'title' => request('titre'),
        ]);

        return 'Vous avez enregistrer un employé';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function show(Worker $worker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function edit(Worker $worker)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function update( $worker)
    {
        request()->validate([
            'heur_sup' => ['required']
        ]);
        
        $affected = DB::table('workers')
                    ->where('id',$worker)
                    ->update(['prime' => 1000*request('heur_sup')]);

        return 'worker '.$worker;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function destroy(Worker $worker)
    {
        //
    }

    public function names()
    {
        return Worker::all()->pluck("username")->toJson();
    }
}
