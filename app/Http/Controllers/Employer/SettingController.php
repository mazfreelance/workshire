<?php

namespace App\Http\Controllers\Employer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input; 
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
 
use App\Model\EmployerTokenResume;
use App\Model\EmployerTokenPost;
use App\Model\PackagePlan;
use App\Model\PaidCandidate;
use App\Model\Notification_Employer;

use App\User_Employer;
  
class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:employer'); // (auth:'guards')
    }
    
    public function index()
    {
    	return view('setting.account');
    }

    public function updateAcc(Request $request){ 
        $rules = [
          'email' => 'required|email|unique:users_employer'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
        return response()->json([
          'fail' =>true, 
          'errors' => $validator->errors()
        ]); 

        $user = User_Employer::find(Auth::guard('employer')->user()->id);
        $user->email = $request->email;
        $user->save();

        return response()->json([
          'fail' =>false, 
          'redirect_url' => route('employer.setting')
        ]); 
    }

    public function password()
    {
        return view('setting.password');
    }

    public function updatePass(Request $request){
        Validator::extend('valid_password', function($attr, $value){ 
            return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{6,})/', $value); 
        }); 
        Validator::extend('passwordNotSame', function($attribute, $value, $parameters, $validator) {
            return Hash::check($value, Auth::user()->password);
        });
        $rules = [
          'newpass' => 'required|valid_password',
          'confirmnewpass' => 'required|same:newpass'

        ];
        $message = [ 
            'newpass.required'=>'The new password field is required.',
            'newpass.valid_password'=>'<ul style="list-style:none" class="ml-0">
                                        <li>Password field must contain: <ol><li>at least one(1) lowercase alphabetical character</li><li>at least one(1) uppercase alphabetical character</li><li>at least one(1) numeric character</li><li>at least six(6) characters or longer</li><li>eg: Password123</li></ol></li>
                                        </ul>', 
            'confirmnewpass.required'=>'The confirm new password field is required.',
            'confirmnewpass.same'=>'The confirm new password and new password is not match.',
        ]; 

        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails())
        return response()->json([
          'fail' =>true, 
          'errors' => $validator->errors()
        ]); 

        $user = User_Employer::find(Auth::guard('employer')->user()->id);
        $user->password = Hash::make($request->newpass);
        $user->save();
        return response()->json([
          'fail' =>false, 
          'redirect_url' => route('employer.setting.password')
        ]); 
    }


    public function notification()
    {
        $noti = Notification_Employer::where('user_id', '=', Auth::guard('employer')->user()->id)->first();
        return view('setting.notification', compact('noti'));
    }

    public function notification_post(Request $request){ 
        $noti = Notification_Employer::find($request->input('id'));
        $noti->job_alert = $request->input('jobalertsubs');
        $noti->profile_remind = $request->input('profilealertsubs');
        $noti->promo_alert = $request->input('promoalertsubs');
        $noti->updated_at = date('Y-m-d h:i:s');
        $noti->save();
        
        //return back()->with('success', 'Successfully updated your account.');
        return response()->json([
          'fail' =>false, 
          'redirect_url' => route('employer.setting.notification')
        ]); 
    }

    public function plan()
    {
    	$tokenRs = EmployerTokenResume::where('employer_id', '=', Auth::user()->employer[0]->id)->first();
        $tokenPs = EmployerTokenPost::where('employer_id', '=', Auth::user()->employer[0]->id)->first();
        
        if(isset($tokenPs) OR isset($tokenRs))
        {
            if(isset($tokenPs->package_plan))
            {
                $pp_P = explode('|', $tokenPs->package_plan);
                $plans_P = PackagePlan::find($pp_P[1]); 
            }
            if(isset($tokenRs->package_plan))
            {
                $pp_R = explode('|', $tokenRs->package_plan);
                $plans_R = PackagePlan::find($pp_R[1]);
                $totalTakenResumeFresh = PaidCandidate::selectRaw('SUM(buy_tokenTaken) as total')
                                        ->where('employer_id', '=', Auth::user()->employer[0]->id) 
                                        ->where('seeker_type', '=', 'FRESH')
                                        ->first();
                $totalTakenResumeExp = PaidCandidate::selectRaw('SUM(buy_tokenTaken) as total')
                                        ->where('employer_id', '=', Auth::user()->employer[0]->id) 
                                        ->where('seeker_type', '=', 'EXPERIENCE')
                                        ->first();
                $totalTakenResume = PaidCandidate::selectRaw('SUM(buy_tokenTaken) as total')
                                        ->where('employer_id', '=', Auth::user()->employer[0]->id)  
                                        ->first();
            }
            
            return view('setting.plan', compact('tokenRs', 'tokenPs', 'plans_R', 'plans_P', 'totalTakenResumeFresh', 'totalTakenResumeExp', 'totalTakenResume'));
        }
        else return view('setting.plan', compact('tokenRs', 'tokenPs'));
    } 
}
