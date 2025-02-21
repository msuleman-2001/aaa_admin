<?php

namespace App\Http\Controllers;
use App\Models\Payment;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function paymentList(){
        $payments = Payment::all();
        return view ('payment-list', compact('payments'));
    }

    public function paymentDetail($payment_id = 1){
        $payment = Payment::find($payment_id);
        return view ('payment-detail', compact('payment'));
    }
}