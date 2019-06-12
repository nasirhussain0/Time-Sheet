<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
    	// dd('test');
    	$id = Auth::id();
    	// dd($id);
    	$user = User::find($id);
    	// dd($user);

    	return view('user.updateUserForm', ['user' => $user]);


    }

    public function updateProfile(Request $request, $id){
    	$name = $request->fullname;
	 	$customerName = str_replace(' ', '',$request->fullname);
		// dd($customerName);
        $profilePic = $request->file('profilePicN');
        if($profilePic == null){
        	$updateArray = array('fullname'=>$name);
			DB::table('users')->where('id',$id)->update($updateArray);
        }else{        	
        	$profilePicname = $profilePic->getClientOriginalName();
	        $fileName = $customerName.$profilePicname;
	        $uploadPicPath = 'profilePics/';
	        $profilePic->move($uploadPicPath,$fileName);
	        $profilePicUrl = $fileName;

			$updateArray = array('fullname'=>$name,'profilePic'=>$profilePicUrl);
			DB::table('users')->where('id',$id)->update($updateArray);
        }
        return redirect()->back()->with('updatedDatabase', 'New details updated');       
    }

	public function updatePassword(Request $request, $id){
		$password = $request->password;
	 	$user = User::find($id);
	 	// dd($user);
        $user->password = Hash::make($password);
        $user->save();
	    return redirect()->back()->with('updatedDatabase', 'New details updated');
	}

	public function removeUser($id){
		User::destroy($id);
	    return view('home');
	}
}
