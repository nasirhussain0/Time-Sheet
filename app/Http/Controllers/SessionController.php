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
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function newSession(){
    	$jobs = Job::orderBy('id', 'DESC')->get();
    	return view('session.newSessionForm', ['jobs' => $jobs]);
    }

    public function createNewSession(Request $request){
    	$userId = Auth::id();
    	// dd($userId);
    	$jobId = $request->input('job');
        // dd($jobId);
    	$session = New Session();
		$session->startTime = $request->startTime;
        $session->endTime = $request->endTime;
        $session->date = $request->date;
        $session->approved = 'No';
        $session->notes = $request->notes;
        $session->userId = $userId;
        $session->jobId = $jobId;
        $session->save();

     //    $sessionId = DB::getPdo()->lastInsertId();

        return redirect()->back()->with('updatedDatabase', 'Session has been created');
    }

    public function getSessions(){
        $authUserId = Auth::id();
        $authUserSessions = DB::table('users')
            ->join('sessions', 'users.id', '=', 'sessions.userId')
            ->join('jobs', 'sessions.jobId', '=', 'jobs.id')
            ->join('expenses', 'expenses.userId', '=', 'users.id')
            ->select('users.*', 'sessions.*', 'jobs.*', 'expenses.*',  'users.id as user_id','sessions.id as session_id', 'jobs.id as job_id', 'sessions.approved as session_approved', 'expenses.id as expenses_id', 'expenses.approved as expenses_approved' )
            ->where('users.id' , $authUserId)
            ->get();
            // dd($authUserSessions);

            return view('session.getMySessions', ['authUserSessions' => $authUserSessions]);
    }

    public function getSession($session_id){
        $findSession = DB::table('sessions')
            ->join('jobs', 'sessions.jobId', '=', 'jobs.id')
            ->select('sessions.*', 'jobs.*', 'sessions.id as session_id', 'jobs.id as job_id', 'sessions.approved as session_approved')
            ->where('sessions.id' , $session_id)
            ->first();

            return view('session.selectedSession', ['findSession'=> $findSession]);

    }

    public function updateSession(Request $request, $session_id){
        $userId = Auth::id();
        $jobId = $request->input('job');
        $startTime = $request->input('startTime');
        $endTime = $request->input('endTime');
        $date = $request->input('date');
        $approved = $request->sessionStatus;
        $notes = $request->input('notes');
  
        $updateSessionsArray = array('startTime'=>$startTime,
            'endTime'=>$endTime,
            'date'=> $date,
            'approved'=> $approved,
            'notes'=> $notes,
            'userId'=> $userId,
            'jobId'=> $jobId,
        );

        // dd($updateSessionsArray);
        DB::table('sessions')->where('id',$session_id)
        ->update($updateSessionsArray);
        
        return redirect()->back()->with('updatedDatabase', 'New details updated');

    }

}
