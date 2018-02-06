<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Requests\CompaniesRequest as Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class CompaniesController extends Controller
{
    public function index()
    {
        $companies = Cache::remember('api::companies', Carbon::now()->addMinutes(10), function () {
            return Company::all();
        });
        return $companies;
    }

    public function store(Request $request)
    {
        if (Cache::get('api::companies') != null) {
            Cache::forget('api::companies');
        }
        $company = Company::create($request->all());
        return $company;
    }

    public function show(Company $company)
    {
        if (Auth::user()->type != "admin") {
            $this->authorize('update', $company);
        }
        return $company;
    }

    public function update(Request $request, Company $company)
    {
        if (Auth::user()->type != "admin") {
            $this->authorize('update', $company);
        }
        $company->update($request->all());
        Cache::forget('api::companies');
        return $company;
    }

    public function destroy(Company $company)
    {
        if (Auth::user()->type != "admin") {
            $this->authorize('delete', $company);
        }
        Cache::forget('api::companies');
        $company->delete();
        return $company;
    }
}