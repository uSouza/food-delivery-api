<?php

namespace App\Http\Controllers;

use App\Additional;
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
