<?php

namespace App\Http\Controllers\Employer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input; 
 
use App\Model\EmployerTokenResume;
use App\Model\EmployerTokenPost;
use App\Model\PackagePlan;
use App\Model\PaidCandidate;
  
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

    public function password()
    {
        return view('setting.password');
    }


    public function notification()
    {
        return view('setting.notification');
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
