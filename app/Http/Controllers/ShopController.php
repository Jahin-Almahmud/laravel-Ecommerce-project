<?php

namespace App\Http\Controllers;

use App\Models\Order_summery;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        return view('frontend.shop');
    }
    public function dashboard()
    {
        return view('frontend.dashboard');
    }
    
}
