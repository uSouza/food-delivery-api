<?php

namespace App\Http\Controllers;

use App\Price;
use App\Http\Requests\PricesRequest as Request;
use Illuminate\Support\Facades\Auth;

class PricesController extends Controller
{
    public function index()
    {
        return Price::all();
    }

    public function store(Request $request)
    {
        if (Auth::user()->type != "client") {
            $product_id = $request->input('product_id');
            $price = Price::create([
                'size' => $request->input('size'),
                'price' => $request->input('price'),
            ]);
            $price->products()->attach($product_id);
            return $price;
        }
        return "Este usuario não pode cadastrar preços.";
    }

    public function show(Price $price)
    {
        return $price;
    }

    public function update(Request $request, Price $price)
    {
        $price->update($request->all());
        return $price;
    }

    public function destroy(Price $price)
    {
        $price->products()->detach();
        $price->delete();
        return $price;
    }
}
