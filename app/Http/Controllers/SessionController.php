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
    	$userId = Auth::id();
    	
    	$jobId = $request->input('job');

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
            ->join('expenses', 'expenses.sessionId', '=', 'sessions.id')

            ->select('users.*', 'sessions.*', 'jobs.*', 'expenses.*', 'users.id as user_id','sessions.id as session_id', 'jobs.id as job_id', 'expenses.id as expenses_id', 'sessions.approved as session_approved', 'expenses.approved as expenses_approved' )
            ->where('users.id' , $authUserId)
            ->where('sessions.approved' , 'Yes')
            ->where('expenses.approved' , 'Yes')
            ->get();
            // dd($users);
            return view('session.getMySessions', ['authUserSessions' => $authUserSessions]);
    }

    public function getSession($session_id){
    	// dd($session_id);
    	$findSession = DB::table('sessions')
            ->join('jobs', 'sessions.jobId', '=', 'jobs.id')
            ->join('expenses', 'expenses.sessionId', '=', 'sessions.id')
            ->select('sessions.*', 'jobs.*', 'expenses.*', 'sessions.id as session_id', 'jobs.id as job_id', 'expenses.id as expenses_id', 'sessions.approved as session_approved', 'expenses.approved as expenses_approved' )
            ->where('sessions.id' , $session_id)
             ->where('sessions.approved' , 'Yes')
            ->where('expenses.approved' , 'Yes')
            ->first();
            // dd($findSession);
            return view('session.selectedSession', ['findSession'=> $findSession]);

    }

    public function updateSession(Request $request, $session_id){
    	dd($session_id);

    }

}
