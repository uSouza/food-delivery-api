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
        return Price::create($request->all());
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
