<?php

namespace App\Http\Controllers;

use App\Client;
use App\Company;
use App\Location;
use App\Http\Requests\LocationsRequest as Request;

class LocationsController extends Controller
{
    public function index()
    {
        if (auth()->user()->type == "client") {
            $locations = Location::whereIn('locations.id', function ($query) {
                $client = Client::whereIn('clients.user_id', function ($query) {
                    $query->select('users.id')
                        ->from('users')
                        ->where('users.id', auth()->id());
                })->get();
                $query->select('location_id')
                    ->from('client_location')
                    ->where('client_id', $client->first()->id);
            })->get();
            return $locations;
        }
        else if (auth()->user()->type == "company") {
            $locations = Location::whereIn('locations.id', function ($query) {
                $company = Company::whereIn('companies.user_id', function ($query) {
                    $query->select('users.id')
                        ->from('users')
                        ->where('users.id', auth()->id());
                })->get();
                $query->select('location_id')
                    ->from('company_location')
                    ->where('company_id', $company->first()->id);
            })->get();
            return $locations;
        }
        return Location::all();
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
        if (! empty($request->input('client_id'))) {
            $client = Client::find($request->input('client_id'));
            $client->locations()->attach($location->id);
        } else if (! empty($request->input('company_id'))){
            $company = Company::find($request->input('company_id'));
            $company->locations()->attach($location->id);
        }
        return $location;
    }

    public function show(Location $location)
    {
        return $location;
    }

    public function update(Request $request, Location $location)
    {
        $location->update($request->all());
        return $location;
    }

    public function destroy(Location $location, Request $request)
    {
        $client = Client::findOrFail($request->input('client_id'));
        $client->locations()->detach($location->id);
        $location->delete();
    }
}
