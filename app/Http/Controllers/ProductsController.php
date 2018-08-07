<?php

namespace App\Http\Controllers;

use App\Company;
use App\Product;
use App\Http\Requests\ProductsRequest as Request;

class ProductsController extends Controller
{
    public function index()
    {
        return Product::with(['prices', 'ingredients'])->get();
    }

    public function store(Request $request)
    {
        $ingredients_ids = $request->input('ingredients_ids');
        $prices_ids = $request->input('prices_ids');
        $product = Product::create([
            'description' => $request->input('description'),
            'company_id' => $request->input('company_id'),
            'date' => $request->input('date'),
        ]);
        $product->ingredients()->attach($ingredients_ids);
        $product->prices()->attach($prices_ids);
        return $product;
    }

    public function show($id)
    {
        return Product::find($id)->with(['prices', 'ingredients'])->first();
    }

    public function productsByCompany($id)
    {
        return Product::where('company_id', $id)->with(['prices', 'ingredients'])->get();
    }

    public function update(Request $request, Product $product)
    {
        $ingredients_ids = $request->input('ingredients_ids');
        $prices_ids = $request->input('prices_ids');
        $product->update($request->all());
        $product->ingredients()->attach($ingredients_ids);
        $product->prices()->attach($prices_ids);
        return $product;
    }

    public function destroy(Product $product)
    {
        $product->ingredients()->detach();
        $product->tags()->detach();
        $product->prices()->detach();
        $product->delete();
    }
}