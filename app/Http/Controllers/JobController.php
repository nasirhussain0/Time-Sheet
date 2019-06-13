<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Job;
use App\Session;
use DB;

class JobController extends Controller
{
	public function newJob(){
    	return view('admin.job.newJobForm');
    }

    public function createNewJob(Request $request){
    	// dd($request->all());

    	  $this->validate($request, [
            'name' => 'required|string|max:300',
            'location' => 'required|string|max:300', 
        ]);

    	$job = New Job();
		$job->name = $request->name;
        $job->location = $request->location;
        $job->save();
        
        return redirect()->back()->with('updatedDatabase', 'Job has been created');
    }
    
   	public function index(){
    	$jobs = Job::orderBy('id', 'DESC')->get();
    	return view('admin.job.alljobs', ['jobs' =>$jobs]);
    }
    public function getJob($id){
    	$job = Job::find($id);
    	return view('admin.job.jobUpdateForm', ['job' =>$job]);
    }
    
    public function updateJob(Request $request, $id){
        $name = $request->input('name');
        $location = $request->input('location');
    
        $updateJobArray = array('name'=>$name,
        	'location'=>$location);
        // dd($updateUserArray);
        
        DB::table('jobs')->where('id',$id)
        ->update($updateJobArray);
        
        return redirect()->back()->with('updatedDatabase', 'New details updated');
    }

    // public function deleteJob($id){
    // 	$deleteJobFromSession = Session::where('jobId', $id)->delete();
    // 	Job::destroy($id);

    // 	return redirect()->back()->with('updatedDatabase', 'Job has been deleted');
    // }
}
