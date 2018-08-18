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
        return Company::with(['tags', 'additionals', 'menus', 'ingredient_groups'])->get();
    }

    public function getAdditionalsFromCompany($id)
    {
        $company = Company::findOrFail($id);
        return DB::table('additional_company')
                ->join('additionals', 'additional_company.additional_id', '=', 'additionals.id')
                ->select('additionals.name', 'additional_company.*')
                ->where('additional_company.company_id', $company->id)
                ->get();
    }

    public function store(Request $request)
    {
        $this->authorize('create', Company::class);
        $tags_ids = $request->input('tags_ids');
        $data = $request->except('tags_ids');
        $data['user_id'] = Auth::user()->id;
        $company = Company::create($data);
        if (! empty($data['additionals'])) {
            for ($i = 0; $i < count($data['additionals']); $i++) {
                DB::table('additional_company')->insert([
                    'company_id' => $company->id,
                    'additional_id' => $data['additionals'][$i]['add_id'],
                    'value' => $data['additionals'][$i]['add_value'],
                ]);
            }
        }
        if (! empty($data['ingredient_groups'])) {
            for ($i = 0; $i < count($data['ingredient_groups']); $i++) {
                DB::table('company_ingredient_group')->insert([
                    'company_id' => $company->id,
                    'ingredient_group_id' => $data['ingredient_groups'][$i]['group_id'],
                    'additional_value' => $data['ingredient_groups'][$i]['group_value'],
                ]);
            }
        }
        $company->tags()->attach($tags_ids);
        return $company;
    }

    public function show($id)
    {
        $company = Company::find($id)->with(['tags', 'additionals', 'menus'])->first();
        $this->authorize('view', $company);
        return $company;
    }

    public function update(Request $request, Company $company)
    {
        $this->authorize('update', $company);
        $company->update($request->all());
        $data = $request->all();
        if (! empty($data['additionals'])) {
            DB::table('additional_company')->where('company_id', $company->id)->delete();
            for ($i = 0; $i < count($data['additionals']); $i++) {
                DB::table('additional_company')->insert([
                    'company_id' => $company->id,
                    'additional_id' => $data['additionals'][$i]['add_id'],
                    'value' => $data['additionals'][$i]['add_value'],
                ]);
            }
        }
        if (! empty($data['ingredient_groups'])) {
            for ($i = 0; $i < count($data['ingredient_groups']); $i++) {
                DB::table('company_ingredient_group')->insert([
                    'company_id' => $company->id,
                    'ingredient_group_id' => $data['ingredient_groups'][$i]['group_id'],
                    'additional_value' => $data['ingredient_groups'][$i]['group_value'],
                ]);
            }
        }
        if (! empty($data['tags_ids'])) {
            $company->tags()->attach($data['tags_ids']);
        }
        return $company;
    }

    public function destroy(Company $company)
    {
        $this->authorize('delete', $company);
        DB::table('additional_company')->where('company_id', $company->id)->delete();
        DB::table('company_ingredient_group')->where('company_id', $company->id)->delete();
        DB::table('company_tag')->where('company_id', $company->id)->delete();
        $company->delete();
        return $company;
    }

}