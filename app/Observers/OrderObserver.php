<?php

namespace App\Observers;

use App\Client;
use App\Company;
use App\Order;
use App\User;
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

    public function updated(Order $order)
    {
        $client = Client::findOrFail($order->client_id);
        $user = User::findOrFail($client->user_id);

        $content = array(
            "en" => 'O seu pedido foi confirmado pelo restaurante!'
        );

        $client_http = new \GuzzleHttp\Client();
        $client_http->post(
            'https://onesignal.com/api/v1/notifications',
            [
                \GuzzleHttp\RequestOptions::JSON =>
                    ['app_id' => "18e4fb1f-4d47-4196-8ded-4883a763d9d7",
                        'include_player_ids' => array($user->onesignal_id),
                        'data' => array("foo" => "bar"),
                        'contents' => $content]
            ],
            ['Content-Type' => 'application/json',
             'Authorization' => 'Basic NjgxNTYxYzctN2FiMi00ZjlmLWE3ODItNmI1NTdmNDgxOGEy']
        );
    }
}