<?php

namespace App\Http\Controllers;

use App\FormPayment;
use App\Http\Requests\FormPaymentsRequest as Request;
use Illuminate\Support\Facades\Auth;

class FormPaymentsController extends Controller
{
    public function index()
    {
        return FormPayment::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', FormPayment::class);
        return FormPayment::create($request->all());
    }

    public function show(FormPayment $form_payment)
    {
        $this->authorize('view', $form_payment);
        return $form_payment;
    }

    public function update(Request $request, FormPayment $form_payment)
    {
        $this->authorize('update', $form_payment);
        $form_payment->update($request->all());
        return $form_payment;
    }

    public function destroy(FormPayment $form_payment)
    {
        $this->authorize('delete', $form_payment);
        $form_payment->delete();
        return $form_payment;
    }
}