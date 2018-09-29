<?php

namespace App\Http\Controllers;

use App\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenusController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $company = $user->findCompanyByUser();
        if ($user->type == "company") {
            return Menu::with(['prices', 'ingredients', 'company'])
                ->where('company_id', $company->id)
                ->get();
        }
        return Menu::with(['prices', 'ingredients', 'company'])->get();
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $company = $user->findCompanyByUser();
        $ingredients_ids = $request->input('ingredients_ids');
        $prices_ids = $request->input('prices_ids');
        $data = $request->except(['ingredients_ids', 'prices_ids']);
        $menu = Menu::create([
            'description' => $data['description'],
            'observation' => $data['observation'],
            'company_id' => $company->id,
            'date' => $data['date']
        ]);
        $menu->ingredients()->attach($ingredients_ids);
        $menu->prices()->attach($prices_ids);
        return $menu;
    }

    public function show($id)
    {
        return Menu::where('id', $id)->with(['prices', 'ingredients', 'ingredients.ingredient_group'])->first();
    }

    public function menusByCompany($id)
    {
        return Menu::select('menus.*', DB::raw("(select min(price) from prices where company_id = $id ) as min_price"))
            ->where('company_id', $id)
            ->with(['prices' => function($q) use($id) {
                $q->where('prices.company_id', $id);
            }])
            ->with('ingredients')
            ->get();
    }

    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);
        $ingredients_ids = $request->input('ingredients_ids');
        $prices_ids = $request->input('prices_ids');

        if (! empty($ingredients_ids)) {
            DB::table('ingredient_menu')->where('menu_id', $menu->id)->delete();
            $menu->ingredients()->attach($ingredients_ids);
        }
        if (! empty($prices_ids)) {
            DB::table('ingredient_price')->where('menu_id', $menu->id)->delete();
            $menu->prices()->attach($prices_ids);
        }

        $menu->update($request->except(['ingredients_ids', 'prices_ids']));
        return $menu;
    }

    public function destroy(Menu $menu)
    {
        $menu->ingredients()->detach();
        $menu->prices()->detach();
        $menu->delete();
        return $menu;
    }
}
