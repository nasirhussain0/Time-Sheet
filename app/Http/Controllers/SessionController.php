<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Session;
use App\Job;
use App\Expense;
use Auth;
use DB;

class SessionController extends Controller
{
    public function newSession(){
    	$jobs = Job::orderBy('id', 'DESC')->get();
    	return view('session.newSessionForm', ['jobs' => $jobs]);
    }

      public function createNewSession(Request $request){
    	
    	 $this->validate($request, [
            'evidencePic'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


    	$userId = Auth::id();
    	
    	$jobId = $request->input('job');

    	$session = New Session();
		$session->startTime = $request->startTime;
        $session->endTime = $request->endTime;
        $session->date = $request->date;
        $session->status = $request->status;
        $session->notes = $request->notes;
        $session->userId = $userId;
        $session->jobId = $jobId;
        $session->save();

        $sessionId = DB::getPdo()->lastInsertId();

        $data = $request->input('evidencePic');
        $evidencePic = $request->file('evidencePic');
        $evidencePicName = $evidencePic->getClientOriginalName();
	    $fileName = $sessionId.$evidencePicName;
	    $uploadPicPath = 'evidencePics/';
	    $evidencePic->move($uploadPicPath,$fileName);
	    $evidencePicUrl = $fileName;

        $expense = New Expense();
        $expense->amount = $request->amount;
        $expense->evidencePic = $evidencePicUrl;
        $expense->paymentType = $request->paymentType;
        $expense->status = $request->expensesStatus;
        $expense->userId = $userId;
        $expense->sessionId = $sessionId;
        $expense->save();
        
        return redirect()->back()->with('updatedDatabase', 'Session has been created');
    }

}
