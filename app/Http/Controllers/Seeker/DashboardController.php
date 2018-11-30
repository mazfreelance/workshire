<?php

namespace App\Http\Controllers\Seeker;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;  

use App\Model\Job_Applicant;
use App\Model\job_seeker;
use App\User;
use App\Model\Message;
use App\Model\JobPost_Save;

use Illuminate\Support\Facades\Mail;
use App\Mail\JobAppliedNoti;
use App\User_Employer;
use App\Model\employer; 

class DashboardController extends Controller
{   
  public function __construct()
  {
    //$this->middleware('auth'); // (auth:'guards')
  }

 	public function index()
 	{  
    $user = Auth::user();  
    $appls = Job_Applicant::select('*', 'job_applications.id', 'employers.id as emp_id', 'job_postings.id as job_id', 
                          'job_applications.id as appl_id')
                          ->orderBy('job_applications.created_at', 'desc')
                          ->whereRaw("job_applications.appl_seeker = '".$user->seeker->id."'") 
                          ->leftJoin('job_postings', 'job_applications.appl_jobpostid', '=', 'job_postings.id')
                          ->leftJoin('employers', 'job_applications.appl_emp_id', '=', 'employers.id') 
                          ->paginate(10);

    return view('seeker.job', compact('appls'));  
 	} 

  public function save_job(){ 
    $user = Auth::user();  
    $save = JobPost_Save::select('*', 'savedjob_job_postings.id', 'job_postings.id as job_id',
                          'job_applications.id as appl_id', 'employers.id as emp_id')
                        ->leftJoin('job_postings', 'savedjob_job_postings.job_id', '=', 'job_postings.id')
                        ->leftJoin('job_applications', 'savedjob_job_postings.job_id', '=', 'job_applications.appl_jobpostid')
                        ->leftJoin('employers', 'job_postings.jobpost_employer', '=', 'employers.id') 
                        ->where('savedjob_job_postings.seeker_id', '=', $user->seeker->id)
                        ->orderBy('savedjob_job_postings.created_at', 'desc')
                        ->paginate(9);
    return view('seeker.save_job', compact('save'));
  }

 	public function apply(Request $request)
 	{  	  
 		$seeker = $request->seeker_id; 
 		$jobpost = $request->job_id; 
 		$employer = $request->employer_id; 
		$status = 'new';
		$apply_date = date('Y-m-d'); 
 		 
		if($request->available == 'a_now') $status_available = 'Now';
		elseif($request->available == 'a_after'){
			$status_available_raw = explode('/', $request->datepicker);
			$status_available = $status_available_raw[2].'-'.$status_available_raw[1].'-'.$status_available_raw[0]; 
		}

 		$coverLetter = $request->editorCoverLetter;

		$job_appl = new Job_Applicant();
		$job_appl->appl_seeker = $seeker;
		$job_appl->appl_emp_id = $employer;
		$job_appl->appl_jobpostid = $jobpost;
		$job_appl->appl_status = $status;
		$job_appl->appl_date = $apply_date;
		$job_appl->appl_available = $status_available;
		$job_appl->appl_process_status = 'Processing';
		
    $job_applicant->save();
 
    $emp = employer::find($employer);
    $userEmp = User_Employer::find($emp->users_id);
    $email = $userEmp->email;

    //SEND TO SEEKER
    //$noti = Notification_Seeker::find($seeker);
    //if($noti->job_alert == 'Y') Mail::to($mail)->send(new ApplyJob); 

    //SEND TO EMPLOYER  
    Mail::to($email)->send(new JobAppliedNoti($request->input('job_name'))); 


		$msg['msg'] = 'You are successfully applied a job on '.date('d F Y');
		$msg['url'] = 'seeker/dashboard'; 

		return $msg;
  }   
  
}
