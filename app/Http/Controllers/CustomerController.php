<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function customerList(){
        return view ('customer-list');
    }
    public function customerDetail(){
        return view ('customer-detail');
    }
}