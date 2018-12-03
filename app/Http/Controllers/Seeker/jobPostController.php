<?php

namespace App\Http\Controllers\Seeker; 

use App\Http\Controllers\Controller;  
use Illuminate\Support\Facades\Auth; 
use Illuminate\Http\Request; 

use App\Model\jobPost; 
use App\Model\Job_Applicant;
use App\Model\JobPost_Save;

/**
where is treated as AND 
orWhere where you want OR

$enroll::where('user_id', '=', Auth::user()->id)
        ->where('course_id','=',$exists->id)->exists(); 
**/
class jobPostController extends Controller
{
  public function index(Request $request)
  {  
    //get session
    $request->session()->put('search', $request
            ->has('search') ? $request->get('search') : ($request->session()
            ->has('search') ? $request->session()->get('search') : ''));

    $request->session()->put('emptype', $request
            ->has('emptype') ? $request->get('emptype') : ($request->session()
            ->has('emptype') ? $request->session()->get('emptype') : ''));

    $request->session()->put('searchJobCat', $request
            ->has('searchJobCat') ? $request->get('searchJobCat') : ($request->session()
            ->has('searchJobCat') ? $request->session()->get('searchJobCat') : ''));

    $request->session()->put('searchState', $request
            ->has('searchState') ? $request->get('searchState') : ($request->session()
            ->has('searchState') ? $request->session()->get('searchState') : ''));
    
    $request->session()->put('srch_poslvl', $request
            ->has('srch_poslvl') ? $request->get('srch_poslvl') : ($request->session()
            ->has('srch_poslvl') ? $request->session()->get('srch_poslvl') : ''));


    $request->session()->put('srch_years', $request
            ->has('srch_years') ? $request->get('srch_years') : ($request->session()
            ->has('srch_years') ? $request->session()->get('srch_years') : ''));

    //query selection  
    $posts = jobPost::select('*', 'job_postings.id', 'savedjob_job_postings.id as saved_id', 
                    'job_applications.id as appl_id') 
                    ->orderBy('job_postings.jobpost_startDate', 'DESC')
                    ->whereRaw('jobpost_startDate <= "'.date('Y-m-d H:i:s').'"') 
                    ->whereRaw('jobpost_endDate >= "'.date('Y-m-d').'"')
                    ->whereRaw("jobpost_status = 'A'")  
                    ->whereRaw("jobpost_statusPosting = 'SHOW'")  
                    ->whereRaw("jobpost_position like '%".$request->session()->get('search')."%'")
                    ->whereRaw("jobpost_emp_type like '%".$request->session()->get('emptype')."%'")
                    ->whereRaw("jobpost_field_study like '%".$request->session()->get('searchJobCat')."%'")
                    ->whereRaw("jobpost_loc_state like '%".$request->session()->get('searchState')."%'")
                    ->whereRaw("jobpost_position_level like '%".$request->session()->get('srch_poslvl')."%'")
                    ->whereRaw("jobpost_years_exp like '%".$request->session()->get('srch_years')."%'")
                    ->leftjoin('employers', 'job_postings.jobpost_employer', '=', 'employers.id')     
                    ->leftjoin('savedjob_job_postings', 'job_postings.id', '=', 'savedjob_job_postings.job_id') 
                    ->leftjoin('job_applications', 'job_postings.id', '=', 'job_applications.appl_jobpostid')  
                    ->paginate(10); 

    //return value  
    if(Auth::guard('employer')->check()) return redirect()->intended(route('employer.dashboard'));
    elseif(Auth::guard('admin')->check()) return redirect()->intended(route('admin.dashboard'));
    else{                
      if($request->ajax()) return view('seeker.jposts.index', compact('posts'));
      else{ 
        if(Auth::guard('web')->check()){
          return !Auth::guard('web')->user()->complete ? redirect()->intended(route('seeker.account.complete')) : view('seeker.jposts.ajax', compact('posts')); 
        }else return view('seeker.jposts.ajax', compact('posts'));  
      }
    }
  }
 
  public function view($name, $id)
  {
   	$jobposts = jobPost::where('id', $id)->with('employerDetailBySeq')->first(); 
    $post =  jobPost::select('*', 'job_postings.id', 'job_applications.id as appl_id', 
                      'savedjob_job_postings.id as saved_id', 'employers.id as emp_id') 
                      ->leftjoin('employers', 'job_postings.jobpost_employer', '=', 'employers.id')     
                      ->leftjoin('savedjob_job_postings', 'job_postings.id', '=', 'savedjob_job_postings.job_id') 
                      ->leftjoin('job_applications', 'job_postings.id', '=', 'job_applications.appl_jobpostid')
                      ->find($id);
 

 	  return view('job.view_job', ['name' => $name], compact('post')); 
  }

  public function saveJOB(Request $request)
  {  
    $JobReq = $request->get('jobpost'); 
    $SeekerReq = $request->get('seeker'); 

    $jobSaved = new JobPost_Save();
    $jobSaved->job_id = $JobReq;
    $jobSaved->seeker_id = $SeekerReq;
    $jobSaved->created_at = date('Y-m-d H:i:s');
    $jobSaved->save();

    /*
    return response()->json([
      'fail' => false,
      'redirect_url' => url('jposts')
    ]);  
    */
    return back()->with('save', 'Job successfully saved.');
  }

  public function unsaveJOB(Request $request)
  {    
      JobPost_Save::destroy($request->get('id')); 
      /*
      return response()->json([
        'fail' => false,
        'redirect_url' => url('jposts')
      ]);
      */
      return back()->with('save', 'Job successfully unsaved.');
  } 

  public function show(Request $request, $id)
  {
    if($request->isMethod('get')) {
      return view('seeker.jposts.detail',['post' => jobPost::find($id)]);
    }
  }
}
