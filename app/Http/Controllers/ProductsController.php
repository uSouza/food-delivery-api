<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{

    public function index()
    {
        return Product::all();
    }

    public function store(Request $request)
    {
        $ingredients_ids = $request->input('ingredients_ids');
        $tags_ids = $request->input('tags_ids');
        $product = Product::create([
            'type' => $request->input('type'),
            'description' => $request->input('description'),
            'measure' => $request->input('measure'),
            'size' => $request->input('size'),
            'company_id' => $request->input('company_id')
        ]);
        $product->ingredients()->attach($ingredients_ids);
        $product->tags()->attach($tags_ids);
        return $product;
    }

    public function show(Product $product)
    {
        return $product;
    }

    public function update(Request $request, Product $product)
    {
        $ingredients_ids = $request->input('ingredients_ids');
        $tags_ids = $request->input('tags_ids');
        $product->update($request->all());
        $product->ingredients()->attach($ingredients_ids);
        $product->tags()->attach($tags_ids);
        return $product;
    }

    public function destroy(Product $product)
    {
        $product->ingredients()->detach();
        $product->tags()->detach();
        $product->delete();
    }
}