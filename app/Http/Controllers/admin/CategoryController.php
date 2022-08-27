<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Brian2694\Toastr\Facades\Toastr;
use Brian2694\Toastr\Toastr as ToastrToastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
Use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.category.create');
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
            'name' => 'required|unique:categories',
            'category_image' => 'required|image',
        ]);
        $category_name =  $request->name;
        $category_image =  $request->category_image;
        if ($category_image) {
            $imageName = uniqid().".".$category_image->getClientOriginalExtension();

            // check category dir exists
            if (!Storage::disk('public')->exists(path:'category')) {
                Storage::disk('public')->makeDirectory(path:'category');
            }
            $category = Image::make($category_image)->resize(200,256)->save('foo');
             Storage::disk('public')->put('category/'.$imageName,$category);
        }else{
            $imageName = 'default.png';
        }
        Category::insert([
            'name' => $category_name,
            'slug' => Str::slug($category_name)."-".uniqid(1),
            'category_image' => $imageName,
            'created_at' => Carbon::now(),
        ]);
        Toastr::success('Category created successfully', 'success');
        return redirect()->route('admincategory.index');



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $category =  Category::where('slug', $slug)->first();
        return view('dashboard.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=> 'required',
            'category_image' => 'required',

        ]);

        $category_name = $request->name;
        $category_image =  $request->category_image;

        if ($category_image) {
            $old_category_image = Category::find($id)->category_image;
            if (Storage::disk('public')->exists('category/'. $old_category_image)) {
                Storage::disk('public')->delete('category/'. $old_category_image);
            }

            $imageName = uniqid().".".$category_image->getClientOriginalExtension();
            // check category dir exists
            if (!Storage::disk('public')->exists('category')) {
                Storage::disk('public')->makeDirectory('category');
            }

            $category = Image::make($category_image)->resize(200,256)->save('foo');
            Storage::disk('public')->put('category/'.$imageName,$category);
        }
          Category::find($id)->update([
            'name' => $category_name,
            'category_image' => $imageName,
            'updated_at' => Carbon::now(),
          ]);
         Toastr::success('category updated successfully ');
         return redirect()->route('admincategory.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category_image = Category::find($id)->category_image;

        if (Storage::disk('public')->exists('category/'. $category_image)) {
            Storage::disk('public')->delete('category/'. $category_image);
        }
        Category::find($id)->delete();
        Toastr::success('Category Deleted successfully!');
        return back();
    }
}
