<?php

namespace App\Http\Controllers;

use App\Category;
use App\Command;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCommand;

class CommandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $commands = Command::with('products')->get();
        return $request->json ?? false ? $commands->toJson() : view('commands.index', ["commands" => $commands]);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('commands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommand $request)
    {

        $request->validated();
        $issueDate = gmdate("Y-m-d H:i:s", strtotime('-2 minutes'));
        $request->validate([
            'deliveryDate' => 'nullable|after_or_equal:' . $issueDate,
        ]);

        $command = new Command;
        $command->fill($request->all());
        $command->issueDate =  $issueDate;
        $command->save();
        $command->products()->sync((array) $request->articles ?? []);
        return $request->json ?? false ? $command->load('products')->toJson() : redirect('/commands');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Command  $command
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Command $command)
    {
        $command->load('products');
        return $request->json ?? false ? $command->toJson() : view('commands.show', ["command" => $command]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Command  $command
     * @return \Illuminate\Http\Response
     */
    public function edit(Command $command)
    {
        return view('commands.edit', ["command" => $command]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Command  $command
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCommand $request, Command $command)
    {

        $request->validate([
            'deliveryDate' => 'nullable|after_or_equal:' . $command->issueDate,
        ]);
        $request->validated();
        $command->fill($request->all());
        $command->save();
        $command->products()->sync((array) $request->articles ?? []);
        return $request->json ?? false ? $command->load('products')->toJson() : redirect('/commands');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Command  $command
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Command $command)
    {
        $command->delete();
        return $request->json ?? false ? response()->json() : redirect('/commands');
    }

    /**
     * List  all soft deleted resource
     *
     * @return \Illuminate\Http\Response
     */

    public function deleted(Request $request)
    {
        $commands = Command::with('products')->onlyTrashed()->get();
        return $request->json ?? false ? $commands->toJson() : view('commands.recycle', ["commands" => $commands]);
    }

    /**
     * restore  soft deleted resource
     *
     * @return \Illuminate\Http\Response
     */

    public function restore(Request $request)
    {
        $restored = Command::onlyTrashed()->whereIn('id', $request->recycle)->restore();
        return $request->json ?? false ? response()->json(["restored" => $restored ? "Ok" : "Error"]) : redirect('/commands');
    }

    /**
     * permenently delete soft deleted resource
     *
     * @return \Illuminate\Http\Response
     */

    public function delete(Request $request)
    {
        $deleted = Command::onlyTrashed()->whereIn('id', $request->recycle)->forceDelete();
        return $request->json ?? false ? response()->json(["deleted" => $deleted ? "OK" : "Error"]) : redirect('/commands');
    }
}
