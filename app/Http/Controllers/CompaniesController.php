<?php

namespace App\Http\Controllers;

use App\Company;
use App\Menu;
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
        $companies = Company::with(
            [
                'tags', 'additionals', 'ingredient_groups', 'ingredient_groups.ingredients',
                'form_payments', 'service_hours', 'worked_days', 'user', 'locations',
                'locations.district', 'locations.district.city', 'locations.district.city.state'
            ]
        )->get();
        foreach ($companies as $c) {
            $number_orders =
                DB::table('orders')
                ->whereRaw('extract(month from created_at) = ? and company_id = ? and status_id=2', [$month, $c->id])
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
            [
                'tags', 'additionals', 'ingredient_groups', 'ingredient_groups.ingredients',
                'form_payments', 'service_hours', 'worked_days', 'user', 'locations', 
                'locations.district', 'locations.district.city', 'locations.district.city.state', 
            ]
        )->get();

        foreach($companies as $c) {
            $wday = DB::table('worked_days')->select($weekday)->where('company_id', $c->id)->first();
            $service_hours = ServiceHour::where('company_id', $c->id)->get();
            $menus = Menu::where('company_id', $c->id)
                ->where(function ($query) {

                    $today = new Carbon();
                    $today->format('Y-m-d');

                    $query->where('date', $today)
                        ->orWhere('fixed_menu', true);
                })->count();
            if (! empty($wday)) {
                if ($wday->$weekday) {
                    $c->is_open = false;
                    foreach ($service_hours as $s) {
                        $opening = Carbon::parse($s->opening)->format('H:i:s');
                        $closure = Carbon::parse($s->closure)->format('H:i:s');
                        if (! $c->is_open) {
                            if ($hour >= $opening and $hour <= $closure and $menus > 0) {
                                $c->is_open = true;
                            } else {
                                $c->is_open = false;
                            }
                        }
                    }
                } else {
                    $c->is_open = false;
                }
            }
            $c ->open_at = DB::table('service_hours')->where('company_id', $c->id)->min('opening');
        }
        return $companies;
    }

    public function getAvailableCompaniesByCity($city_id)
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

        $all_companies = Company::with(
            [
                'tags', 'additionals', 'ingredient_groups', 'ingredient_groups.ingredients',
                'form_payments', 'service_hours', 'worked_days', 'user', 'locations',
                'locations.district', 'locations.district.city', 'locations.district.city.state',
            ]
        )->get();

        $companies = array();

        foreach ($all_companies as $c) {
            foreach ($c->locations as $l) {
               if ($l->district->city_id == $city_id) {
                    array_push($companies, $c);
                }
            }
        }

        foreach($companies as $c) {
            $wday = DB::table('worked_days')->select($weekday)->where('company_id', $c->id)->first();
            $service_hours = ServiceHour::where('company_id', $c->id)->get();
            $menus = Menu::where('company_id', $c->id)
                ->where(function ($query) {

                    $today = new Carbon();
                    $today->format('Y-m-d');

                    $query->where('date', $today)
                        ->orWhere('fixed_menu', true);
                })->count();
            if (! empty($wday)) {
                if ($wday->$weekday) {
                    $c->is_open = false;
                    foreach ($service_hours as $s) {
                        $opening = Carbon::parse($s->opening)->format('H:i:s');
                        $closure = Carbon::parse($s->closure)->format('H:i:s');
                        if (! $c->is_open) {
                            if ($hour >= $opening and $hour <= $closure and $menus > 0) {
                                $c->is_open = true;
                            } else {
                                $c->is_open = false;
                            }
                        }
                    }
                } else {
                    $c->is_open = false;
                }
            }
            $c ->open_at = DB::table('service_hours')->where('company_id', $c->id)->min('opening');
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
        $company = Company::where('id', $id)->with([
            'tags', 'additionals', 'ingredient_groups', 'ingredient_groups.ingredients',
            'form_payments', 'service_hours', 'worked_days', 'user', 'locations',
            'locations.district', 'locations.district.city', 'locations.district.city.state'
        ])->first();
        return $company;
    }

    public function update(Request $request, Company $company)
    {
        $data = $request->all();
        $company->update($request->except('tags_ids'));
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