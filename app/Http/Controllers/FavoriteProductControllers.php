<?php

namespace App\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteProductControllers extends Controller
{
    public function add_remove(Request $request,  $id)
    {
        if($request->ajax()){
            $user = Auth::user();
            $isFavorite = $user->favorite_products()->where('product_id', $id)->count();
            if ($isFavorite == 0) {
                $user->favorite_products()->attach($id);
                Toastr::success('successfully added in your wishlist');
                return response()->json(['return' => 'some data']);
            } else {
                $user->favorite_products()->detach($id);
                Toastr::info('successfully remove in your wishlist');
                return response()->json(['return' => 'some data']);


            }


        }
        return back();
    }
}
