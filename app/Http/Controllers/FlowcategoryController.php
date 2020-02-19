<?php

namespace App\Http\Controllers;

use App\FlowCategory;
use Illuminate\Http\Request;

class FlowCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = array(); /* va contenir les donnees de la table catégories dans la base*/
        $flowcategories = FlowCategory::all(); /*va aller recuperer les donnees de la table flowcategories de la base*/
        $data["flowcategories"] = $flowcategories; /* contient les informations qu'on est allées chercher  */

        return $request->json ?? false ? $flowcategories->toJson() : view('flowcategories.index', $data); /*on affiche toutes les flowcategories dans la page index*/
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('flowcategories.create');
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
            "desc" => "nullable|string|max:500"
        ]);

        /*on crée une nouvelle catégorie dont le nom et la description seront vide
            et à partir de la variable request on la remplie avec les infos recuperees*/

        $flowcategory = new FlowCategory();

        $flowcategory->fill($request->all());

        $flowcategory->save();

        return $request->json ?? false ? $flowcategory->toJson() : redirect('/accounting/flowcategories');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FlowCategory  $flowcategory
     * @return \Illuminate\Http\Response
     */
    public function show(FlowCategory $flowcategory, Request $request)
    {
        return $request->json ?? false ? $flowcategory->toJson() : view('flowcategories.show', ["flowcategory" => $flowcategory]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FlowCategory  $flowcategory
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('flowcategories.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FlowCategory  $flowcategory
     * @return \Illuminate\Http\Response
     */
    public function update(FlowCategory $flowcategory, Request $request)
    {
        $request->validate([
            "name" => "required|string|max:200",
            "desc" => "nullable|string|max:500"
        ]);

        $flowcategory->fill($request->all());
        $flowcategory->save();

        return $request->json ?? false ? $flowcategory->toJson() : redirect('/accounting/flowcategories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FlowCategory  $flowcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(FlowCategory $flowcategory, Request $request)
    {
        $flowcategory->delete();
        return $request->json ?? false ? response()->json() : redirect('/accounting/flowcategories');
    }
}
