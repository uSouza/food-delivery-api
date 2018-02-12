<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Requests\ClientsRequest as Request;
use Illuminate\Support\Facades\Auth;

class ClientsController extends Controller
{
    public function index()
    {
        return Client::all();
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        if (Auth::user()->type == "client" || Auth::user()->type == "admin") {
            return Client::create($data);
        } else {
            return "Não está autorizado a cadastrar clientes";
        }
    }

    public function show(Client $client)
    {
        return $client;
    }

    public function update(Request $request, Client $client)
    {
        if (Auth::user()->type == "client") {
            $this->authorize('update', $client);
            $client->update($request->all());
            return $client;
        }
        if (Auth::user()->type == "admin") {
            $client->update($request->all());
            return $client;
        }
        return "Não está autorizado a editar este cliente";
    }

    public function destroy(Client $client)
    {
        if (Auth::user()->type == "client") {
            $this->authorize('delete', $client);
            $client->delete();
        }
        if (Auth::user()->type == "admin") {
            $client->delete();
        }
        return "Não está autorizado a excluir este cliente";
    }
}