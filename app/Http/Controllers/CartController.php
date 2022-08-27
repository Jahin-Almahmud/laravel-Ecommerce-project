<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Product;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
Use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        if (isset($_GET['coupon'])) {
            if ($_GET['coupon']) {
                $coupon_name = $_GET['coupon'];
                if ( Coupon::where('coupon_name',$coupon_name)->exists()) {
                    $coupon = Coupon::where('coupon_name',$coupon_name)->first();
                    if ($coupon->limit != 0) {
                        if ($coupon->validaty <= Carbon::today()->format('Y-m-d')) {

                             $discount = (session('s_cart_total') * $coupon->coupon_percentige)/100;

                        } else {
                            Toastr::error("$coupon_name coupon date is over!");
                            return redirect()->route('cart.index');
                        }



                    } else {
                        Toastr::error("$coupon_name limit is over!");
                        return redirect()->route('cart.index');
                    }

                } else {
                    Toastr::error("$coupon_name coupon is not our records!");
                    return redirect()->route('cart.index');
                }


            } else {
                $coupon_name = "";
               $discount = 0;
            }

        } else {
            $coupon_name = "";
            $discount = 0;
        }

         $user = auth()->user();
        $carts = $user->carts()->get();
        return view('frontend.cart',compact('carts','discount','coupon_name'));
    }
    public function cartadd($id,Request $request)
    {
        $product = Product::find($id);

        $isCart =  DB::table('carts')->where('user_id',Auth::user()->id)
        ->where('product_id', $id)->exists();
        if ($isCart == 0) {
            $cart = new Cart();
            $cart->user_id = Auth::user()->id;
            $cart->product_id = $id;
            $cart->amount= $request->prduct_qunatity ;
            $cart->save();
            Toastr::success('Added successfully in cart');
            return back();

         }
        else {



            if ($product->quantity <= Cart::where('product_id',$id)->first()->amount) {
                Toastr::info('Already in the cart');
                return back();
            }else{
            DB::table('carts')->where('user_id',Auth::user()->id)->where('product_id', $id)->increment('amount',$request->prduct_qunatity);
            Toastr::success('Added successfully in cart');
            return back();
            }
        }



    }
    public function cartupdate(Request $request)
    {
        foreach ($request->qtybutton as $id => $amount) {
            $cart = Cart::find($id);
            $cart->amount = $amount;
            $cart->save();

        }
        Toastr::success('Cart Updated successfully');
        return back();
    }

    public function cartremove($id)
    {
        $cart = Cart::find($id);
        $cart->delete();
        Toastr::success('remove successfully in cart');
        return back();
    }
}
