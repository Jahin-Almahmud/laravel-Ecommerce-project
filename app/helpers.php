<?php

use App\Models\Cart;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Order_summery;
use App\Models\Product;
use App\Models\Subscriber;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

function users()
{
return User::where('role',2)->get();
}
function categories(){
    return Category::latest()->get();
}
// new product product
function newproducts(){
    return Product::whereDate( 'created_at', '>', Carbon::today()->subDays( 30 ) )->take(4)->get();

}
// 6  product for frontend
function products(){
    return Product::take(6)->get();
}
// latest all product for frontend

function latestproducts(){
    return Product::latest()->get();
}
// all productsOfShopPage
function productsOfShopPage(){
    return Product::paginate(15);
}
// all allproducts
function allproducts(){
    return Product::all();
}
function carts(){
    return Cart::where('user_id',Auth::user()->id)->get();
}
// all coupon
function coupons(){
    return Coupon::all();
}

function Order_summeries(){
    return Order_summery::where('user_id', Auth::user()->id)->get();
}
function subscribers()
{
    return Subscriber::latest()->get();
}
?>
