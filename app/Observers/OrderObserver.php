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
    public function updated(Order $order)
    {
        $client = Client::findOrFail($order->client_id);
        $user = User::findOrFail($client->user_id);
        $company = Company::findOrFail($order->company_id);
        $user_company = User::findOrFail($company->user_id);
        $content = null;
        $heading = null;

        if ($order->status_id == 2) {
            $content = array(
                "en" => 'O seu pedido foi confirmado pelo restaurante ' . $company->fantasy_name
            );
            $heading = array(
                "en" => 'Pedido confirmado'
            );
        } else if ($order->status_id == 4) {
            $content = array(
                "en" => 'O seu pedido foi rejeitado pelo restaurante ' . $company->fantasy_name . '. Pedimos desculpas. Por favor, realize seu pedido em outro restaurante!'
            );
            $heading = array(
                "en" => 'Pedido rejeitado'
            );

        } else if ($order->status_id == 5) {
            $content = array(
                "en" => 'O seu pedido do restaurante ' . $company->fantasy_name . ' foi cancelado com sucesso.'
            );
            $heading = array(
                "en" => 'Pedido cancelado'
            );

        }

        $client_http = new \GuzzleHttp\Client();
        $client_http->post(
            'https://onesignal.com/api/v1/notifications',
            [
                \GuzzleHttp\RequestOptions::JSON =>
                    [
                        'app_id' => "18e4fb1f-4d47-4196-8ded-4883a763d9d7",
                        'include_player_ids' => array($user->onesignal_id),
                        'data' => array("foo" => "bar"),
                        'contents' => $content,
                        'headings' => $heading
                    ]
            ],
            [
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic NjgxNTYxYzctN2FiMi00ZjlmLWE3ODItNmI1NTdmNDgxOGEy'
            ]
        );

        if ($order->status_id == 5) {
            $content = array(
                "en" => 'Um pedido foi cancelado :('
            );
            $heading = array(
                "en" => 'Pedido cancelado'
            );
            $client_http->post(
                'https://onesignal.com/api/v1/notifications',
                [
                    \GuzzleHttp\RequestOptions::JSON =>
                        [
                            'app_id' => "f9e6f12d-e1d9-449f-b5e8-0294874f286c",
                            'include_player_ids' => array($user_company->onesignal_id),
                            'data' => array("foo" => "bar"),
                            'contents' => $content,
                            'headings' => $heading
                        ]
                ],
                [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Basic YWVhOTUyMzItMDc0YS00MTBmLTkxMGYtOTFmZTAwN2MzMTkw'
                ]
            );
        }

    }

    public function created(Order $order) {
        $company = Company::findOrFail($order->company_id);
        $user = User::findOrFail($company->user_id);

        $content = null;
        $heading = null;

        $content = array(
            "en" => 'Novo pedido recebido :)'
        );
        $heading = array(
            "en" => 'Pedido recebido'
        );

        $client_http = new \GuzzleHttp\Client();
        $client_http->post(
            'https://onesignal.com/api/v1/notifications',
            [
                \GuzzleHttp\RequestOptions::JSON =>
                    [
                        'app_id' => "f9e6f12d-e1d9-449f-b5e8-0294874f286c",
                        'include_player_ids' => array($user->onesignal_id),
                        'data' => array("foo" => "bar"),
                        'contents' => $content,
                        'headings' => $heading
                    ]
            ],
            [
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic YWVhOTUyMzItMDc0YS00MTBmLTkxMGYtOTFmZTAwN2MzMTkw'
            ]
        );
    }
}