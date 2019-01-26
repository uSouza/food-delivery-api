<?php

namespace App\Http\Controllers;

use App\City;
use Illuminate\Http\Request;

class CitiesController extends Controller
{
    public function index()
    {
        return City::with('state')->get();
    }
    public function store(Request $request)
    {
        return City::create($request->all());
    }
    public function show($id)
    {
        return City::find($id);
    }
    public function update(Request $request, $id)
    {
        $city = City::find($id);
        $city->update($request->all());
        return $city;
    }
    public function destroy($id)
    {
        $city = City::find($id);
        $city->delete();
        return $city;
    }
}
