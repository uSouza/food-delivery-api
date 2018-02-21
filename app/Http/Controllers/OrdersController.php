<?php

namespace App\Http\Controllers;

use App\Client;
use App\Order;
use App\Http\Requests\OrdersRequest as Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $company = $user->company();
        if ($user->type == "company") {
            if (!empty($company)) {
                return Order::where('id', $company->id);
            }
        }
        if ($user->type == "admin") {
            return Order::all();
        }
    }

    public function store(Request $request)
    {
        $products_ids = $request->input('products_ids');
        $client = Client::whereIn('clients.user_id', function ($query) {
            $query->select('users.id')
                ->from('users')
                ->where('users.id', auth()->id());
        })->get()->first();
        $order = Order::create([
            'price' => $request->input('price'),
            'observation' => $request->input('observation'),
            'deliver' => $request->input('deliver'),
            'client_id' => $client->id,
            'company_id' => $request->input('company_id'),
            'status_id' => $request->input('status_id'),
            'form_payment_id' => $request->input('form_payment_id'),
            'location_id' => $request->input('location_id'),
        ]);
        $order->products()->attach($products_ids);
        return $order;
    }

    public function show(Order $order)
    {
        return $order;
    }

    public function update(Request $request, Order $order)
    {
        $client = Client::whereIn('clients.user_id', function ($query) {
            $query->select('users.id')
                ->from('users')
                ->where('users.id', auth()->id());
        })->get()->first();
        $products_ids = $request->input('products_ids');
        $data = [
            'price' => $request->input('price'),
            'observation' => $request->input('observation'),
            'deliver' => $request->input('deliver'),
            'client_id' => $client->id,
            'company_id' => $request->input('company_id'),
            'status_id' => $request->input('status_id'),
            'form_payment_id' => $request->input('form_payment_id'),
            'location_id' => $request->input('location_id'),
        ];
        $order->update($data);
        $order->products()->attach($products_ids);
        return $order;
    }

    public function destroy(Order $order)
    {
        $order->products()->detach();
        $order->delete();
    }

}