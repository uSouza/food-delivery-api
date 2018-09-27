<?php

namespace App\Http\Controllers;

use App\Additional;
use App\Company;
use Illuminate\Http\Request;

class AdditionalsController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $company = $user->findCompanyByUser();
        if ($user->type == "company") {
            return Additional::with('company')
                    ->where('company_id', $company->id)
                    ->get();
        }
        return Additional::with('company')->get();
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $company = $user->findCompanyByUser();
        return Additional::create([
            'name' => $request->input('name'),
            'value' => $request->input('value'),
            'isDrink' => $request->input('isDrink'),
            'company_id' => $company->id
        ]);
    }

    public function show(Additional $add)
    {
        return $add;
    }

    public function getAdditionalsFromCompany($id)
    {
        $company = Company::findOrFail($id);
        return Additional::where('company_id', $company->id);
    }

    public function update(Request $request, Additional $add)
    {
        $add->update($request->all());
        return $add;
    }

    public function destroy($id)
    {
        $add = Additional::findOrFail($id);
        $add->delete();
        return $add;
    }
}
