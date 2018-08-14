<?php

namespace App\Http\Controllers;

use App\Ingredient;
use App\Http\Requests\IngredientsRequest as Request;
use Illuminate\Support\Facades\Auth;

class IngredientsController extends Controller
{
    public function index()
    {
        return Ingredient::with('ingredient_group')->get();
    }

    public function store(Request $request)
    {
        $this->authorize('create', Ingredient::class);
        return Ingredient::create($request->all());
    }

    public function show($id)
    {
        return Ingredient::find($id)->with(['ingredient_group'])->first();
    }

    public function update(Request $request, Ingredient $ingredient)
    {
        $this->authorize('update', $ingredient);
        $ingredient->update($request->all());
        return $ingredient;
    }

    public function destroy(Ingredient $ingredient)
    {
        $this->authorize('delete', $ingredient);
        $ingredient->delete();
        return $ingredient;
    }
}