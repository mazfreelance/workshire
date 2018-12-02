<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;  

use Yajra\Datatables\Datatables;
use App\Model\job_seeker; 
use App\Model\employer;

class DashboardController extends Controller
{
    
    public function __construct()
    {
        //$this->middleware('auth:admin'); // (auth:'guards')

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

    public function seeker()
    {        
        return view('admin.source.seeker');
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

    public function employer()
    {        
        return view('admin.source.employer', compact('totalAll', 'totalSeeker', 'totalEmployer'));
    } 

    public function other()
    {        
        return view('admin.source.other', compact('totalAll', 'totalSeeker', 'totalEmployer'));
    } 
}
