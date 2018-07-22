<?php

namespace App\Http\Controllers;

use App\OrderEvaluation;
use Illuminate\Http\Request;

class OrderEvaluationsController extends Controller
{
    public function index()
    {
        return OrderEvaluation::all();
    }
    public function store(Request $request)
    {
        return OrderEvaluation::create($request->all());
    }
    public function show($id)
    {
        return OrderEvaluation::find($id);
    }
    public function update(Request $request, $id)
    {
        $evaluation = OrderEvaluation::find($id);
        $evaluation->update($request->all());
        return $evaluation;
    }
    public function destroy($id)
    {
        $evaluation = OrderEvaluation::find($id);
        $evaluation->delete();
        return $evaluation;
    }
}
