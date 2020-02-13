<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Nullable;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = array(); /* va contenir les donnees de la table catégories dans la base*/
        $categories = Category::all(); /*va aller recuperer les donnees de la table categories de la base*/
        $data["categories"] = $categories; /* contient les informations qu'on est allées chercher  */

        return $request->json ?? false ? $categories->toJson() : view('categories.index', $data); /*on affiche toutes les categories dans la page index*/
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
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
            "name" => "required|string|max:500",
            "desc" => "nullable|string|max:1500"
        ]);

        /*on crée une nouvelle catégorie dont le nom et la description seront vide
            et à partir de la variable request on la remplie avec les infos recuperees*/

        $category = new Category();

        $category->fill($request->all());

        $category->save();

        return $request->json ?? false ? $category->toJson() : redirect('/categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category, Request $request)
    {
        return $request->json ?? false ? $category->toJson() : view('categories.show', ["category" => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('categories.edit', ["category" => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            "name" => "required|string|max:500",
            "desc" => "nullable|string|max:1500"
        ]);

        $category->fill($request->all());
        $category->save();

        return $request->json ?? false ? $category->toJson() : redirect('/categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category, Request $request)
    {
        $category->delete();
        return $request->json ?? false ? response()->json() : redirect('/categories');
    }
}
