<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Thumnail_image;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'product_regular_price' => 'required',
            'quantity' => 'required',
            'category_id' => 'required',
            'product_image' => 'required',
        ]);



           $product_image = $request->product_image;
            if (isset($product_image)) {
                $image_name = Str::random(9).'.'. $product_image->getClientOriginalExtension();
                if (!Storage::disk('public')->exists('product_img')) {
                    Storage::disk('public')->makeDirectory('product_img');
                }
                $product = Image::make($product_image)->resize(249,190)->save('foo');
                Storage::disk('public')->put('product_img/'.$image_name,$product);

                if (!Storage::disk('public')->exists('product_img/product_details_img')) {
                    Storage::disk('public')->makeDirectory('product_img/product_details_img');
                }
                $product = Image::make($product_image)->resize(553,441)->save('foo');
                Storage::disk('public')->put('product_img/product_details_img/'.$image_name,$product);
            }else {
                $image_name = 'default.png';
            }// image

            if(!$request->product_discount_price){
                $discount_price = $request->product_regular_price;
            }else {
             $discount_price = $request->product_discount_price;
            }
           if($request->product_discount_price > $request->product_regular_price){
            Toastr::error('Regular price must be big than discount price');
            return back();
            }

        $product = new Product();
        $product->user_id = auth()->id();
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->product_description = $request->product_description;
        $product->product_additional_infromation = $request->product_additional_description;
        $product->product_regular_price = $request->product_regular_price;
        $product->product_discount_price =  $discount_price;
        $product->quantity = $request->quantity;
        $product->product_image = $image_name;
        $product->created_at = Carbon::now();
        if ($request->status == 1) {
            $product->status = 1;
        }else {
             $product->status = 0;
        }
        $product->save();
        $product->categories()->attach($request->category_id);
        $product_id =  $product->id;

// Thumnail_image upload
        $thumnail_image = $request->product_thumnail_image;
        if (isset($thumnail_image)) {
            if (!Storage::disk('public')->exists('product_img/product_thumnail_image')) {
                Storage::disk('public')->makeDirectory('product_img/product_thumnail_image');
            }
            foreach ($thumnail_image as $thumnail_image) {
                $thumnail_image_name = Str::random(9).'.'. $thumnail_image->getClientOriginalExtension();
                $product = Image::make($thumnail_image)->resize(680,680)->save('foo');
                Storage::disk('public')->put('product_img/product_thumnail_image/'.$thumnail_image_name,$product);
                Thumnail_image::insert([
                    'image' => $thumnail_image_name ,
                    'product_id' => $product_id,
                    'created_at' => Carbon::now(),
                ]);
            }
        }// thumnail image

        Toastr::success('Product created Successfully','success',[
            "CloseButton" => true,
            "progressBar" => true,
        ]);
        return redirect()->route('adminproduct.index');


    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->first();
        return view('dashboard.product.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $product = Product::where('slug', $slug)->first();
        return view('dashboard.product.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$slug)
    {
      $product =  Product::where('slug', $slug)->first();
      $product_id =$product->id;
      $product_image = $request->product_image;
      if (isset($product_image)) {
         $old_product_image = $product->product_image;
            if (Storage::disk('public')->exists('product_img/'. $old_product_image)) {
                Storage::disk('public')->delete('product_img/'. $old_product_image);
            }
          $image_name = Str::random(9).'.'. $product_image->getClientOriginalExtension();
          if (!Storage::disk('public')->exists('product_img')) {
              Storage::disk('public')->makeDirectory('product_img');
          }
          $link = base_path('public/storage/product_img/'.$image_name);
          Image::make($product_image)->resize(249,190)->save($link);


          if (!Storage::disk('public')->exists('product_img/product_details_img')) {
              Storage::disk('public')->makeDirectory('product_img/product_details_img');
          }
          $link = base_path('public/storage/product_img/product_details_img/'.$image_name);
          Image::make($product_image)->resize(553,441)->save($link);
      }else {
        $image_name = $product->product_image;
      }

      if(!$request->product_discount_price){
        $discount_price = $request->product_regular_price;
      }
      else {
        $discount_price = $request->product_discount_price;
        }

   if($request->product_discount_price > $request->product_regular_price){
    Toastr::error('Regular price must be big than discount price');
    return back();
    }
    $product->user_id = auth()->id();
    $product->name = $request->name;
    $product->slug = Str::slug($request->name);
    $product->product_description = $request->product_description;
    $product->product_additional_infromation = $request->product_additional_description;
    $product->product_regular_price = $request->product_regular_price;
    $product->product_discount_price =  $discount_price;
    $product->quantity = $request->quantity;
    $product->product_image = $image_name;
    $product->created_at = Carbon::now();
    if ($request->status == 1) {
        $product->status = 1;
    }else {
         $product->status = 0;
    }
     $product->categories()->update([
        'category_id' => $request->category_id,
    ]);
    $product->save();

// Thumnail_image upload
$thumnail_image = $request->product_thumnail_image;
if (isset($thumnail_image)) {
    if (!Storage::disk('public')->exists('product_img/product_thumnail_image')) {
        Storage::disk('public')->makeDirectory('product_img/product_thumnail_image');
    }
    foreach ($thumnail_image as $thumnail_image) {
        $thumnail_image_name = Str::random(9).'.'. $thumnail_image->getClientOriginalExtension();
        $product = Image::make($thumnail_image)->resize(680,680)->save('foo');
        Storage::disk('public')->put('product_img/product_thumnail_image/'.$thumnail_image_name,$product);
        Thumnail_image::insert([
            'image' => $thumnail_image_name ,
            'product_id' => $product_id,
            'created_at' => Carbon::now(),
        ]);
    }
}// thumnail image

    Toastr::success('Product updated Successfully','success',[
        "CloseButton" => true,
        "progressBar" => true,
    ]);
    return redirect()->route('adminproduct.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {

        if (Storage::disk('public')->exists('product_img/'.$product->product_image)) {
            Storage::disk('public')->delete('product_img/'.$product->product_image);
        }
        $product->delete();
        Toastr::success('Product Deleted successfully');
        return back();
    }

    public function thumnaildelete ($id)
    {
        $thumnail_image =  Thumnail_image::find($id);
       if (Storage::disk('public')->exists('product_img/product_thumnail_image/'.$thumnail_image->image)) {
        Storage::disk('public')->delete('product_img/product_thumnail_image/'.$thumnail_image->image);
        }
        $thumnail_image->delete();
        Toastr::success('Delted successfully');
        return back();
    }
    public function thumnailedit ($id)
    {
        $thumnail_image =  Thumnail_image::find($id);
       return view('dashboard.product.thumnailphotoedit',compact('thumnail_image'));
    }
    public function thumnailupdate ($id, Request $request)
    {
        $request->validate([
            '*' => 'required',
        ]);
        $thumnail_image = $request->product_thumnail_image;
       $product_thumnail_image = Thumnail_image::find($id);

        if (isset($request->product_thumnail_image)) {
            $old_thumnail_image = $product_thumnail_image->image;
            if (Storage::disk('public')->exists('product_img/product_thumnail_image/'. $old_thumnail_image)) {
                Storage::disk('public')->delete('product_img/product_thumnail_image/'. $old_thumnail_image);
            }
            $thumnail_image_name = Str::random(9).'.'. $thumnail_image->getClientOriginalExtension();
            $product = Image::make($thumnail_image)->resize(680,680)->save('foo');
            Storage::disk('public')->put('product_img/product_thumnail_image/'.$thumnail_image_name,$product);
            $product_thumnail_image->update([
                'image' => $thumnail_image_name ,
                'updated_at' => Carbon::now(),
            ]);
        }

        Toastr::success('Successfull');
        return redirect()->route('adminproduct.edit',$product_thumnail_image->product->slug);
    }
}
