<?php

namespace App\Http\Controllers;

use App\IngredientGroup;
use App\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IngredientGroupsController extends Controller
{
    public function index()
    {
        return IngredientGroup::with('ingredients')->get();
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $company = $user->findCompanyByUser();
        return IngredientGroup::create([
            'name' => $request->input('name'),
            'number_options' => $request->input('number_options'),
            'company_id' => $company->id
        ]);
    }

    public function show(IngredientGroup $ingredient_group)
    {
        return $ingredient_group;
    }

    public function ingredientsByMenu($id)
    {
        $menu= Menu::findOrFail($id);

        $ingredients_ids =
            DB::table('ingredients')
                ->select('ingredients.id')
                ->join('ingredient_menu', 'ingredient_menu.ingredient_id', '=', 'ingredients.id')
                ->where('ingredient_menu.menu_id', $menu->id)
                ->get();
        $ingredients_ids_array = array();
        for ($i = 0; $i < count($ingredients_ids); $i++) {
            array_push($ingredients_ids_array, $ingredients_ids[$i]->id);
        }

        return IngredientGroup::select('ingredient_groups.*')
            ->join('ingredients', 'ingredients.ingredient_group_id', '=', 'ingredient_groups.id')
            ->join('ingredient_menu', 'ingredient_menu.ingredient_id', '=', 'ingredients.id')
            ->where('ingredient_menu.menu_id', $menu->id)
            ->with(['ingredients' => function($q) use($ingredients_ids_array) {
                $q->whereIn('ingredients.id', $ingredients_ids_array);
            }])
            ->distinct()
            ->get();
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
