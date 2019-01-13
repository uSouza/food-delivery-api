<?php

namespace App\Http\Controllers;

use App\Client;
use App\Location;
use App\Http\Requests\LocationsRequest as Request;

class ClientsLocationsController extends Controller
{
    public function index()
    {
        return Location::findLocationsByClient();
    }

    public function store(Request $request)
    {
        $location = Location::create([
            'address' => $request->input('address'),
            'number' => $request->input('number'),
            'district_id' => $request->input('district_id'),
            'postal_code' => $request->input('postal_code'),
            'observation' => $request->input('observation'),
        ]);
        $user = auth()->user();
        $client = $user->findClientByUser();
        $client->locations()->attach($location->id);

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
        $client = $user->findClientByUser();
        $client->locations()->detach($location->id);
        $location->delete();
        return $location;
    }
}
