<?php

namespace App\Http\Controllers;

use App\State;
use Illuminate\Http\Request;

class StatesController extends Controller
{
    public function index()
    {
        return State::all();
    }
    public function store(Request $request)
    {
        return State::create($request->all());
    }
    public function show($id)
    {
        return State::find($id);
    }
    public function update(Request $request, $id)
    {
        $state = State::find($id);
        $state->update($request->all());
        return $state;
    }
    public function destroy($id)
    {
        $state = State::find($id);
        $state->delete();
        return $state;
    }
}
