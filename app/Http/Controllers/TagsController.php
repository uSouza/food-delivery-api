<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Http\Requests\TagsRequest as Request;
use Illuminate\Support\Facades\Auth;

class TagsController extends Controller
{
    public function index()
    {
        return Tag::all();
    }

    public function store(Request $request)
    {
        if (Auth::user()->type == "admin") {
            return Tag::create($request->all());
        }
        return "Este usuario não pode cadastrar tags";
    }

    public function show(Tag $tag)
    {
        return $tag;
    }

    public function update(Request $request, Tag $tag)
    {
        $tag->update($request->all());
        return $tag;
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return $tag;
    }
}