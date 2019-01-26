<?php

namespace App\Http\Controllers;

use App\District;
use Illuminate\Http\Request;

class DistrictsController extends Controller
{
    public function index()
    {
        return District::with('city', 'city.state')->get();
    }

    public function getDistrictsByCity($city_id) {
        return District::with('city')->where('city_id', $city_id)->orderBy('name')->get();
    }

    public function store(Request $request)
    {
        return District::create($request->all());
    }
    public function show($id)
    {
        return District::find($id);
    }
    public function update(Request $request, $id)
    {
        $district = District::find($id);
        $district->update($request->all());
        return $district;
    }
    public function destroy($id)
    {
        $district = District::find($id);
        $district->delete();
        return $district;
    }
}
