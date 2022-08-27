<?php

namespace App\Http\Controllers;

use App\Models\Order_detail;
use App\Models\Order_summery;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Crypt;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('frontend.home');
    }
    public function download()
    {
        $pdf = Pdf::loadView('pdf.invoice');
        return $pdf->download('invoice.pdf');
    }
    public function orderdetail($id)
    {
        $id = Crypt::decryptString($id);
        $Order_summery = Order_summery::find($id);
         $order_details = Order_detail::where('order_summery_id', $id)->get();

        return view('frontend.order_detail',compact('Order_summery','order_details'));
    }

}
