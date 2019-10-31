<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Expense;
use Auth;
use DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class ExpenseController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function newExpense(){
    	// $jobs = Job::orderBy('id', 'DESC')->get();
    	// return view('session.newSessionForm', ['jobs' => $jobs]);
    	return view('expense.newExpenseForm');
    }
    public function createNewExpense(Request $request){
    	
    	 $this->validate($request, [
            'evidencePic'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


    	$userId = Auth::id();

        $data = $request->input('evidencePic');
        $evidencePic = $request->file('evidencePic');
        $evidencePicName = $evidencePic->getClientOriginalName();
	    $fileName = $userId.$evidencePicName;
	    $uploadPicPath = 'evidencePics/';
	    $evidencePic->move($uploadPicPath,$fileName);
	    $evidencePicUrl = $fileName;

        $expense = New Expense();
        $expense->amount = $request->amount;
        $expense->evidencePic = $evidencePicUrl;
        $expense->paymentType = $request->paymentType;
        $expense->approved = 'No';
        $expense->userId = $userId;
        $expense->save();
        
        return redirect()->back()->with('updatedDatabase', 'Session has been created');
    }

    public function getExpenses(){

    	$authUserId = Auth::id();
    	$authUserExpenses = DB::table('users')
            ->join('expenses', 'expenses.userId', '=', 'users.id')
            ->select('users.*', 'expenses.*', 'users.id as user_id', 'expenses.id as expenses_id', 'expenses.approved as expenses_approved' )
            ->where('users.id' , $authUserId)
            ->get();
            // dd($authUserExpenses);

            return view('expense.getMyExpenses', ['authUserExpenses' => $authUserExpenses]);
    }

    public function getExpense($expenses_id){
    	// dd($session_id);
    	$findExpense = DB::table('expenses')
            ->join('users', 'expenses.userId', '=', 'users.id')
            ->select('expenses.*', 'expenses.id as expenses_id','expenses.approved as expenses_approved' )
            ->where('expenses.id' , $expenses_id)
            ->where('expenses.approved' , 'No')
            ->first();
            // dd($findExpense);
            return view('expense.selectedExpense', ['findExpense'=> $findExpense]);

    }

    public function getExpensePicture($expenses_id){
    	// dd($session_id);
    	$findExpense = DB::table('expenses')
            ->join('users', 'expenses.userId', '=', 'users.id')
            ->select('expenses.*', 'expenses.id as expenses_id','expenses.approved as expenses_approved' )
            ->where('expenses.id' , $expenses_id)
            ->where('expenses.approved' , 'No')
            ->first();
            // dd($findExpense);
            return view('expense.selectedExpensePicture', ['findExpense'=> $findExpense]);

    }

    public function updateExpensePicture(Request $request, $session_id){
    	// dd($session_id);

    	if($request->hasFile("evidencePicN")){
    		$ExpenseImage = Expense::find($session_id);

    		$exists = Storage::disk('local')->exists("public/evidencePics/".$ExpenseImage->evidencePic);

    		if($exists)
    		{
    			Storage::delete("public/evidencePics/".$ExpenseImage->evidencePic);
    		}

    		$userId = Auth::id();
	    	$data = $request->input('evidencePicN');
	        $evidencePic = $request->file('evidencePicN');
	        $evidencePicName = $evidencePic->getClientOriginalName();
		    $fileName = $userId.$evidencePicName;
		    $uploadPicPath = 'evidencePics/';
		    $evidencePic->move($uploadPicPath,$fileName);
		    $evidencePicUrl = $fileName;
		    // dd($evidencePicUrl);

    		$updateExpenseArray = array('evidencePic'=>$evidencePicUrl);

    		DB::table('expenses')->where('id',$session_id)->update($updateExpenseArray);
    		
    		return redirect()->back()->with('updatedDatabase', 'Evidence has been updated');
    	}else
    	{
    		$error = "Please upload Evidence";
           	return $error;

    	}
    }

    public function updateExpense(Request $request, $expenses_id){
   
    	$amount = $request->input('amount');
        $paymentType = $request->input('paymentType');
  
        $updateExpensesArray = array('amount'=>$amount,
        	'paymentType'=>$paymentType);
        
        DB::table('expenses')->where('id',$expenses_id)
        ->update($updateExpensesArray);
        
        return redirect()->back()->with('updatedDatabase', 'New details updated');
    }

    public function deleteExpense($expenses_id){
    	$ExpenseImage = Expense::find($expenses_id);

    	$ExpenseImage = $ExpenseImage->evidencePic;
    
		File::delete(public_path('evidencePics/'. $ExpenseImage));
		
		Expense::destroy($expenses_id);

		return redirect()->back()->with('updatedDatabase', 'Job has been deleted');    	
    }

}
