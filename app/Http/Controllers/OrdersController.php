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
        $products_ids = $request->input('products_ids');
        $client = Client::whereIn('clients.user_id', function ($query) {
            $query->select('users.id')
                ->from('users')
                ->where('users.id', auth()->id());
        })->get()->first();
        $data = $request->except(['client_id', 'products_ids']);
        $data['client_id'] = $client->id;
        $order = Order::create($data);
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
                    ->whereIn('status_id', [1, 5])
                    ->with(['products', 'location', 'form_payment', 'client', 'company', 'products.ingredients', 'products.price', 'products.additionals', 'products.menu'])
                    ->orderBy('created_at', 'desc')
                    ->get();
            }
        }
        if ($user->type == "admin") {
            return Order::with(['products', 'location', 'form_payment', 'client', 'company', 'products.ingredients', 'products.price', 'products.additionals', 'products.menu'])
                    ->whereIn('status_id', [1, 5])
                    ->orderBy('created_at', 'desc')
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
                    ->orderBy('created_at', 'desc')
                    ->get();
            }
        }
        if ($user->type == "admin") {
            return Order::with(['products', 'location', 'form_payment', 'client', 'company', 'products.ingredients', 'products.price', 'products.additionals', 'products.menu'])
                ->where('status_id', 2)
                ->orderBy('created_at', 'desc')
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
        $order->products()->detach();
        $order->delete();
        return $order;
    }

    public function cancel($id)
    {
        $order = Order::findOrFail($id);
        $order->status_id = 5;
        $order->save();
        return $order;
    }

}