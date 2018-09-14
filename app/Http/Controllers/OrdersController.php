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
        $company = $user->findCompanyByUser();
        if ($user->type == "company") {
            if (!empty($company)) {
                return Order::where('id', $company->id)
                    ->with(['products', 'location', 'form_payment', 'client', 'company', 'products.ingredients', 'products.price', 'products.additionals', 'products.menu'])
                    ->get();
            }
        }
        if ($user->type == "admin") {
            return Order::with(['products', 'products.additionals'])->get();
        }
    }

    public function ordersByClient($id)
    {
        return Order::where('client_id', $id)
                ->with(['products', 'location', 'form_payment', 'client', 'company', 'products.ingredients', 'products.price', 'products.additionals', 'products.menu'])
                ->get();
    }

    public function store(Request $request)
    {
        $this->authorize('create', Order::class);
        $products_ids = $request->input('products_ids');
        $client = Client::whereIn('clients.user_id', function ($query) {
            $query->select('users.id')
                ->from('users')
                ->where('users.id', auth()->id());
        })->get()->first();
        $order = Order::create([
            'price' => $request->input('price'),
            'observation' => $request->input('observation'),
            'receive_at' => $request->input('receive_at'),
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
        $this->authorize('update', $order);
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
        $this->authorize('create', $order);
        $order->products()->detach();
        $order->delete();
        return $order;
    }

}