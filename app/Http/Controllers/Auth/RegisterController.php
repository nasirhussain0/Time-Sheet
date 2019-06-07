<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use DateTime;

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
    protected $redirectTo = '/home';

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
            'fullname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'profilePic'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        // dd($data);
        // dd($data['profilePic']);
        $customerName = str_replace(' ', '',$data['fullname']);
        // dd($customerName);
        $profilePic = $data['profilePic'];
        // dd($profilePic);
        $profilePicname = $profilePic->getClientOriginalName();
        // dd($profilePicname);
        $fileName = $customerName.$profilePicname;
        // dd($fileName);
        $uploadPicPath = 'profilePics/';
        $profilePic->move($uploadPicPath,$fileName);
        $profilePicUrl = $uploadPicPath.$fileName;
        // dd($profilePicUrl);

        //create date for database field registerDate
        $date = new DateTime();
        $date = date_format($date,'Y-m-d');

        return User::create([
            'fullname' => $data['fullname'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'profilePic'=>$profilePicUrl,
            'registerDate' => $date,
            'admin'=>0,
            'payRate'=>0,
            'numOfHolidays'=>0,
        ]);
    }
}
