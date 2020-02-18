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

        $category = new FlowCategory();

        $category->fill($request->all());

        $category->save();

        return $request->json ?? false ? $category->toJson() : redirect('/accounting/flowcategories');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FlowCategory  $category
     * @return \Illuminate\Http\Response
     */
    public function show(FlowCategory $category, Request $request)
    {
        return $request->json ?? false ? $category->toJson() : view('flowcategories.show', ["category" => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FlowCategory  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(FlowCategory $category)
    {
        return view('flowcategories.edit', ["category" => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FlowCategory  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FlowCategory $category)
    {
        $request->validate([
            "name" => "required|string|max:200",
            "desc" => "nullable|string|max:500"
        ]);

        $category->fill($request->all());
        $category->save();

        return $request->json ?? false ? $category->toJson() : redirect('/accounting/flowcategories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FlowCategory  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(FlowCategory $category, Request $request)
    {
        $category->delete();
        return $request->json ?? false ? response()->json() : redirect('/accounting/flowcategories');
    }
}
