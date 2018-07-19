<?php

namespace App\Observers;

use App\Company;
use App\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class OrderObserver
{
    public function creating(Order $order)
    {
        $now = new Carbon();
        $now->format('Y-m-d');
        $company = Company::find($order->company_id);
        $count = Order::select(DB::raw('COUNT(id) As order_count'))
                    ->whereRaw("cast(created_at as date) = '".$now."'")
                    ->get();
        $limit = $company->order_limit;
        if ($count->first()->order_count >= $limit){
            return false;
        }
    }
}