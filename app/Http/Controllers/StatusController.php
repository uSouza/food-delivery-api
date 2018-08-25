<?php

namespace App\Http\Controllers;

use App\Status;
use  App\Http\Requests\StatusRequest as Request;
use Illuminate\Support\Facades\Auth;

class StatusController extends Controller
{
    public function index()
    {
        return Status::all();
    }

    public function store(Request $request)
    {
        return Status::create($request->all());
    }

    public function show(Status $status)
    {
        return $status;
    }

    public function update(Request $request, Status $status)
    {
        $status->update($request->all());
        return $status;
    }

    public function destroy(Status $status)
    {
        $status->delete();
        return $status;
    }
}