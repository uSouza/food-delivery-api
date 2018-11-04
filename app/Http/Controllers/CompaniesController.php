<?php

namespace App\Http\Controllers;

use App\Company;
use App\ServiceHour;
use App\User;
use App\WorkedDays;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CompaniesController extends Controller
{

    public function index()
    {
        $month = Carbon::now()->month;
        $companies = Company::with(['tags', 'additionals', 'ingredient_groups', 'ingredient_groups.ingredients', 'form_payments', 'service_hours', 'worked_days', 'user', 'locations'])->get();
        foreach ($companies as $c) {
            $number_orders =
                DB::table('orders')
                ->whereRaw('extract(month from created_at) = ? and company_id = ?', [$month, $c->id])
                ->count();
            $c->number_orders_month = $number_orders;
        }
        return $companies;
    }

    public function getAvailableCompanies()
    {
        $today = new Carbon();
        $today->format('Y-m-d');
        $now = new Carbon();
        $hour = $now->format('H:i:s');
        $weekMap = [
            0 => 'sunday',
            1 => 'monday',
            2 => 'tuesday',
            3 => 'wednesday',
            4 => 'thursday',
            5 => 'friday',
            6 => 'saturday',
        ];
        $dayOfTheWeek = Carbon::now()->dayOfWeek;
        $weekday = $weekMap[$dayOfTheWeek];

        $companies = Company::with(
            ['tags', 'additionals', 'ingredient_groups', 'ingredient_groups.ingredients', 'form_payments', 'service_hours', 'worked_days', 'locations']
        )
            ->whereRaw("companies.id in (select company_id from menus where date >= '$today')")
            ->get();

        foreach($companies as $c) {
            $wday = DB::table('worked_days')->select($weekday)->where('company_id', $c->id)->first();
            $service_hours = ServiceHour::where('company_id', $c->id)->get();
            if (! empty($wday)) {
                if ($wday->$weekday) {
                    foreach ($service_hours as $s) {
                        if ($hour >= $s->opening and $hour <= $s->closure) {
                            $c->is_open = true;
                        } else {
                            $c->is_open = false;
                        }
                    }
                } else {
                    $c->is_open = false;
                }
            }
        }
        return $companies;
    }

    public function store(Request $request)
    {
        $this->authorize('create', Company::class);
        $tags_ids = $request->input('tags_ids');
        $data = $request->except('tags_ids');
        $company = Company::create($data);
        $company->tags()->attach($tags_ids);
        return $company;
    }

    public function show($id)
    {
        $company = Company::where('id', $id)->with(['tags', 'additionals', 'ingredient_groups', 'ingredient_groups.ingredients', 'form_payments', 'service_hours', 'worked_days', 'user', 'locations'])->first();
        return $company;
    }

    public function update(Request $request, $id)
    {
        $company = Company::findOrFail($id);
        $data = $request->all();
        $company->update([
            'avg_delivery_time' => $data['avg_delivery_time'],
            'cell_phone' => $data['cell_phone'],
            'delivery_value' => $data['delivery_value'],
            'fantasy_name' => $data['fantasy_name'],
            'observation' => $data['observation'],
            'order_limit' => $data['order_limit'],
            'responsible_name' => $data['responsible_name'],
            'responsible_phone' => $data['responsible_name'],
            'social_name' => $data['social_name'],
            'url' => $data['url']
        ]);
        if (! empty($data['tags_ids'])) {
            $company->tags()->detach();
            $company->tags()->attach($data['tags_ids']);
        }
        return $company;
    }

    public function destroy(Company $company)
    {
        $this->authorize('delete', $company);
        DB::table('company_tag')->where('company_id', $company->id)->delete();
        $user = User::find($company->user_id);
        $user->delete();
        $company->delete();
        return $company;
    }

}