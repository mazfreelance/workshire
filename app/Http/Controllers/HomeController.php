<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input; 
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

use App\User;
use App\Model\job_seeker_JOBFAIR; 
use App\Model\VerifyUser;
use App\Model\JobSeeker_Education_JOBFAIR;
use App\Mail\VerifyMailSeeker;

use App\Model\Cart_Product;
use App\Model\Poskod;  

class HomeController extends Controller
{ 
    public function pricePLAN(Request $request)
    {   
        $Products = Cart_Product::all(); 
        return view('employer.price', compact('Products'));
    } 

    public function poskod(Request $request)
    {   
    	$zip = $request->input('zip');
    	$token = $request->input('_token');
    	return Poskod::whereRaw('posod LIKE "%'.$zip.'%"')->first(); 
    } 

    public function jobfairForm(Request $request){
        return view('jobfair.index');
    }

    public function jobfair(Request $request){
        Validator::extend('valid_username', function($attr, $value){ 
            return preg_match('/^(?=.*[a-z])(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])/', $value); 
        }); 
        $rules = [
            'username' => 'required|valid_username|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'confirm_password' => 'same:password', 
            'name' => 'required',
            'nric_full' => 'required_if:ic_type,malay',
            'passport' => 'required_if:ic_type,non malay',
            'contact_num' => 'required|numeric',
            'highEdu' => 'required',
            'fos' => 'required',
            'major' => 'required_if:highEdu,STPM|required_if:highEdu,Certificate|required_if:highEdu,Diploma|required_if:highEdu,Degree|required_if:highEdu,Master|required_if:highEdu,PHD',
            'institute' => 'required',
            'achieve' => 'required',
            'achievement_grade' => 'required_if:achieve,Grade',
            'achievement_cgpa' => 'required_if:achieve,CGPA|numeric',
            'achievement_class' => 'required_if:achieve,Class',
            'working' => 'required|alpha_num',
            'survey' => 'required',
            'other_survey' => 'required_if:survey,Other', 
        ];
        $message = [  
            'username.valid_username'=>'<ul style="list-style:none" class="ml-0">
                                        <li>Username field must contain: <ol><li>at least one(1) lowercase alphabetical character</li><li>at least one(1) uppercase alphabetical character</li><li>at least one(1) numeric character</li><li>example: User123</li></ol></li>
                                        </ul>',

            'highEdu.required' => 'The highest education field is required.',                              
            'fos.required' => 'The field of study field is required.',                            
            'major.required_if' => 'The major field is required.',                        
            'achievement_grade.required_if' => 'The achievement field is required.',     
            'achievement_cgpa.required_if' => 'The achievement field is required.',     
            'achievement_class.required_if' => 'The achievement field is required.',                      
            'working.required' => 'The working experience year(s) field is required.',                    
            'working.numeric' => 'The working experience year(s) must be a number.',                
        ]; 

        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()){
            return response()->json([
              'fail' =>true, 
              'errors' => $validator->errors()
            ]); 
        }else{  
            $nric = $request->input('ic_type') == 'malay' ? $request->input('nric_full') : $request->input('passport');
            $other_survey = $request->input('survey') == 'Other' ? $request->input('other_survey') : '';
            $grade = '';
            if($request->input('achieve') == 'Grade') $grade = $request->input('achievement_grade');
            elseif($request->input('achieve') == 'CGPA') $grade = $request->input('achievement_cgpa');
            elseif($request->input('achieve') == 'Class') $grade = $request->input('achievement_class');

            //send to dB 
            $user = User::create([
                'username' => $request->input('username'),
                'email' => $request->input('email'), 
                'password' => Hash::make($request->input('password')),
            ]);  
            $seeker = job_seeker_JOBFAIR::create([
                'user_id' => $user->id,
                'seeker_name' => $request->input('name'), 
                'seeker_nric' => $nric, 
                'seeker_ctc_tel1' => $request->input('contact_num'), 
                'seeker_noYrsExp' => $request->input('working'), 
                'seeker_survey_list' => $request->input('survey'), 
                'seeker_survey_others' => $request->input('other_survey')
            ]); 
            VerifyUser::create([
                'user_id' => $user->id,
                'token' => str_random(40)
            ]);
            JobSeeker_Education_JOBFAIR::create([
                'seeker_id' => $seeker->id,
                'highest_education' => $request->input('highEdu'), 
                'qualification' => $request->input('achieve'), 
                'grade_achievement' => $grade, 
                'field_of_study' => $request->input('fos'), 
                'major_study' => $request->input('major'), 
                'institute' => $request->input('institute'), 
                'level' => 1, 
                'status_study' => $request->input('contact_num'),  
            ]);
             
            Mail::to($user->email)->send(new VerifyMailSeeker($user));
         
            return response()->json([
              'fail' =>false, 
              'redirect_url' => route('jobfairForm')
            ]);
        }
    }


    public function operatorForm(){
        return view('operator.index');
    }

    public function operator(Request $request){
        $rules = [
            'name' => 'required',
            'nric_full' => 'required_if:ic_type,malay',
            'passport' => 'required_if:ic_type,non malay',
            'gender' => 'required',
            'contact_num' => 'required|numeric',
            'email' => 'nullable|email|unique:users',
            'highEdu' => 'required',
            'seeker_zip' => 'required|numeric|digits:5',
            'seeker_state' => 'required',
            'workSTAT' => 'required',
            'workPOS' => 'required_if:workSTAT,Yes',
            'other_workpos' => 'required_if:workPOS,Others',
            'workEXP' => 'required',
            'workAvailability' => 'required'
        ];
        $message = [  
            'highEdu.required' => 'The highest education field is required.',                              
            'contact_num.required' => 'The contact number field is required.',                            
            'seeker_zip.required' => 'The postcode field is required.',                                   
            'seeker_state.required' => 'The state field is required.',                                    
            'workSTAT.required' => 'The working status field is required.',                           
            'workEXP.required' => 'The working experience field is required.',                       
            'workAvailability.required' => 'The availability to work field is required.', 


            'nric_full.required_if' => 'The National Registration Identity Card field is required when type is Malaysian',     
            'passport.required_if' => 'The Passport Number field is required when type is Non Malaysian',    
            'workPOS.required_if' => 'The working position field is required.',     
            'other_workpos.required_if' => 'The other work position field is required when working position is :value.'     
        ]; 

        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()){
            return response()->json([
              'fail' =>true, 
              'errors' => $validator->errors()
            ]); 
        }else{  

            //send to dB 
            Operator::create([
                'user_id' => $user->id,
                'seeker_name' => $request->input('name'), 
                'seeker_nric' => $nric, 
                'seeker_ctc_tel1' => $request->input('contact_num'), 
                'seeker_noYrsExp' => $request->input('working'), 
                'seeker_survey_list' => $request->input('survey'), 
                'seeker_survey_others' => $request->input('other_survey')
            ]); 
         
            return response()->json([
              'fail' =>false, 
              'redirect_url' => route('operatorForm')
            ]);
        }
    }
}
