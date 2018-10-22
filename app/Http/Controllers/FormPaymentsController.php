<?php

namespace App\Http\Controllers;

use App\FormPayment;
use App\Http\Requests\FormPaymentsRequest as Request;
use Illuminate\Support\Facades\Auth;

class FormPaymentsController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $company = $user->findCompanyByUser();

        if ($user->type == "company") {
            return FormPayment::where('company_id', $company->id)->get();
        }

        return FormPayment::all();
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $company = $user->findCompanyByUser();
        return FormPayment::create([
            'company_id' => $company->id,
            'description' => $request->input('description')
        ]);
    }

    public function show(FormPayment $form_payment)
    {
        return $form_payment;
    }

    public function update(Request $request, FormPayment $form_payment)
    {
        $form_payment->update($request->all());
        return $form_payment;
    }

    public function destroy(FormPayment $form_payment)
    {
        $form_payment->delete();
        return $form_payment;
    }
}