<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use GuzzleHttp\Client;
use DateTime;
use Auth;
use DB; 
use Illuminate\Support\Facades\Hash;

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
        $profilePicname = 'test';
               // $profilePicname = $profilePic->getClientOriginalName();
         // dd($profilePicname);
        $fileName = $customerName.$profilePicname;
        // dd($fileName);
        $uploadPicPath = 'profilePics/';
        // $profilePic->move($uploadPicPath,$fileName);
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
        // dd($user);

        $getUserId = DB::getPdo()->lastInsertId();
        // dd($getUserId);
        $getUserDetails = DB::table('users')->where('id', $getUserId)->first();
        // dd($getUserDetails);

        $email =  $getUserDetails->email;
        $password = $getUserDetails->password;
        // dd($email,  $password);

        // 'csrf-token' => csrf_token()  

        $http = new Client;
        // $response = User::all();
        // dd($response);
       // its from here the url
        $response = $http->post(url('oauth/token'), [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => '2',
                'client_secret' => 'yetm6ZZ9g5aPeMC7VNqrxwVdP56MDG3mPuGY7Xgw',
                'username' => $request->email,
                'password' => $request->password,
                'scope' => '',
                         
            ],

        ]);

        return response(['data'=>json_decode((string)$response->getBody(),true)]);




       //  $http = new \GuzzleHttp\Client();
       // // dd($http);
       //  $request = $http->post(url('oauth/token'), [
       //      'form_params' => [
       //          'grant_type' => 'password',
       //          'client_id' => 2,
       //          'client_secret' => 'yetm6ZZ9g5aPeMC7VNqrxwVdP56MDG3mPuGY7Xgw',       
       //      ],
       //  ]);

       //  return $request->getStatusCode(); 

       //  // return $request->getBody();

       //  // return response(['data'=>json_decode((string) $response->getBody(), true)]);






//         $auth =  $response->getBody();
//         dd($auth);
// // return $response;
//         return response(['data'=>json_decode((string) $response->getBody(), true)]);






// return response(['data' => json_decode((string) $response->getBody(), true)]);
        // return json_decode((string) $response->getBody(), true);

//         $http = new Client;

// 	    $response = $http->post('http://127.0.0.1:8000/oauth/token', [
// 	        'form_params' => [
// 	            'grant_type' => 'password',
// 	            'client_id' => '2',
// 	            'client_secret' => 'TRsfBYRbuWdJAk4crUlPQYAP09aRKAt1701MwnR8',
// 	            'username' => $request->email,
// 	            'password' => $request->password,
// 	            'redirect_uri' => 'http://example.com/callback',
// 	            'code' => $request->code,
// 	        ],
// 	    ]);
// dd($response);
// 	    return response(['data' => json_decode((string) $response->getBody(), true)]);


    }

    public function login(Request $request){

    }
}
