<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search (Request $request)
    {
        $query =  $request->search;
      $products =   Product::where('name', 'LIKE', "%$query%")->get();
      return view('frontend.search',compact('products'));
    }
}
