<?php

namespace App\Http\Controllers;

use App\Company;
use App\Location;
use Illuminate\Http\Request;

class CompaniesLocationsController extends Controller
{
    public function index()
    {
        return Location::findLocationsByCompany();
    }

    public function store(Request $request)
    {
        $location = Location::create([
            'city' => $request->input('city'),
            'state' => $request->input('state'),
            'address' => $request->input('address'),
            'number' => $request->input('number'),
            'district' => $request->input('district'),
            'postal_code' => $request->input('postal_code'),
            'observation' => $request->input('observation'),
        ]);
        $company = Company::findOrFail($request->input('company_id'));
        $company->locations()->attach($location->id);

        return $location;
    }

    public function show($id)
    {
        return Location::find($id);
    }

    public function update(Request $request, $id)
    {
        $location = Location::find($id);
        $location->update($request->all());
        return $location;
    }

    public function destroy($id)
    {
        $location = Location::find($id);
        $user = auth()->user();
        $company = $user->findCompanyByUser();
        $company->locations()->detach($location->id);
        $location->delete();
        return $location;
    }
}
