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
        $token = '5a5042a0-2c6e-4b8c-8d8a-0bc33470a9ad';
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token, // Include the token in the Authorization header
            'Accept' => 'application/json',       // Optional, ensures the response is in JSON format
        ])->get('https://api.webselfstorage.com/v3/movein/' . $location_number);
        $res_json = $response->body();
        return view('test-list', compact('res_json'));

    }
}
