<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ContactsController extends Controller
{
    public function index()
    {
        return Contact::all();
    }

    public function store(Request $request)
    {
        Contact::create($request->all());
        return Redirect::to('https://www.pandeco.com.br');
    }

    public function show(Contact $contact)
    {
        return $contact;
    }

    public function update(Request $request, Contact $contact)
    {
        $contact->update($request->all());
        return $contact;
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return $contact;
    }
}
