<?php

namespace App\Http\Controllers;

use App\Interest;
use Illuminate\Http\Request;

class InterestsController extends Controller
{
    public function index()
    {
        return Interest::all();
    }

    public function count()
    {
        $interest = Interest::findOrFail(1);
        $interest->increment('visits');
        return "Obrigado pelo interesse!";
    }
}
