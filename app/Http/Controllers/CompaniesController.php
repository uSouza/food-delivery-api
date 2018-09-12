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
        return Company::with(['tags', 'additionals', 'menus', 'ingredient_groups', 'ingredient_groups.ingredients', 'form_payments'])->get();
    }

    public function store(Request $request)
    {
        $this->authorize('create', Company::class);
        $tags_ids = $request->input('tags_ids');
        $data = $request->except('tags_ids');
        $data['user_id'] = Auth::user()->id;
        $company = Company::create($data);
        $company->tags()->attach($tags_ids);
        return $company;
    }

    public function show($id)
    {
        $company = Company::find($id)->with(['tags', 'additionals', 'menus', 'ingredient_groups', 'ingredient_groups.ingredients', 'form_payments'])->first();
        $this->authorize('view', $company);
        return $company;
    }

    public function update(Request $request, Company $company)
    {
        $this->authorize('update', $company);
        $dataCompany = $request->except(['ingredient_groups', 'tags_ids']);
        $data = $request->all();
        $company->update($dataCompany);
        if (! empty($data['tags_ids'])) {
            $company->tags()->attach($data['tags_ids']);
        }
        return $company;
    }

    public function destroy(Company $company)
    {
        $this->authorize('delete', $company);
        DB::table('company_tag')->where('company_id', $company->id)->delete();
        $company->delete();
        return $company;
    }

}