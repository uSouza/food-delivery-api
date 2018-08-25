<?php

namespace App\Http\Controllers;

use App\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenusController extends Controller
{
    public function index()
    {
        return Menu::with(['prices', 'ingredients'])->get();
    }

    public function store(Request $request)
    {
        $ingredients_ids = $request->input('ingredients_ids');
        $prices_ids = $request->input('prices_ids');
        $menu = Menu::create($request->except(['ingredients_ids', 'prices_ids']));
        $menu->ingredients()->attach($ingredients_ids);
        $menu->prices()->attach($prices_ids);
        return $menu;
    }

    public function show($id)
    {
        return Menu::find($id)->with(['prices', 'ingredients'])->first();
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
        $menu->update($request->except(['ingredients_ids', 'prices_ids']));
        $menu->ingredients()->attach($ingredients_ids);
        $menu->prices()->attach($prices_ids);
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
