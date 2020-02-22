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
    public function index(Request $request, $message = null)
    {
        $workers = Worker::with(['post', 'dues'])->get();

        return $request->json ? $workers->toJson() :
            view('workers.index', [
                'workers' => $workers,
                'posts' => Post::all(),
                'message' => $message
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
    public function store(Request $request)
    {
        request()->validate([
            'username' => ['required', 'unique:workers'],
            'name' => ['required', 'string'],
            'surname' => ['required', 'string'],
            'telephone' => ['required', 'string'],
            'birthday' => ['required', 'string'],
            'genre' => ['required', 'string', 'in:Male,Female'],
            'adresse' => ['required', 'string'],
            'email' => ['nullable', 'email'],
            'pass' => ['required', 'string'],
            'poste' => ['required', 'exists:posts,id'],
            'titre' => ['nullable', 'string']
        ]);

        $worker = Worker::create([
            'username' => request('username'),
            'name' => request('name'),
            'surname' => request('surname'),
            'telephone' => request('telephone'),
            'birthdate' => request('birthday'),
            'gender' => request('genre'),
            'email' => request('email'),
            'address' => request('adresse'),
            'password' => request('pass'),
            'post_id' => request('poste'),
            'title' => request('titre'),
            'extraHours' => request('extraHours'),
        ]);

        return  $this->index($request, 'Vous avez enregistrer un employé');
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
    public function update($worker)
    {
        request()->validate([
            'heur_sup' => ['required', 'integer']
        ]);

        $affected = DB::table('workers')
            ->where('id', $worker)
            ->update(['extraHours' =>  request('heur_sup')]);
        // config('app.config.payRate') *

        return redirect('/payroll/workers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function destroy(Worker $worker, Request $request)
    {
        //
    }

    public function names()
    {
        return Worker::all()->pluck("username")->toJson();
    }

    public function pay(Worker $worker, Request $request)
    {
        $worker->dues()->create(['amount' => $worker->salary]);
        $worker->extraHours = 0;
        $worker->save();
        return  app('App\Http\Controllers\BulltinController')->getPrintReport()->index('Vous avez payer un employé ' . $worker->name . ' ' . $worker->surname);
    }
}
