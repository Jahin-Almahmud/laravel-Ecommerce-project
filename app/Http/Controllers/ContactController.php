<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contact()
    {
        return view('frontend.contact');
    }
    public function message(Request $request)
    {
        $request->validate([
            '*' => 'required',
        ]);
        Message::insert($request->except('_token'),[
            'created_at' => Carbon::now(),
        ]);
        Toastr::success('Successfull');
        return back();
    }
}
