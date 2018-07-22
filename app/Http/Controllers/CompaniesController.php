<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Requests\CompaniesRequest as Request;
use App\WorkedDays;
use Illuminate\Support\Facades\Auth;

class CompaniesController extends Controller
{
    public function index()
    {
        return Company::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', Company::class);
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $company = Company::create($data);

        return $company;
    }

    public function show(Company $company)
    {
        return $company;
    }

    public function update(Request $request, Company $company)
    {
        $this->authorize('update', $company);
        $company->update($request->all());
        return $company;
    }

    public function destroy(Company $company)
    {
        $this->authorize('delete', $company);
        return $company->delete();
    }

}