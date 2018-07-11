<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Requests\CompaniesRequest as Request;
use Illuminate\Support\Facades\Auth;

class CompaniesController extends Controller
{
    public function index()
    {
        return Company::all();
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        Company::create($data);

    }

    public function show(Company $company)
    {
        $this->authorize('update', $company);
        return $company;
    }

    public function update(Request $request, Company $company)
    {
        if (Auth::user()->type == "client") {
            $this->authorize('update', $company);
            $company->update($request->all());
            return $company;
        }
        if (Auth::user()->type == "admin") {
            $company->update($request->all());
            return $company;
        }
        return "Não está autorizado a editar esta empresa";
    }

    public function destroy(Company $company)
    {
        if (Auth::user()->type == "client") {
            $this->authorize('delete', $company);
            $company->delete();
            return $company;
        }
        if (Auth::user()->type == "admin") {
            $company->delete();
            return $company;
        }
        return "Não está autorizado a excluir esta empresa";
    }

    public function upload(Company $company, Request $request)
    {
        $url = $request->file('url');
        $ext = ['jpg', 'png', 'gif', 'jpeg'];
        $url_ext = $url->extension();
        if ($url->isValid() and in_array($url_ext, $ext)) {
            $filename = $company->id . '-' . $company->social_name;
            $url->storeAs('img/companies', $filename);
            return "img/companies/" . $filename . $url_ext;
        }
        return null;
    }

}