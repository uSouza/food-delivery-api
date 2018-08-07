<?php

namespace App\Http\Controllers;

use App\Menu;
use Illuminate\Http\Request;

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

    public function update(Request $request, Menu $menu)
    {
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
