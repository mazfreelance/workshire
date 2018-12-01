<?php

namespace App\Http\Controllers\Seeker;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use App\Model\job_seeker;
use App\Model\JobSeeker_Education;
use App\Model\JobSeeker_Experience;  
use App\Model\Resume;  

class ProfileController extends Controller
{
  public function index()
 	{
 		$seek = Auth::guard('web')->user()->seeker;   
    //return Auth::guard('web')->user()->seeker;
    return view('seeker.profile.index', compact('seek')); 
 	}  
 	public function showEditForm()
 	{
 		$seek = Auth::guard('web')->user()->seeker;  
 		$edu_detail = $seek->education;
 		$exp_detail = $seek->experience;
      return view('seeker.profile.edit', compact('seek', 'edu_detail', 'exp_detail')); 
 	}  
 	public function showEduExp()
 	{
 		$seek = Auth::guard('web')->user()->seeker;   
    $edu_detail = JobSeeker_Education::where('seeker_id', '=', $seek->id)->orderby('level', 'ASC')->get();
    $exp_detail = JobSeeker_Experience::where('seeker_id', '=', $seek->id)->orderby('level', 'ASC')->get();

    return view('seeker.profile.eduexp', compact('seek', 'edu_detail', 'exp_detail')); 
 	}  
 	public function update(Request $request){

 		$rules = [ 
  		'seektype' => 'required',
  		'name' => 'required',
  		'gender' => 'required',

  		'nric_date' => 'required_if:ic_type,==,malay|numeric|digits:6',
  		'nric_state' => 'required_if:ic_type,==,malay|numeric|digits:2',
  		'nric_ic' => 'required_if:ic_type,==,malay|numeric|digits:4',
  		//'nric_full' => 'unique:job_seekers,seeker_nric',

			'nric' => 'required_if:ic_type,==,non malay',
 
  		'day' => 'required|integer|date_format:d',
  		'month' => 'required|integer|date_format:m',
			'year' => 'required|integer|date_format:Y',

  		'seeker_address' => 'required',
  		'seeker_zip' => 'required|numeric',
			'seeker_city' => 'required',
			'seeker_state' => 'required',

			'seeker_ctc_tel1' => 'required|numeric',
			'seeker_expect_salary' => 'required',

			'travel' => 'required',

			'lang.*' => 'required',
			'skill.*' => 'required', 
    ];
    $message = [  
  		'seektype.required' => 'The type field is required',
  		'name.required' => 'The full name field is required', 

  		'nric_date.required_if' => 'The National Registration Identity Card first field is required',
  		'nric_state.required_if' => 'The National Registration Identity Card second field is required',
  		'nric_ic.required_if' => 'The National Registration Identity Card third field is required',
  		'nric_date.numeric' => 'The National Registration Identity Card first field must be number.',
  		'nric_state.numeric' => 'The National Registration Identity Card second field must be number.',
  		'nric_ic.numeric' => 'The National Registration Identity Card third field must be number.',
  		'nric_date.digits' => 'The National Registration Identity Card first field must be :digits digits.',
  		'nric_state.digits' => 'The National Registration Identity Card second field must be :digits digits.',
  		'nric_ic.digits' => 'The National Registration Identity Card third field must be :digits digits.',
	
  		'nric.required_if' => 'The Passport Number field is required', 

  		'seeker_address.required' => 'The address field is required.',
  		'seeker_zip.required' => 'The poscode field is required.',
  		'seeker_zip.numeric' => 'The poscode field must be an number..',
			'seeker_city.required' => 'The city field is required.',
			'seeker_state.required' => 'The state field is required.',

  		'seeker_ctc_tel1.required' => 'The telephone number field is required.',
  		'seeker_ctc_tel1.numeric' => 'The telephone number must be number.',
  		'seeker_expect_salary.required' => 'The expected salary field is required.',

			'lang.*.required' => 'The language field is required',
			'skill.*.required' => 'The skill field is required', 
    ]; 

    $validator = Validator::make($request->all(), $rules, $message);
    if ($validator->fails()) //return back()->withInput()->withErrors($validator); 
  	return response()->json([
      'fail' =>true, 
      'errors' => $validator->errors()
    ]);



    //request == save()
    $seeker = job_seeker::find($request->input('id'));

    $seeker->seeker_type = $request->input('seektype');
    $seeker->seeker_name = $request->input('name');
    $seeker->seeker_gender = $request->input('gender'); 

 		$ic_type = $request->input('ic_type');
 		if($ic_type == 'malay') $nric = $request->input('nric_date').''.$request->input('nric_state').''.$request->input('nric_ic');
 		else $nric = $request->input('nric');

    $seeker->seeker_DOB = $nric; 


    $day = $request->input('day');
    $month = $request->input('month');
    $year = $request->input('year'); 
    $dob = date('Y-m-d', strtotime($year.'-'.$month.'-'.$day));

    $seeker->seeker_DOB = $dob; 
    $seeker->seeker_address = $request->input('seeker_address');
    $seeker->seeker_zip = $request->input('seeker_zip');
    $seeker->seeker_city = $request->input('seeker_city');
    $seeker->seeker_state = $request->input('seeker_state'); 
    $seeker->seeker_ctc_tel1 = $request->input('seeker_ctc_tel1');
    $seeker->seeker_expect_salary = $request->input('seeker_expect_salary');
    $seeker->seeker_language = implode(',', $request->input('lang'));
    $seeker->seeker_skillSets = implode(',', $request->input('skill'));

    $seeker->save();

 		return response()->json([
      'fail' => false,
      'redirect_url' => url('seeker/profile/edit')
      //'redirect_url' => $dob
    ]);
 	} 

 	public function showMessage()
 	{ 
 		$seek = Auth::guard('web')->user()->seeker;  
    return view('seeker.profile.message', compact('seek')); 
 	}  

  public function resume($id){
    $seek = Auth::guard('web')->user()->seeker;  
    return view('seeker.profile.resume', compact('seek'));
  }

  /**
    COMPLETE PROFILE
  **/
  public function complete(){

    $id = Auth::guard('web')->user()->id; 
    $seek = job_seeker::selectraw("id, ISNULL(NULLIF(seeker_address,'')) + ISNULL(NULLIF(seeker_city,'')) +
                                   ISNULL(NULLIF(seeker_state,'')) + ISNULL(NULLIF(seeker_zip,'')) +
                                   ISNULL(NULLIF(seeker_ctc_tel1,'')) + ISNULL(NULLIF(seeker_DOB,'')) + 
                                   ISNULL(NULLIF(seeker_nric,'')) + ISNULL(NULLIF(seeker_gender,'')) +
                                   ISNULL(NULLIF(seeker_skillSets,'')) + ISNULL(NULLIF(seeker_will_travel,'')) + 
                                   ISNULL(NULLIF(seeker_expect_salary,'')) + ISNULL(NULLIF(seeker_language,'')) + 
                                   ISNULL(NULLIF(seeker_type,''))
                                   AS incomplete")
                       ->where('user_id', '=', $id)
                       ->first(); 

    $photo = job_seeker::selectraw("ISNULL(NULLIF(seeker_profile_photo_loc,'')) AS incomplete")
                       ->where('user_id', '=', $id)
                       ->first(); 

    $resume = Resume::selectraw("*, ISNULL(NULLIF(resume_loc,'')) AS incomplete")
                    ->where('seeker_id', '=', $seek->id)
                    ->first(); 

    $edu = JobSeeker_Education::selectraw("*, ISNULL(NULLIF(highest_education,'')) +
                                ISNULL(NULLIF(qualification,'')) + ISNULL(NULLIF(grade_achievement,'')) + ISNULL(NULLIF(field_of_study,'')) +
                                ISNULL(NULLIF(major_study,'')) + ISNULL(NULLIF(institute,''))
                                AS incomplete ")
                              ->where('seeker_id', '=', $seek->id)
                              ->where('level', '=', 1)
                              ->first(); 
    $exp = JobSeeker_Experience::selectraw("*, ISNULL(NULLIF(exp_fromDt,'')) +
                                ISNULL(NULLIF(exp_toDt,'')) + ISNULL(NULLIF(exp_position,'')) + ISNULL(NULLIF(exp_jobd,'')) +
                                ISNULL(NULLIF(exp_company,'')) + ISNULL(NULLIF(exp_salary,''))
                                AS incomplete ")
                               ->where('seeker_id', '=', $seek->id)
                               ->where('level', '=', 1)
                               ->first();

    return Auth::guard('web')->user()->complete ? redirect()->intended(route('main'))  : view('seeker.profile.complete', compact('seek', 'photo', 'resume', 'edu', 'exp')); 
  }

  public function complete_post(Request $request){
    $rules = [ 
      'seektype' => 'required',
      'name' => 'required',
      'gender' => 'required',

      'nric_full' => 'required_if:ic_type,==,malay',
      //'nric_date' => 'required_with:nric_full|numeric|digits:6',
      //'nric_state' => 'required_with:nric_full|numeric|digits:2',
      //'nric_ic' => 'required_with:nric_full|numeric|digits:4',

      'nric' => 'required_if:ic_type,==,non malay',
 
      'day' => 'required|integer|date_format:d',
      'month' => 'required|integer|date_format:m',
      'year' => 'required|integer|date_format:Y',

      'seeker_address' => 'required',
      'seeker_zip' => 'required|numeric',
      'seeker_city' => 'required',
      'seeker_state' => 'required',

      'seeker_ctc_tel1' => 'required|numeric',
      'seeker_expect_salary' => 'required',

      'travel' => 'required',

      'lang.*' => 'required',
      'skill.*' => 'required', 
    ];
    $message = [  
      'seektype.required' => 'The type field is required',
      'name.required' => 'The full name field is required', 

      //'nric_date.required_if' => 'The National Registration Identity Card first field is required',
      //'nric_state.required_if' => 'The National Registration Identity Card second field is required',
      //'nric_ic.required_if' => 'The National Registration Identity Card third field is required',
      //'nric_date.numeric' => 'The National Registration Identity Card first field must be number.',
      //'nric_state.numeric' => 'The National Registration Identity Card second field must be number.',
      //'nric_ic.numeric' => 'The National Registration Identity Card third field must be number.',
      //'nric_date.digits' => 'The National Registration Identity Card first field must be :digits digits.',
      //'nric_state.digits' => 'The National Registration Identity Card second field must be :digits digits.',
      //'nric_ic.digits' => 'The National Registration Identity Card third field must be :digits digits.',
  
      'nric.required_if' => 'The Passport Number field is required', 

      'seeker_address.required' => 'The address field is required.',
      'seeker_zip.required' => 'The poscode field is required.',
      'seeker_zip.numeric' => 'The poscode field must be an number..',
      'seeker_city.required' => 'The city field is required.',
      'seeker_state.required' => 'The state field is required.',

      'seeker_ctc_tel1.required' => 'The telephone number field is required.',
      'seeker_ctc_tel1.numeric' => 'The telephone number must be number.',
      'seeker_expect_salary.required' => 'The expected salary field is required.',

      'lang.*.required' => 'The language field is required',
      'skill.*.required' => 'The skill field is required', 
    ]; 

    $validator = Validator::make($request->all(), $rules, $message);
    if ($validator->fails()) //return back()->withInput()->withErrors($validator); 
    return response()->json([
      'fail' =>true, 
      'errors' => $validator->errors()
    ]);


    /*
    //request == save()
    $seeker = job_seeker::find($request->input('id'));

    $seeker->seeker_type = $request->input('seektype');
    $seeker->seeker_name = $request->input('name');
    $seeker->seeker_gender = $request->input('gender'); 

    $ic_type = $request->input('ic_type');
    if($ic_type == 'malay') $nric = $request->input('nric_date').''.$request->input('nric_state').''.$request->input('nric_ic');
    else $nric = $request->input('nric');

    $seeker->seeker_DOB = $nric; 


    $day = $request->input('day');
    $month = $request->input('month');
    $year = $request->input('year'); 
    $dob = date('Y-m-d', strtotime($year.'-'.$month.'-'.$day));

    $seeker->seeker_DOB = $dob; 
    $seeker->seeker_address = $request->input('seeker_address');
    $seeker->seeker_zip = $request->input('seeker_zip');
    $seeker->seeker_city = $request->input('seeker_city');
    $seeker->seeker_state = $request->input('seeker_state'); 
    $seeker->seeker_ctc_tel1 = $request->input('seeker_ctc_tel1');
    $seeker->seeker_expect_salary = $request->input('seeker_expect_salary');
    $seeker->seeker_language = implode(',', $request->input('lang'));
    $seeker->seeker_skillSets = implode(',', $request->input('skill')); 
    $seeker->save();
    */
    return response()->json([
      'fail' => false,
      'redirect_url' => route('seeker.account.complete')
      //'redirect_url' => $dob
    ]);
  }
}
