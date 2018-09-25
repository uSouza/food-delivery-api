<?php

namespace App\Http\Controllers;

use App\Ingredient;
use App\Http\Requests\IngredientsRequest as Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IngredientsController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $company = $user->findCompanyByUser();
        if ($user->type == "company") {
            return Ingredient::with('ingredient_group')
                    ->select('ingredients.*')
                    ->join('ingredient_groups', 'ingredients.ingredient_group_id', '=', 'ingredient_groups.id')
                    ->where('ingredient_groups.company_id', $company->id)
                    ->get();
        }
        return Ingredient::with('ingredient_group')->get();

    }

    public function store(Request $request)
    {
        $ingredient = Ingredient::create($request->all());
        return Ingredient::findOrFail($ingredient->id)->with(['ingredient_group'])->first();
    }

    public function show($id)
    {
        return Ingredient::find($id)->with(['ingredient_group'])->first();
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