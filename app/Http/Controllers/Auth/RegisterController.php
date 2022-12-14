<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected function redirectTo(){
        if (Auth::user()->role == 1) {
          return route('admindashboard');
        }else {
            return route('frontend');
            
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
            $name = $data['name'];
            $email = $data['email'];
            $password = $data['password'];
            // if ($phone_numner) {
            //     $url = "http://66.45.237.70/api.php";
            //     $number=$phone_numner;
            //     $text="Hello ".$name.". your registration has been successful!";
            //     $data= array(
            //     'username'=>"01834833973",
            //     'password'=>"TE47RSDM",
            //     'number'=>"$number",
            //     'message'=>"$text"
            //     );

            //     $ch = curl_init(); // Initialize cURL
            //     curl_setopt($ch, CURLOPT_URL,$url);
            //     curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            //     $smsresult = curl_exec($ch);
            //     $p = explode("|",$smsresult);
            //     $sendstatus = $p[0];


            // }
        return User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);
    }
}
