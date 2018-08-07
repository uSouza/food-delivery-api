<?php

namespace App\Http\Controllers;

use App\Company;
use App\Product;
use App\Http\Requests\ProductsRequest as Request;

class ProductsController extends Controller
{
    public function index()
    {
        return Product::with(['price', 'ingredients'])->get();
    }

    public function store(Request $request)
    {
        $ingredients_ids = $request->input('ingredients_ids');
        $product = Product::create($request->except('ingredients_ids'));
        $product->ingredients()->attach($ingredients_ids);
        return $product;
    }

    public function show($id)
    {
        return Product::find($id)->with(['price', 'ingredients'])->first();
    }

    public function productsByMenu($id)
    {
        return Product::where('menu_id', $id)->with(['price', 'ingredients'])->get();
    }

    public function update(Request $request, Product $product)
    {
        $ingredients_ids = $request->input('ingredients_ids');
        $product->update($request->except('ingredients_ids'));
        $product->ingredients()->attach($ingredients_ids);
        return $product;
    }

    public function destroy(Product $product)
    {
        $product->ingredients()->detach();
        $product->delete();
        return $product;
    }
}