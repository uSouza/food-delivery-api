<?php

namespace App\Http\Controllers;

use App\WorkedDays;
use Illuminate\Http\Request;

class WorkedDaysController extends Controller
{
    public function index()
    {
        return WorkedDays::all();
    }
    public function store(Request $request)
    {
        return WorkedDays::create($request->all());
    }
    public function show($id)
    {
        return WorkedDays::find($id);
    }
    public function update(Request $request, $id)
    {
        $wdays = WorkedDays::find($id);
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
