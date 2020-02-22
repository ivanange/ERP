<?php

namespace App\Http\Controllers;

use App\Flow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FlowController extends Controller
{
    public function __construct()
    {
        Flow::whereNotNull('amount')->whereNotNull('frequency')->get()->each(function ($flow) {
            $flow->updateDues();
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = array(); /* va contenir les donnees de la table catégories dans la base*/
        $flows = Flow::with(["category", "dues"])->get(); /*va aller recuperer les donnees de la table flows de la base*/
        $data["flows"] = $flows; /* contient les informations qu'on est allées chercher  */

        return $request->json ?? false ? $flows->toJson() : view('flows.index', $data); /*on affiche toutes les flows dans la page index*/
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('flows.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   /*on valide la création ( on récupère les données entrer dans le formulaire) */
        $request->validate([
            "name" => "required|string|max:200",
            "desc" => "nullable|string|max:500",
            'type' => 'required|in:' . Flow::ENTRER . ',' . Flow::SORTIE,
            'frequency' => 'nullable|string',
            "amount" => "required_if:frequency,null|numeric",
            'category_id' => 'sometimes|integer|exists:categories,id'
        ]);

        /*on crée une nouvelle catégorie dont le nom et la description seront vide
            et à partir de la variable request on la remplie avec les infos recuperees*/

        $flow = new Flow();

        $flow->fill($request->all());

        $flow->save();
        if (!$flow->frequency) {
            $flow->dues()->create(['amount' => $flow->amount]);
        }

        return $request->json ?? false ? $flow->toJson() : redirect('/accounting/flows');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Flow  $flow
     * @return \Illuminate\Http\Response
     */
    public function show(Flow $flow, Request $request)
    {
        return $request->json ?? false ? $flow->load(['category', 'dues'])->toJson() : view('flows.show', ["flow" => $flow]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Flow  $flow
     * @return \Illuminate\Http\Response
     */
    public function edit(Flow $flow)
    {
        return view('flows.edit', ["flow" => $flow]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Flow  $flow
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Flow $flow)
    {
        $request->validate([
            "name" => "nullable|string|max:200",
            "desc" => "nullable|string|max:500",
            'type' => 'sometimes|in:' . Flow::ENTRER . ',' . Flow::SORTIE,
            'frequency' => 'nullable|string',
            "amount" => "sometimes|numeric",
            'category_id' => 'sometimes|integer|exists:categories,id'
        ]);

        if ((is_null($request->amount) && is_null($flow->frequency)) || (is_null($flow->amount) && is_null($request->frequency))) {
            return response(422)->json(["message" => "amount and frequency can't be null"]);
        }

        $flow->fill($request->all());
        $flow->save();

        return $request->json ?? false ? $flow->toJson() : redirect('/accounting/flows');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Flow  $flow
     * @return \Illuminate\Http\Response
     */
    public function destroy(Flow $flow, Request $request)
    {
        $flow->delete();
        return $request->json ?? false ? response()->json() : redirect('/accounting/flows');
    }

    public function dues()
    {
        return \App\Due::with("dueable")->get()->toJson();
    }
}
