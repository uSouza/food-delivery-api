<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Requests\ClientsRequest as Request;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;

class ClientsController extends Controller
{
    public function index()
    {
        return Client::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', Client::class);
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        return Client::create($data);
    }

    public function show(Client $client)
    {
        return $client;
    }

    public function update(Request $request, Client $client)
    {
        $this->authorize('update', $client);
        $client->update($request->all());
        return $client;
    }

    public function destroy(Client $client)
    {
        $this->authorize('delete', $client);
        return $client->delete();
    }
}