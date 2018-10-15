<?php

namespace App\Http\Controllers;

use App\ServiceHour;
use Illuminate\Http\Request;

class ServiceHoursController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $company = $user->findCompanyByUser();
        if ($user->type == "company") {
            return ServiceHour::with('company')
                ->where('company_id', $company->id)
                ->get();
        }
        return ServiceHour::with('company')->get();
    }
    public function store(Request $request)
    {
        $data = $request->all();
        return ServiceHour::create($data);
    }
    public function show($id)
    {
        return ServiceHour::find($id);
    }
    public function update(Request $request, $id)
    {
        $serviceHour = ServiceHour::find($id);
        $serviceHour->update($request->all());
        return $serviceHour;
    }
    public function destroy($id)
    {
        $serviceHour = ServiceHour::find($id);
        $serviceHour->delete();
        return $serviceHour;
    }
}
