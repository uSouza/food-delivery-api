<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Requests\ClientsRequest as Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class ClientsController extends Controller
{

    public function index()
    {
        $clients = Cache::remember('api::clients', Carbon::now()->addMinutes(10), function () {
            return Client::all();
        });
        return $clients;
    }

    public function store(Request $request)
    {
        Cache::forget('api::clients');
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        return Client::create($data);
    }

    public function show(Client $client)
    {
        $this->authorize('update', $client);,
        return $client;
    }

    public function update(Request $request, Client $client)
    {
        $this->authorize('update', $client);
        Cache::forget('api::clients');
        $client->update($request->all());
        return $client;
    }

    public function destroy(Client $client)
    {
        $this->authorize('delete', $client);
        Cache::forget('api::clients');
        $client->delete();
        return $client;
    }
}
