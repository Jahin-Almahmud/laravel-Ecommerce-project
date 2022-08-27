<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    public function productdetails($slug){
        $product = Product::where('slug', $slug)->first();
        $product_id = $product->id;
        $categories = $product->categories()->get();
        return  view('frontend.product_details', compact('product','categories','product_id'));
    }
    public function categorywiseProduct($slug)
    {
         $category = Category::where('slug',$slug)->first();
        $products = $category->products;
        return view('frontend.categorywiseproduct', compact('category', 'products'));
    }
    public function wishlistindex()
    {
        $favoriteProducttoUser = Auth::user()->favorite_products;
        return view('frontend.wishlist',compact('favoriteProducttoUser'));
    }
}
