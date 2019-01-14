<?php

namespace App\Http\Controllers;

use App\Freight;
use Illuminate\Http\Request;

class FreightsController extends Controller
{
    public function index()
    {
        return Freight::all();
    }

    public function getFreightsByCompany($company_id)
    {
        return Freight::with('district')->where('company_id', $company_id)->get();
    }

    public function store(Request $request)
    {
        return Freight::create($request->all());
    }

    public function show($id)
    {
        return Freight::find($id);
    }

    public function update(Request $request, $id)
    {
        $freight = Freight::find($id);
        $freight->update($request->all());
        return $freight;
    }

    public function destroy($id)
    {
        $freight = Freight::find($id);
        $freight->delete();
        return $freight;
    }
}
