<?php

namespace App\Http\Controllers\Employer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Model\job_seeker; 
use App\Model\Job_Applicant; 
use App\Model\JobSeeker_Experience;
use App\Model\JobSeeker_Education;

class ApplicantController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:employer'); // (auth:'guards')
    }

    public function applicant(Request $request, $jobName, $id)
    {   
    	$jobAppls = new Job_Applicant(); 

        $jobAppls = $jobAppls->join('job_seekers', 'job_applications.appl_seeker', '=', 'job_seekers.id')
                             ->join('job_postings', 'job_applications.appl_jobpostid', '=', 'job_postings.id')
                             ->join('job_seeker_education', 'job_applications.appl_seeker', '=', 'job_seeker_education.seeker_id')
                             ->where('job_applications.appl_jobpostid' , '=', decrypt($id))
    						 ->orderby('job_applications.appl_date', 'desc') 
    						 ->paginate(10);
 

		return view('employer.applicant.ajax', compact('jobName', 'id', 'jobAppls', 'seekers', 'job_applications.id'));
    }

    public function seeker_profile(Request $request, $id)
    {   
        if($request->isMethod('get')){
            $seeker = job_seeker::find(decrypt($id));
            $experience = JobSeeker_Experience::where('seeker_id', '=', decrypt($id))
                                                ->orderby('exp_toDt', 'DESC')
                                                ->get();
            $education = JobSeeker_Education::where('seeker_id', '=', decrypt($id))->get();

            return view('employer.applicant.profile', compact('seeker', 'education', 'experience'));  
        }
    }

    public function applicant_status(Request $request, $code2)
    {   
        $code = explode('|', $code2);
        $status = $code[0];
        $seeker_id = $code[1];
        $job_id = $code[2];
        $job_name = $code[3];
        $id = $code[4];

        $appl = Job_Applicant::where('appl_seeker', '=', $seeker_id)
                             ->where('appl_jobpostid', '=', $job_id)
                             ->first(); 

        $appl->appl_process_status = $status;
        $appl->created_at = date('Y-m-d H:i:s');
        $appl->save(); 

        if($status == 'KIV') return 'viewed';
        elseif($status == 'Accept') return 'accepted';
        elseif($status == 'Reject') return 'rejected';
        //return url('employer/applicant/'.$job_name.'/'.$id);


    }
}
