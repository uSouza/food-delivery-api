<?php

namespace App\Http\Controllers;

use App\Company;
use App\Product;
use App\Http\Requests\ProductsRequest as Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    public function index()
    {
        return Product::with(['price', 'ingredients', 'additionals'])->get();
    }

    public function store(Request $request)
    {
        $ingredients_ids = $request->input('ingredients_ids');
        $additionals = $request->input('additionals');
        $product = Product::create($request->except(['ingredients_ids', 'additionals']));
        if (! empty($additionals)) {
            for ($i = 0; $i < count($additionals); $i++) {
                DB::table('additional_product')->insert([
                    'product_id' => $product->id,
                    'additional_id' => $additionals[$i]['add_id'],
                    'quantity' => $additionals[$i]['add_quantity'],
                ]);
            }
        }

        $product->ingredients()->attach($ingredients_ids);

        return Product::where('id', $product->id)->with(['price', 'ingredients', 'additionals'])->get();
    }

    public function show($id)
    {
        return Product::find($id)->with(['price', 'ingredients', 'additionals'])->first();
    }

    public function productsByMenu($id)
    {
        return Product::where('menu_id', $id)->with(['price', 'ingredients', 'additionals'])->get();
    }

    public function update(Request $request, Product $product)
    {
        $ingredients_ids = $request->input('ingredients_ids');
        $additionals = $request->input('additionals');
        $product->update($request->except(['ingredients_ids', 'additionals']));
        if (! empty($additionals)) {
            DB::table('additional_product')->where('product_id', $product->id)->delete();
            for ($i = 0; $i < count($additionals); $i++) {
                DB::table('additional_product')->insert([
                    'product_id' => $product->id,
                    'additional_id' => $additionals[$i]['add_id'],
                    'quantity' => $additionals[$i]['add_quantity'],
                ]);
            }
        }
        $product->ingredients()->attach($ingredients_ids);
        return Product::where('id', $product->id)->with(['price', 'ingredients', 'additionals'])->get();
    }

    public function destroy(Product $product)
    {
        $product->ingredients()->detach();
        DB::table('additional_product')->where('product_id', $product->id)->delete();
        $product->delete();
        return $product;
    }
}