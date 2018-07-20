<?php

namespace App\Http\Controllers;

use App\IngredientGroup;
use Illuminate\Http\Request;

class IngredientGroupsController extends Controller
{
    public function index()
    {
        return IngredientGroup::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', IngredientGroup::class);
        return IngredientGroup::create($request->all());
    }

    public function show(IngredientGroup $ingredient_group)
    {
        $this->authorize('view', $ingredient_group);
        return $ingredient_group;
    }

    public function update(Request $request, IngredientGroup $ingredient_group)
    {
        $this->authorize('update', $ingredient_group);
        $ingredient_group->update($request->all());
        return $ingredient_group;
    }

    public function destroy(IngredientGroup $ingredient_group)
    {
        $this->authorize('delete', $ingredient_group);
        $ingredient_group->delete();
        return $ingredient_group;
    }
}
