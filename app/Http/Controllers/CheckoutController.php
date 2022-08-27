<?php

namespace App\Http\Controllers;

use App\Models\Billing_dettail;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\District;
use App\Models\Division;
use App\Models\Order_detail;
use App\Models\Order_summery;
use App\Models\Product;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function cheakout()
    {

        if (strpos(url()->previous(), 'cart') || strpos(url()->previous(), 'cheakout')) {
            $divisions =  Division::get(['id','name']);
            return view('frontend.checkout',compact('divisions'));

        } else {
            abort(404);
        }

    }
    public function getcity($id)
    {
        $districts =  District::where('division_id',$id)->get(['id','name']);
        $city = "";
        foreach ($districts as $district) {
            $city .= "<option value='$district->id'>$district->name</option>";
        }
        echo $city;
    }
    public function cheakoutpost(Request $request)
    {

         $request->validate(['*' => 'required','message' => 'nullable']);

       $Order_summery_id =   Order_summery::insertGetId([
            'user_id'=> Auth::user()->id,
            'cart_total'=>session('s_cart_total'),
            'discount_total'=> session('s_total_discount') ,
            'sub_total'=> round(session('s_cart_total') - session('s_total_discount')),
            'shipping'=> 60 ,
            'grand_total'=> round(session('s_cart_total') - session('s_total_discount')) +60 ,
            'payment_option'=> $request->payment_option,
            'coupon_name'=> session('s_coupon_name') ,
            'created_at'=> Carbon::now() ,
         ]);
         Billing_dettail::insert([
            'order_summery_id'=> $Order_summery_id,
            'name'=> $request->name,
            'email'=> $request->email,
            'division'=> $request->division,
            'city'=> $request->city,
            'address'=> $request->address,
            'postcode'=> $request->postcode,
            'phone'=> $request->number,
            'message'=> $request->message,
            'created_at' => Carbon::now(),
         ]);

         foreach (carts() as $cart) {

            Order_detail::insert([
                'order_summery_id'=>$Order_summery_id,
                'product_id'=> $cart->product_id,
                'amount'=> $cart->amount,
                'created_at' => Carbon::now(),
            ]);
            // product table deduction
             Product::find($cart->product_id)->decrement('quantity',$cart->amount);
            //  cart delete
            Cart::find($cart->id)->delete();
         }
         if (session('s_coupon_name')) {
            Coupon::where('coupon_name', session('s_coupon_name'))->decrement('limit',1);
         }
         if ($request->payment_option == 1) {
            Toastr::success('Purchase completed successfully');
            return redirect()->route('cart.index');
         }else {
            Session::put('s_Order_summery_id',$Order_summery_id);
            return redirect('pay');

         }


    }

}
