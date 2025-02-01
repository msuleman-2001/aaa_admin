<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about() {
        return "About Page";
    } 
    
    public function chart(){
        return view("charts-chartjs");
    }

    public function tester(){
        return view ('test-list');
    }
}
