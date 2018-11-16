<?php

namespace App\Http\Controllers\Employer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
 
use App\Model\jobPost;
use App\Model\Job_Applicant;
use App\Model\PostingDuration;
use App\Model\EmployerTokenPost;

class DashboardController extends Controller
{  
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('auth:employer'); // (auth:'guards')
  }
  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  { 
  	$user = Auth::user(); 
  	$jposts = new jobPost();
  	$jposts = $jposts->orderBy('created_at', 'desc')
  					 ->where('jobpost_employer', '=', $user->employer[0]->id)   
  					 ->paginate(5);

  	$appls = new Job_Applicant();
  	$appls = $appls->join('job_seekers', function ($join) use ($request)
                    {
                    $join->on('job_seekers.id', '=', 'job_applications.appl_seeker'); 
                    }) 
                   ->where('appl_emp_id', '=', $user->employer[0]->id)  
				           ->get();
	
	if($request->ajax())
    {
      return view('employer.jposts.index', compact('jposts','appls'));
    }
    else
    {
      return view('employer.jposts.ajax', compact('jposts','appls'));
    }
  }

  public function post_job()
  {  
    $EmpPosts = EmployerTokenPost::where('employer_id', '=', Auth::guard('employer')->user()->employer[0]->id)->first();
    $postDurs = PostingDuration::where('post_type', '=', $EmpPosts->package_plan)->first();   
    return view('employer.postjob', compact('EmpPosts', 'postDurs')); 
  }

  public function create_job(Request $request)
  {    
    $rules = [
      'jobpost_position' => 'required',
      'jobpost_position_level' => 'required',
      'jobpost_emp_type' => 'required',
      'job_noofvacancy' => 'required|integer|min:0',
      'jobpost_loc_city' => 'required',
      'jobpost_loc_state' => 'required', 
      'jobpost_minSalary' => 'required|numeric|min:0',
      'jobpost_maxSalary' => 'required|numeric|min:0|gte:jobpost_minSalary', 
      'jobpost_desc' => 'required', 
      'jobpost_education' => 'required',
      'jobpost_field_study' => 'required', 
      'jobpost_exp' => 'required', 
      'selectExp2' => 'required', 
      'jobpost_startDate' => 'required', 
      'jobpost_endDate' => 'required' 
    ];
    $message = [ 
        'jobpost_position.required'=>'The position title field is required.',
        'jobpost_position_level.required'=>'The position level field is required.',
        'jobpost_emp_type.required'=>'The employement type field is required.',

        'job_noofvacancy.required'=>'The vacancy field is required.',
        'job_noofvacancy.integer'=>'The vacancy field must be number.',
        'job_noofvacancy.min'=>'The vacancy field must be minimum with zero (0).',

        'jobpost_loc_city.required'=>'The location city field is required.',
        'jobpost_loc_state.required'=>'The location state field is required.', 

        'jobpost_minSalary.required'=>'The minimum salary field is required.',
        'jobpost_minSalary.numeric'=>'The minimum salary field must be number.',
        'jobpost_minSalary.min'=>'The minimum salary field must be minimum with zero (0).', 
        'jobpost_maxSalary.required'=>'The maximum salary field is required.',
        'jobpost_maxSalary.numeric'=>'The maximum salary field must be number.',
        'jobpost_maxSalary.min'=>'The maximum salary field must be minimum with zero (0).',
        'jobpost_maxSalary.gte'=>'The maximum salary must be highest than minimum salary.', 
 
        'jobpost_desc.required'=>'The overall scope field is required.',
        'jobpost_education.required'=>'The education level field is required.' ,
        'jobpost_field_study.required'=>'The job category field is required.',
        'jobpost_exp.required'=>'The experience description field is required.',
        'selectExp2.required'=>'The experience years field is required.',


        'jobpost_startDate.required'=>'The posting duration start date field is required.',
        'jobpost_endDate.required'=>'The posting duration end date field is required.'  
    ];

    $validator = Validator::make($request->all(), $rules, $message);
    if ($validator->fails())
    return response()->json([
      'fail' =>true, 
      'errors' => $validator->errors()
    ]); 
     

    $validity = explode('>', $request->token_value); //package code > token value > balance
    $package_code = explode('|', $validity[0]); //P|11 
    if($validity[0] != 'P|26'){
      $token_value = $validity[1]; //fixed value
      $balance_token = $validity[2];
    } 
    
    /* SUBMIT TO DB */ 
    $post = new jobPost();
    
    $post->jobpost_employer = Auth::guard('employer')->user()->employer[0]->id;
    $post->jobpost_date = date('Y-m-d H:i:s');

    // 05/06/2018 mm/dd/yyyy
    $raw_start_date = explode('/', $request->jobpost_startDate);
    $start_date = $raw_start_date[2].'-'.$raw_start_date[0].'-'.$raw_start_date[1].' '.date('H:i:s');
    $raw_end_date = explode('/', $request->jobpost_endDate);
    $end_date = $raw_end_date[2].'-'.$raw_end_date[0].'-'.$raw_end_date[1]; 
    $post->jobpost_startDate = $start_date;
    $post->jobpost_endDate = $end_date;

    $post->jobpost_loc_city = $request->jobpost_loc_city;
    $post->jobpost_loc_state = $request->jobpost_loc_state;
    $post->jobpost_position = $request->jobpost_position;
    $post->jobpost_position_level = $request->jobpost_position_level;
    $post->job_noofvacancy = $request->job_noofvacancy;

    $post->jobpost_education = $request->jobpost_education;
    if($request->jobpost_education == 'Others') $post->jobpost_edu_others = $request->postEduOthers;
    else $post->jobpost_edu_others = null;

    $post->jobpost_exp = $request->jobpost_exp;
    $post->jobpost_years_exp = $request->selectExp2;
    $post->jobpost_desc = $request->jobpost_desc;

    $post->jobpost_field_study = $request->jobpost_field_study;
    if($request->jobpost_field_study == 'Other') $post->jobpost_field_others = $request->postFieldOthers;
    else $post->jobpost_field_others = null;
     
    $post->jobpost_emp_type = $request->jobpost_emp_type;
    $post->jobpost_minSalary = $request->jobpost_minSalary;
    $post->jobpost_maxSalary = $request->jobpost_maxSalary;
    //optional 

    $allow = isset($request->allowance) ? implode(',', Input::get('allowance')) : '';
    $skill = isset($request->skill) ? implode(',', Input::get('skill')) : '';
    $post->jobpost_allowance = $allow;
    $post->jobpost_skill = $skill;

    $post->jobpost_postby = Auth::guard('employer')->user()->employer[0]->emp_ctc_person;
    $post->jobpost_company_name = Auth::guard('employer')->user()->employer[0]->emp_name;
    $post->jobpostCreditPlan = $validity[0];
    $post->jobpost_status = 'R';
    $post->jobpost_statusPosting = 'SHOW';
    $post->created_at = date('Y-m-d H:i:s');

    $post->save();
    
    return response()->json([
      'fail' => false,
      'redirect_url' => url('employer')
      //'redirect_url' => $allow
    ]);
  }

  public function update_job(Request $request, $id)
  {
    if ($request->isMethod('get')){
      $jposts = jobPost::find($id); 
      $EmpPosts = EmployerTokenPost::where('employer_id', '=', $jposts->jobpost_employer)->first();
      $postDurs = PostingDuration::where('post_type', '=', $EmpPosts->package_plan)->first();         
    	return view('employer.postjob', compact('jposts', 'EmpPosts', 'postDurs'));
    } 

    $rules = [
      'jobpost_position' => 'required',
      'jobpost_position_level' => 'required',
      'jobpost_emp_type' => 'required',
      'job_noofvacancy' => 'required|integer|min:0',
      'jobpost_loc_city' => 'required',
      'jobpost_loc_state' => 'required', 
      'jobpost_minSalary' => 'required|numeric|min:0',
      'jobpost_maxSalary' => 'required|numeric|min:0|gte:jobpost_minSalary', 
      'jobpost_desc' => 'required', 
      'jobpost_education' => 'required',
      'jobpost_field_study' => 'required', 
      'jobpost_exp' => 'required', 
      'selectExp2' => 'required'
    ];
    $message = [ 
        'jobpost_position.required'=>'The position title field is required.',
        'jobpost_position_level.required'=>'The position level field is required.',
        'jobpost_emp_type.required'=>'The employement type field is required.',

        'job_noofvacancy.required'=>'The vacancy field is required.',
        'job_noofvacancy.integer'=>'The vacancy field must be number.',
        'job_noofvacancy.min'=>'The vacancy field must be minimum with zero (0).',

        'jobpost_loc_city.required'=>'The location city field is required.',
        'jobpost_loc_state.required'=>'The location state field is required.', 

        'jobpost_minSalary.required'=>'The minimum salary field is required.',
        'jobpost_minSalary.numeric'=>'The minimum salary field must be number.',
        'jobpost_minSalary.min'=>'The minimum salary field must be minimum with zero (0).', 
        'jobpost_maxSalary.required'=>'The maximum salary field is required.',
        'jobpost_maxSalary.numeric'=>'The maximum salary field must be number.',
        'jobpost_maxSalary.min'=>'The maximum salary field must be minimum with zero (0).',
        'jobpost_maxSalary.gte'=>'The maximum salary must be highest than minimum salary.', 
 
        'jobpost_desc.required'=>'The overall scope field is required.',
        'jobpost_education.required'=>'The education level field is required.' ,
        'jobpost_field_study.required'=>'The job category field is required.',
        'jobpost_exp.required'=>'The experience description field is required.',
        'selectExp2.required'=>'The experience years field is required.'
    ];

    $validator = Validator::make($request->all(), $rules, $message);
    if ($validator->fails())
    return response()->json([
      'fail' =>true,
      'errors' => $validator->errors()
    ]); 

    /* Save Job */
    $post = jobPost::find($id);  

    $post->jobpost_loc_city = $request->jobpost_loc_city;
    $post->jobpost_loc_state = $request->jobpost_loc_state;
    $post->jobpost_position = $request->jobpost_position;
    $post->jobpost_position_level = $request->jobpost_position_level;
    $post->job_noofvacancy = $request->job_noofvacancy;

    $post->jobpost_education = $request->jobpost_education;
    if($request->jobpost_education == 'Others') $post->jobpost_edu_others = $request->postEduOthers;
    else $post->jobpost_edu_others = null;

    $post->jobpost_exp = $request->jobpost_exp;
    $post->jobpost_years_exp = $request->selectExp2;
    $post->jobpost_desc = $request->jobpost_desc;

    $post->jobpost_field_study = $request->jobpost_field_study;
    if($request->jobpost_field_study == 'Other') $post->jobpost_field_others = $request->postFieldOthers;
    else $post->jobpost_field_others = null;
     
    $post->jobpost_emp_type = $request->jobpost_emp_type;
    $post->jobpost_minSalary = $request->jobpost_minSalary;
    $post->jobpost_maxSalary = $request->jobpost_maxSalary;
    //optional 

    $allow = isset($request->allowance) ? implode(',', Input::get('allowance')) : '';
    $skill = isset($request->skill) ? implode(',', Input::get('skill')) : '';
    $post->jobpost_allowance = $allow;
    $post->jobpost_skill = $skill;
 
    $post->save();

    //return $end_date; 
    return response()->json([
      'fail' => false,
      'redirect_url' => url('employer')
    ]);
  } 

  public function destroy($id)
  {
      jobPost::destroy($id);
      return redirect('employer'); 
  }

  public function show_post(Request $request, $id)
  {
    $post = jobPost::find($id); 
    $post->jobpost_statusPosting = $request->status;
    $post->save();
    return response()->json([ 
      'redirect_url' => url('employer')
    ]); 
  }

}
