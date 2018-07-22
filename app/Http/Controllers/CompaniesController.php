<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Requests\CompaniesRequest as Request;
use App\WorkedDays;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        for($i = 0; $i < count($data['additionals']); $i++) {
            DB::table('additional_company')->insert([
                'company_id' => $company->id,
                'additional_id' => $data['additionals'][$i]['add_id'],
                'value' => $data['additionals'][$i]['add_value'],
            ]);
        }
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
        $data = $request->all();
        DB::table('additional_company')->where('company_id', $company->id)->delete();
        for($i = 0; $i < count($data['additionals']); $i++) {
            DB::table('additional_company')->insert([
                'company_id' => $company->id,
                'additional_id' => $data['additionals'][$i]['add_id'],
                'value' => $data['additionals'][$i]['add_value'],
            ]);
        }
        return $company;
    }

    public function destroy(Company $company)
    {
        $this->authorize('delete', $company);
        DB::table('additional_company')->where('company_id', $company->id)->delete();
        return $company->delete();
    }

}