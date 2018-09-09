<?php

namespace App\Http\Controllers;

use App\Additional;
use App\Company;
use Illuminate\Http\Request;

class AdditionalsController extends Controller
{
    public function index()
    {
        return Additional::all();
    }

    public function store(Request $request)
    {
        return Additional::create($request->all());
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

    public function destroy(Additional $add)
    {
        $add->delete();
        return $add;
    }
}
