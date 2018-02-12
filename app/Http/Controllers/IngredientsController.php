<?php

namespace App\Http\Controllers;

use App\Ingredient;
use App\Http\Requests\IngredientsRequest as Request;
use Illuminate\Support\Facades\Auth;

class IngredientsController extends Controller
{
    public function index()
    {
        return Ingredient::all();
    }

    public function store(Request $request)
    {
        if (Auth::user()->type == "admin") {
            return Ingredient::create($request->all());
        }
        return "Este usuario não pode cadastrar ingredientes";
    }

    public function show(Ingredient $ingredient)
    {
        return $ingredient;
    }

    public function update(Request $request, Ingredient $ingredient)
    {
        $ingredient->update($request->all());
        return $ingredient;
    }

    public function destroy(Ingredient $ingredient)
    {
        $ingredient->delete();
        return $ingredient;
    }
}