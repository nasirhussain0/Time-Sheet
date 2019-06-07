<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use GuzzleHttp\Client;
use DateTime;


class AuthController extends Controller
{
    public function register(Request $request){

    	// dd($request->all());
    	// $request->validate([
    	// 	'fullname' => 'required|string|max:255',
     //        'email' => 'required|string|email|max:255|unique:users',
     //        'password' => 'required|string|min:6',
    	// ]);
    	// dd($request->validate);

        $customerName = str_replace(' ', '',$request->fullname);
        $profilePic = $request->fullname;
        $profilePicname = $profilePic->getClientOriginalName();
         // dd($profilePicname);
        $fileName = $customerName.$profilePicname;
        // dd($fileName);
        $uploadPicPath = 'profilePics/';
        $profilePic->move($uploadPicPath,$fileName);
        $profilePicUrl = $uploadPicPath.$fileName;
        // dd($profilePicUrl);

    	$date = new DateTime();
        $date = date_format($date,'Y-m-d');
		// dd($date);
    	// $user = User::firstOrNew(['email'=>$request->email]);
		$user =  new User();    	
    	$user->fullname = $request->fullname;
    	$user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->profilePic = $request->profilePic;
        $user->registerDate = $date;
        $user->admin= 0;
        $user->payRate= 0;
        $user->numOfHolidays= 0;
        $user->save();

        $http = new Client;

	    $response = $http->post('http://127.0.0.1:8000/oauth/token', [
	        'form_params' => [
	            'grant_type' => 'password',
	            'client_id' => '2',
	            'client_secret' => 'TRsfBYRbuWdJAk4crUlPQYAP09aRKAt1701MwnR8',
	            'username' => $request->email,
	            'password' => $request->password,
	            'redirect_uri' => 'http://example.com/callback',
	            'code' => $request->code,
	        ],
	    ]);
// dd(response(['data' => json_decode((string) $response->getBody(), true)]));
	    return response(['data' => json_decode((string) $response->getBody(), true)]);


    }

    public function login(Request $request){

    }
}
