<?php

namespace App\Http\Controllers\Employer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Image;
use Illuminate\Support\Facades\Storage;

use App\User_Employer;
use App\Model\employer; 

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:employer'); // (auth:'guards')
    }

    public function index()
    {
    	$employer = employer::where('users_id', '=', Auth::guard('employer')->user()->id)->first();
    	return view('employer.profile', compact('employer'));
    }

    public function complete()
    {
        $id = Auth::guard('employer')->user()->id;
        $emp = employer::selectraw("*, ISNULL(NULLIF(emp_aboutus,'')) + ISNULL(NULLIF(emp_size,'')) +
                                   ISNULL(NULLIF(emp_type,''))  + ISNULL(NULLIF(emp_industry,'')) + 
                                   ISNULL(NULLIF(emp_workhour,'')) + ISNULL(NULLIF(emp_spoken_language,'')) +
                                   ISNULL(NULLIF(emp_benefit,'')) + ISNULL(NULLIF(emp_address,'')) + 
                                   ISNULL(NULLIF(emp_town,'')) + ISNULL(NULLIF(emp_city,'')) + 
                                   ISNULL(NULLIF(emp_state,'')) + 
                                   ISNULL(NULLIF(emp_zipcode,'')) + ISNULL(NULLIF(emp_ctc_tel,'')) + 
                                   ISNULL(NULLIF(emp_ctc_person,'')) 
                                   AS incomplete")//14
                       ->where('users_id', '=', $id)
                       ->first(); 

        $photo = employer::selectraw("ISNULL(NULLIF(emp_logo_loc,'')) AS incomplete")
                           ->where('users_id', '=', $id)
                           ->first();   
        return 
            Auth::guard('employer')->user()->complete ? redirect()->intended(route('employer.dashboard'))  
            : view('employer.profile.complete', compact('emp', 'photo'));
    }

    public function create(Request $request)
    {
        $rules = [ 
            'company_name' => 'required',
            'company_type' => 'required',
            'company_other_type' => 'required_if:company_type,Others',
            'company_size' => 'required',
            'industry' => 'required',
            'lang' => 'required|array|min:1', 
            'benefit' => 'required|array|min:1', 
            'address' => 'required', 
            'zip' => 'required|numeric|digits:5', 
            'district' => 'required', 
            'city' => 'required',  
            'state' => 'required',  
            'about_us' => 'required',  
            'website' => 'nullable|url',
            'facebook' => 'nullable|url',
            'state' => 'required',  
            'person_name' => 'required',
            'person_ctc' => 'required|numeric',  
        ];

        if($request->input('ssm_no') !== '')
        { 
            $additionalRules = [
                'ssm_no' =>  'required'
            ];
            $rules = $rules+$additionalRules; 
        }else{
            $additionalRules = [
                'required|unique:employers,emp_regno'
            ];
            $rules = $rules+$additionalRules; 
        }
 
        if($request->input('lang') !== null)
        {
            if(in_array('Other', $request->input('lang')))
            {
              $additionalRules = [
                'other_language' =>  'required'
              ];
              $rules = $rules+$additionalRules;
            }
        }

        if($request->input('benefit') !== null)
        {
            if(in_array('Others', $request->input('benefit')))
            {
              $additionalRules = [
                'other_benefit' =>  'required'
              ];
              $rules = $rules+$additionalRules;
            }
        }

        $message = [  
            'lang.required' => 'The company preferred language field is required.',
            'website.url' => 'The :attribute format is invalid. Please include http:// or https://',
            'facebook.url' => 'The :attribute format is invalid.. Please include http:// or https://',
            'person_name.required' => 'The person name field is required.',
            'person_ctc.required' => 'The person contact number field is required.',
            'person_ctc.numeric' => 'The person contact number must be a number.',
        ];  
        

        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()) //return back()->withInput()->withErrors($validator); 
        return response()->json([
          'fail' =>true, 
          'errors' => $validator->errors()
        ]); 

        //request == save() 
        $employer = employer::find($request->input('id'));

        $employer->emp_name = $request->input('company_name');
        $employer->emp_regno = $request->input('ssm_no');
        $employer->emp_type = $request->input('company_type');   
        $employer->emp_type_other = $request->input('company_type') == 'Others' ? $request->input('company_other_type') : null;
        $employer->emp_size = $request->input('company_size');
        $employer->emp_industry = $request->input('industry');
        $employer->emp_spoken_language = implode(',', $request->input('lang')); 
        $employer->emp_spoken_language_other = in_array('Other', $request->input('lang')) ? $request->input('other_language') : null; 
        $employer->emp_benefit = implode(',', $request->input('benefit')); 
        $employer->emp_benefit_other = in_array('Others', $request->input('benefit')) ? $request->input('other_benefit') : null; 
        $employer->emp_address = $request->input('address');
        $employer->emp_zipcode = $request->input('zip');
        $employer->emp_town = $request->input('district'); 
        $employer->emp_city = $request->input('city');
        $employer->emp_state = $request->input('state');
        $employer->emp_aboutus = $request->input('about_us'); 
        $employer->emp_website = $request->input('website');
        $employer->emp_facebook = $request->input('facebook');
        $employer->emp_ctc_person = $request->input('person_name'); 
        $employer->emp_ctc_tel = $request->input('person_ctc'); 
        $employer->save();
         
        return response()->json([
          'fail' => false,
          'redirect_url' => route('employer.account.complete')
          //'redirect_url' => $dob
        ]);
    }

    public function upload_photo(Request $request)
    {   
        $rules = [
                    'photo' => 'required|mimes:jpeg,bmp,png',
        ];  

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) //return back()->withInput()->withErrors($validator); 
        return response()->json([
          'fail' =>true, 
          'errors' => $validator->errors()
        ]);          

        $user = Auth::guard('employer')->user();
        $name = $user->employer[0]->emp_name;
        $file = $request->file('photo');  
        $input['imagename'] = $name.'-'.time().'.'.$file->getClientOriginalExtension();  

        $destinationPath = public_path('/default_pictures/medium');
        $img = Image::make($file->getRealPath())
                ->resize(250, 250);
        $img->save($destinationPath.'/'.$input['imagename']);
 
        $destinationPath = public_path('/default_pictures/small');
        $img2 = Image::make($file->getRealPath())
                ->resize(50, 50);
        $img2->save($destinationPath.'/'.$input['imagename']);
        //$destinationPath = public_path('/default_pictures');
        //$file->move($destinationPath, $input['imagename']);  

        $emp = employer::find($user->employer[0]->users_id);

        if(file_exists(public_path().'/default_pictures/small/'.$emp->emp_logo_loc) AND file_exists(public_path().'/default_pictures/medium/'.$emp->emp_logo_loc) AND $emp->emp_logo_loc != ''){ 
            unlink(public_path().'/default_pictures/small/'.$emp->emp_logo_loc); 
            unlink(public_path().'/default_pictures/medium/'.$emp->emp_logo_loc); 
        }

        $emp->emp_logo_loc = $input['imagename'];
        $emp->save();

        return response()->json([
          'fail' => false,
          'redirect_url' => route('employer.account.complete')
          //'redirect_url' => $dob
        ]);
    }

    public function verify_complete($id){

        $user = User_Employer::find($id);
        $user->complete = 1;
        $user->save();

        return back()->with('success', 'Successfully to verified profile');
    }
}
