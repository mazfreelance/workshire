<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;  

use Yajra\Datatables\Datatables;


use App\User; 
use App\User_Employer;
use App\Model\job_seeker; 
use App\Model\employer;
use App\Model\JobSeeker_Education;

use App\Model\jobPost;

class DashboardController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:admin'); // (auth:'guards')

        $totalSeeker = \DB::table('job_seekers')
                               ->count();
        $totalEmployer = \DB::table('employers')
                               ->count();

        $totalAll = $totalSeeker + $totalEmployer; 

        $this->seeker = $totalSeeker;
        $this->employer = $totalEmployer;
        $this->total = $totalAll;
    }

    public function index()
    { 	    
        $totalSeeker = $this->seeker;
        $totalEmployer = $this->employer;
        $totalAll = $this->total; 
    	return view('admin.main', compact('totalAll', 'totalSeeker', 'totalEmployer'));
    } 

    public function numbers()
    {        
        return view('admin.source.numbers');
    } 

    public function seeker_getData()
    {       
        //return Datatables::of(job_seeker::query())->make(true);  

        $query = \DB::table('job_seekers')
            ->join('job_seeker_education', 'job_seekers.id', '=', 'job_seeker_education.seeker_id')
            ->join('job_seeker_resume', 'job_seekers.id', '=', 'job_seeker_resume.seeker_id')
            ->where('job_seeker_education.level', '=', 1)
            ->select([
                        'job_seekers.created_at', 'job_seekers.seeker_name', 'job_seekers.seeker_state', 'job_seekers.seeker_DOB', 'job_seekers.seeker_nric', 'job_seekers.seeker_ctc_tel1',
                        'job_seeker_education.highest_education', 'job_seeker_education.grade_achievement', 'job_seeker_education.field_of_study', 'job_seeker_education.major_study', 'job_seeker_education.institute',
                        'job_seeker_resume.resume_loc'
                    ]); 

        return Datatables::of($query) 
            ->addColumn('resume_loc', function ($user) {
                return '<a href="' . route('resume', $user->resume_loc) .'" target="_blank">'.$user->resume_loc.'</a>'; 
            })
            ->rawColumns(['action','resume_loc'])
            ->editColumn('created_at', function ($user) { 
                return date('d/M/y H:i:s a', strtotime($user->created_at) );
            })
            ->editColumn('seeker_DOB', function ($user) { 
                return date('d/M/y', strtotime($user->seeker_DOB) );
            })
            ->make(true);
    } 
    
    public function demodata()
    {   
        $now = \Carbon::now();
        $jobPost = jobPost::orderby('jobpost_endDate', 'DESC')->paginate(10);
        $age = job_seeker::selectRaw('YEAR(seeker_DOB) as year, YEAR(CURRENT_TIMESTAMP) - YEAR(seeker_DOB) AS age, 
                                                count(YEAR(CURRENT_TIMESTAMP) - YEAR(seeker_DOB)) as Total')
                         ->groupby('age')
                         ->get();

        $gender = job_seeker::selectRaw('count(case when seeker_gender="M" then 1 end) as male_cnt, count(case when seeker_gender="F" then 1 end) as female_cnt, count(seeker_gender) as total_cnt')->get();


        $exps = job_seeker::selectRaw('seeker_noYrsExp as expno, COUNT(seeker_noYrsExp) as count_exp')->groupby('expno')->get(); 
        return view('admin.source.demodata', compact('age', 'gender', 'exps'));
    }

    public function advancesearch()
    {   
        $seeker = job_seeker::orderby('created_at', 'DESC')->paginate(15);

        return view('admin.source.advancesearch', compact('seeker', 'gender', 'exps'));
    }


    public function postadvancesearch(Request $request)
    {   
        //return dd($request->all());
        $seeker = job_seeker::selectRaw('*, YEAR(CURRENT_TIMESTAMP) - YEAR(seeker_DOB) AS ages')
                            ->whereRaw('seeker_gender LIKE "%'.$request->input('dd-gender').'%"')
                            ->whereRaw('seeker_state LIKE "%'.$request->input('dd-state').'%"')
                            ->whereRaw('seeker_city LIKE "%'.$request->input('dd-city').'%"')
                            //->orWhereIn('YEAR(CURRENT_TIMESTAMP) - YEAR(seeker_DOB) BETWEEN "'.$request->input('dd-agefirst').'" AND "'.$request->input('dd-agelast').'"')
                            //->orWhere('seeker_noYrsExp BETWEEN "'.$request->input('dd-yoefirst').'" AND "'.$request->input('dd-yoelast').'"')
                            ->orderby('job_seekers.created_at', 'DESC')->get();
        $req = $request->all();

        return view('admin.source.advancesearch', compact('seeker', 'gender', 'exps', 'req'));
    }
}
