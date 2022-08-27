<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class AdminController extends Controller
{
    public function index()
    {
        return view('dashboard.home');
    }
    public function profile()
    {
        return view('dashboard.profile');
    }
    public function password()
    {
        return view('dashboard.password');
    }
    public function changepassword (Request $request)
    {
        $request->validate([
            'old_password'=> 'required',
            'new_password'=> 'required|min:6',
            'confirm_password'=> 'required|same:new_password',
        ]);


        if (Hash::check($request->old_password, Auth::user()->password)) {
            $user_id = Auth::user()->id;
            User::find($user_id)->update([
                'password' => Hash::make($request->new_password),
            ]);

        }
        else {
            Toastr::error('Old password does not match');

            return back();
        }

        Toastr::success('password changed successfully');
        return back();
    }

    public function changephoto(Request $request)
    {


        $name = $request->name;
        $profile_photo =  $request->profile_photo;

        if(isset($name)){

          User::find(Auth::user()->id)->update([
            'name'=> $request->name,
          ]);
        }
        if(isset($profile_photo)){
            $image_name = Auth::user()->name ."-". uniqid(2) .".". $profile_photo->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('profile_photos')){
                Storage::disk('public')->makeDirectory('profile_photos');
            }

            if(Storage::disk('public')->exists('profile_photos/'. Auth::user()->profile_photo)){
                Storage::disk('public')->delete('profile_photos/'. Auth::user()->profile_photo);
            }
            $link = base_path('public/storage/profile_photos/'.$image_name);
            Image::make($profile_photo)->resize(128,128)->save($link);

            User::find(Auth::user()->id)->update([
                'profile_photo'=> $image_name,
                 'updated_at' => Carbon::now(),
            ]);

        }
        Toastr::success('Updated Successfully');
        return back();
    }
}
