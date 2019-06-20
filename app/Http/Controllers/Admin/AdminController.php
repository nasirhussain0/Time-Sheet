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
use PDF;
use Excel;
// use Maatwebsite\Excel\Facades\Excel;

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

    // public function deleteUser($id){
    // 	// $user_id = $id;

    // 	$deleteUserFromExpense = Expense::where('userId', $id)->delete();

    // 	$deleteUserFromSession = Session::where('userId', $id)->delete();
   
    // 	$deleteUserFromHoliday = Holiday::where('userId', $id)->delete();
 
    // 	User::destroy($id);

    // 	return redirect()->back()->with('updatedDatabase', 'User account has been deleted');

    // }

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


    public function getAllExpenses(){
    
        $allExpenses = DB::table('users')
            ->join('expenses', 'expenses.userId', '=', 'users.id')
            ->select('users.*', 'expenses.*', 'users.id as user_id', 'expenses.id as expenses_id', 'expenses.approved as expenses_approved' )
            ->get();
            // dd($allExpenses);

            return view('admin.expense.getAllExpenses', ['allExpenses' => $allExpenses]);
    }

    public function approveExpense($expenses_id){
        // dd($expenses_id);
        Expense::where('id', $expenses_id)
            ->update(['approved' => 'Yes']);
            return redirect()->back()->with('updatedDatabase', 'Details updated');

    }

    public function declineExpense($expenses_id){
        // dd($expenses_id);
        Expense::where('id', $expenses_id)
            ->update(['approved' => 'No']);
            return redirect()->back()->with('updatedDatabase', 'Details updated');

    }

    public function getAllSessions(){
    
        $allSessions = DB::table('users')
            ->join('sessions', 'sessions.userId', '=', 'users.id')
            ->join('jobs', 'sessions.jobId', '=', 'jobs.id')
            ->select('users.*', 'sessions.*', 'jobs.*', 'users.id as user_id', 'sessions.id as sessions_id', 'sessions.approved as session_approved' )
            ->get();
        

            return view('admin.session.getAllSessions', ['allSessions' => $allSessions]);
    }
    
    public function approveSession($session_id){
        Session::where('id', $session_id)
            ->update(['approved' => 'Yes']);

            return redirect()->back()->with('updatedDatabase', 'Details updated');
    }

    public function declineSession($session_id){
        Session::where('id', $session_id)
            ->update(['approved' => 'No']);

        return redirect()->back()->with('updatedDatabase', 'Details updated');
    }


    public function getUsersTimesheets(){
        $getTimeSheets = DB::table('users')
            ->join('sessions', 'sessions.userId', '=', 'users.id')
            ->select('users.*', 'sessions.*', 'users.id as user_id', 'sessions.id as sessions_id', 'sessions.approved as session_approved' )
            ->orderBy('users.id', 'desc')
            ->get();
            // dd($getTimeSheets);
            return view('admin.timesheet.timesheets', ['getTimeSheets' => $getTimeSheets]);
    } 

    public function generatePDF(){
        $getTimeSheets = DB::table('users')
            ->join('sessions', 'sessions.userId', '=', 'users.id')
            ->select('users.*', 'sessions.*', 'users.id as user_id', 'sessions.id as sessions_id', 'sessions.approved as session_approved' )
            ->orderBy('users.id', 'desc')
            ->get();

    

    $pdf = PDF::loadView('admin.timesheet.timesheetPDF', ['getTimeSheets'=>$getTimeSheets]);
      return $pdf->download('Users-Time-Sheet.pdf');

    }


   //  public function generatecsv(){
   //      $getTimeSheets = DB::table('users')
   //          ->join('sessions', 'sessions.userId', '=', 'users.id')
   //          ->select('users.*', 'sessions.*', 'users.id as user_id', 'sessions.id as sessions_id', 'sessions.approved as session_approved' )
   //          ->orderBy('users.id', 'desc')
   //          ->get();
   //  // dd($getTimeSheets);

   // return view('admin.timesheet.timesheetcsv',['getTimeSheets'=>$getTimeSheets]);

   //  }

    public function generatecsv(){
        $getTimeSheets = DB::table('users')
            ->join('sessions', 'sessions.userId', '=', 'users.id')
            ->select('users.*', 'sessions.*', 'users.id as user_id', 'sessions.id as sessions_id', 'sessions.approved as session_approved' )
            ->orderBy('users.id', 'desc')
            ->get()
            ->toArray();

            $getTimeSheetsArray[] = array('Fullname', 'Pay rate', 'Start time', 'End time', 'Date','Num of Holidays' );
            foreach($getTimeSheets as $timeSheets)
            {
                $getTimeSheetsArray[] = array(
                    'Fullname' => $timeSheets->fullname,
                    'Pay rate' => $timeSheets->payRate,
                    'Start time' => $timeSheets->startTime,
                    'End time' => $timeSheets->endTime,
                    'Date' => $timeSheets->date,
                    'Num of Holidays' => $timeSheets->numOfHolidays
                );
            }
            \Excel::create('Get Time Sheets', function($excel) use ($getTimeSheetsArray){
                $excel->setTitle('Get Time Sheets');
                $excel->sheet('Get Time Sheets', function($sheet) use($getTimeSheetsArray){
                    $sheet->fromArray($getTimeSheetsArray, null, 'A1', false, false);
                });
            })->download('xlsx');

            

    }
    
}
