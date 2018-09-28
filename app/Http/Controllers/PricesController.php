<?php

namespace App\Http\Controllers;

use App\Price;
use App\Http\Requests\PricesRequest as Request;
use Illuminate\Support\Facades\Auth;

class PricesController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $company = $user->findCompanyByUser();
        if ($user->type == "company") {
            return Price::with('company')
                ->where('company_id', $company->id)
                ->get();
        }
        return Price::with('company')->get();
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $company = $user->findCompanyByUser();
        return Price::create([
            'size' => $request->input('size'),
            'price' => $request->input('price'),
            'company_id' => $company->id
        ]);
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

    public function destroy($id)
    {
        $price = Price::findOrFail($id);
        $price->products()->detach();
        $price->delete();
        return $price;
    }
}
