<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Expense;
use App\Session;
use App\Holiday;
use App\Job;
use DB;

class AdminController extends Controller
{
    public function index(){
    	$users = User::orderBy('fullname', 'ASC')->get();
    	return view('admin/allUsers', ['users' =>$users]);
    }

    public function getUser($id){
    	$user = User::find($id);
    	return view('admin/userUpdateForm', ['user' =>$user]);
    }

    public function updateUserProfile(Request $request, $id){
        $fullname = $request->input('fullname');
        $email = $request->input('email');
        $admin= $request->input('admin');
        $payRate= $request->input('payRate');
        $numOfHolidays= $request->input('numOfHolidays');

        $updateUserArray = array('fullname'=>$fullname,
        	'email'=>$email,
        	'admin'=>$admin,
        	'payRate'=>$payRate,
        	'numOfHolidays'=>$numOfHolidays);
        // dd($updateUserArray);
        
        DB::table('users')->where('id',$id)
        ->update($updateUserArray);
        
        return redirect()->back()->with('updatedDatabase', 'New details updated');
    }

    public function deleteUser($id){
    	// $user_id = $id;

    	$deleteUserFromExpense = Expense::where('userId', $id)->delete();

    	$deleteUserFromSession = Session::where('userId', $id)->delete();
   
    	$deleteUserFromHoliday = Holiday::where('userId', $id)->delete();
 
    	User::destroy($id);

    	return redirect()->back()->with('updatedDatabase', 'User account has been deleted');

    }

    public function accountFreeze(Request $request, $id){
    	User::where('id', $id)
            ->update(['active' => 0]);
            return redirect()->back()->with('updatedDatabase', 'User account has been blocked');
    }

	public function unfreeze(Request $request, $id){
		User::where('id', $id)
	        ->update(['active' => 1]);
	        return redirect()->back()->with('updatedDatabase', 'User account has been un blocked');
    }
}
