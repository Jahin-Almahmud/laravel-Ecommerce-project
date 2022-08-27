<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function index()
    {
        return view('dashboard.subscriber.index');
    }
    public function Subscriber(Request $request)
    {

        Subscriber::insert([
            'email'=>$request->email,
            'created_at' => Carbon::now(),
        ]);
        Toastr::success('Successfull');
        return back();
    }
    public function delete ($id)
    {
       Subscriber::find($id)->delete();
       return back();
    }
    public function contact()
    {
        return view('frontend.contact');
    }
}
