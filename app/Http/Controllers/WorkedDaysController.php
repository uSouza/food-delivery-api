<?php

namespace App\Http\Controllers;

use App\WorkedDays;
use Illuminate\Http\Request;

class WorkedDaysController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $company = $user->findCompanyByUser();
        if ($user->type == "company") {
            return WorkedDays::with('company')
                ->where('company_id', $company->id)
                ->get();
        }
        return WorkedDays::with('company')->get();
    }
    public function store(Request $request)
    {
        $data = $request->all();
        return WorkedDays::create($data);
    }
    public function show($id)
    {
        return WorkedDays::find($id);
    }
    public function update(Request $request, $id)
    {
        $wdays = WorkedDays::findOrFail($id);
        $wdays->update($request->all());
        return $wdays;
    }
    public function destroy($id)
    {
        $wdays = WorkedDays::find($id);
        $wdays->delete();
        return $wdays;
    }
}
