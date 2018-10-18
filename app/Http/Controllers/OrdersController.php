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
            return Order::with(['products', 'location', 'form_payment', 'client', 'company', 'products.ingredients', 'products.price', 'products.additionals', 'products.menu'])->get();
        }
    }

    public function ordersByClient($id)
    {
        return Order::where('client_id', $id)
                ->with(['products', 'location', 'form_payment', 'client', 'company', 'company.locations', 'products.ingredients', 'products.price', 'products.additionals', 'products.menu'])
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
        return Order::where('id', $order->id)
            ->with(['products', 'location', 'form_payment', 'client', 'company', 'products.ingredients', 'products.price', 'products.additionals', 'products.menu'])
            ->first();
    }

    public function getOpenOrders()
    {
        $user = Auth::user();
        $company = $user->findCompanyByUser();
        if ($user->type == "company") {
            if (!empty($company)) {
                return Order::where('company_id', $company->id)
                    ->where('status_id', 1)
                    ->with(['products', 'location', 'form_payment', 'client', 'company', 'products.ingredients', 'products.price', 'products.additionals', 'products.menu'])
                    ->get();
            }
        }
        if ($user->type == "admin") {
            return Order::with(['products', 'location', 'form_payment', 'client', 'company', 'products.ingredients', 'products.price', 'products.additionals', 'products.menu'])
                    ->where('status_id', 1)
                    ->get();
        }
    }

    public function getClosedOrders()
    {
        $user = Auth::user();
        $company = $user->findCompanyByUser();
        if ($user->type == "company") {
            if (!empty($company)) {
                return Order::where('company_id', $company->id)
                    ->where('status_id', 2)
                    ->with(['products', 'location', 'form_payment', 'client', 'company', 'products.ingredients', 'products.price', 'products.additionals', 'products.menu'])
                    ->get();
            }
        }
        if ($user->type == "admin") {
            return Order::with(['products', 'location', 'form_payment', 'client', 'company', 'products.ingredients', 'products.price', 'products.additionals', 'products.menu'])
                ->where('status_id', 2)
                ->get();
        }
    }

    public function update(Request $request, Order $order)
    {
        if (! empty($request->input('products_ids'))) {
            $products_ids = $request->input('products_ids');
            $order->products()->attach($products_ids);
        }
        $data = $request->except('products_ids');
        $order->update($data);
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