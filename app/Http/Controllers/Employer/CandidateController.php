<?php

namespace App\Http\Controllers\Employer;
 
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use DB;

use App\Model\job_seeker;
use App\Model\PaidCandidate;
use App\Model\JobSeeker_Experience;
use App\Model\JobSeeker_Education;
use App\Model\CandidateDuration;
use App\Model\EmployerTokenResume;
use App\Model\Education_Category;
use App\Model\Operator;

class CandidateController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth:employer'); // (auth:'guards')
    }

    /*
    	FRESHIE CANDIDATES 
    */
    public function candidate_search_fresh(Request $request)
    { 	 
		$request->session()->put('search_institute', $request
				            ->has('search_institute') ? $request->get('search_institute') : ($request->session()
				            ->has('search_institute') ? $request->session()->get('search_institute') : ''));

		$request->session()->put('search_state', $request
				            ->has('search_state') ? $request->get('search_state') : ($request->session()
				            ->has('search_state') ? $request->session()->get('search_state') : ''));

		$request->session()->put('search_education', $request
				            ->has('search_education') ? $request->get('search_education') : ($request->session()
				            ->has('search_education') ? $request->session()->get('search_education') : ''));

		$request->session()->put('search_fos_search', $request
				            ->has('search_fos_search') ? $request->get('search_fos_search') : ($request->session()
				            ->has('search_fos_search') ? $request->session()->get('search_fos_search') : ''));

		$request->session()->put('search_eduCate', $request
				            ->has('search_eduCate') ? $request->get('search_eduCate') : ($request->session()
				            ->has('search_eduCate') ? $request->session()->get('search_eduCate') : '')); 

		$request->session()->put('search_gender', $request
				            ->has('search_gender') ? $request->get('search_gender') : ($request->session()
				            ->has('search_gender') ? $request->session()->get('search_gender') : '')); 
		/** QUERY SELECTION START **/ 
		$seekers = job_seeker::join('job_seeker_education', function ($join) use ($request)
					{
			            $join->on('job_seekers.id', '=', 'job_seeker_education.seeker_id')
			                 ->whereRaw("job_seeker_education.level = 1")
			                 ->whereRaw("job_seeker_education.institute like '%".$request->session()->get('search_institute')."%'")
			                 ->whereRaw("job_seeker_education.highest_education like '%".$request->session()->get('search_education')."%'")
			                 ->whereRaw("job_seeker_education.major_study like '%".$request->session()->get('search_fos_search')."%'");
			        })    
                    ->join('education_for_count', "education_for_count.foscho", "=", "job_seeker_education.field_of_study") 
					->whereRaw("job_seekers.seeker_state like '%".$request->session()->get('search_state')."%'") 
 
			    	->whereRaw("education_for_count.fosname like '%".$request->session()->get('search_eduCate')."%'") 
					->whereRaw("job_seekers.seeker_gender like '%".$request->session()->get('search_gender')."%'")   

					->whereRaw("seeker_type = 'FRESH'")
					->orderBy('job_seekers.seeker_name', 'ASC')
		            ->orderBy('job_seekers.created_at', 'DESC') 
		            ->paginate(25); 
  
		$paidC = PaidCandidate::where('employer_id', '=', Auth::guard('employer')->user()->employer[0]->id)
					   ->with('seekerDtl')
					   ->orderBy('id', 'DESC')
					   ->get(); 

        $totalSeeker = job_seeker::selectRaw('count(*) as total') 
					        ->join('job_seeker_education', 'job_seekers.id', '=', 'job_seeker_education.seeker_id')
							->whereRaw("seeker_type = 'FRESH'")
        					->first();		

        $totalTakenResume = PaidCandidate::selectRaw('count(*) as total')
                            ->where('employer_id', '=', Auth::guard('employer')->user()->employer[0]->id)
                            ->where('seeker_type', '=', 'FRESH')
                            ->first();
  
		$duration = CandidateDuration::where('candidate_type', '=', 'Fresh')->first(); 
		 
    	$currToken = EmployerTokenResume::where('employer_id', '=', Auth::guard('employer')->user()->employer[0]->id)->first();

    	/*
			SELECT fosname, count(fosname)
			FROM education_for_count
			INNER JOIN job_seeker_education ON education_for_count.foscho = job_seeker_education.field_of_study
			#WHERE education_for_count.fosname LIKE "%Art / Media / Communication%"
			GROUP by fosname
			ORDER BY fosname ASC
    	*/
        $eduCats = Education_Category::selectRaw('education_for_count.fosname as name')
                             ->selectRaw('count(education_for_count.fosname) as total')
                             ->join('job_seeker_education', "education_for_count.foscho", "=", "job_seeker_education.field_of_study")
                             ->join('job_seekers', "job_seeker_education.seeker_id", "=", "job_seekers.id") 
                             ->where('job_seekers.seeker_type', '=', 'FRESH')
                             ->groupby('education_for_count.fosname')
                             ->orderby('education_for_count.fosname', 'ASC')
                             ->get(); 
        /** QUERY SELECTION END **/                     
        /** REQUEST AJAX START **/ 
        if($request->ajax())
	    {
	      return view('employer.candidate.fresh.index', compact('seekers' , 'paidC', 'duration', 'currToken', 'totalTakenResume', 'totalSeeker', 'eduCats'));
	    }
	    else
	    {
	      return view('employer.candidate.fresh.ajax', compact('seekers', 'paidC', 'duration', 'currToken', 'totalTakenResume', 'totalSeeker', 'eduCats'));
	    }               
        /** REQUEST AJAX END **/ 
    } 

    /*
    	EXPERIENCES CANDIDATES 
    */
    public function candidate_search_experience(Request $request)
    {  
		$request->session()->put('search_institute', $request
				            ->has('search_institute') ? $request->get('search_institute') : ($request->session()
				            ->has('search_institute') ? $request->session()->get('search_institute') : ''));

		$request->session()->put('search_state', $request
				            ->has('search_state') ? $request->get('search_state') : ($request->session()
				            ->has('search_state') ? $request->session()->get('search_state') : ''));

		$request->session()->put('search_education', $request
				            ->has('search_education') ? $request->get('search_education') : ($request->session()
				            ->has('search_education') ? $request->session()->get('search_education') : ''));

		$request->session()->put('search_fos_search', $request
				            ->has('search_fos_search') ? $request->get('search_fos_search') : ($request->session()
				            ->has('search_fos_search') ? $request->session()->get('search_fos_search') : ''));

		$request->session()->put('search_eduCate', $request
				            ->has('search_eduCate') ? $request->get('search_eduCate') : ($request->session()
				            ->has('search_eduCate') ? $request->session()->get('search_eduCate') : '')); 

		$request->session()->put('search_gender', $request
				            ->has('search_gender') ? $request->get('search_gender') : ($request->session()
				            ->has('search_gender') ? $request->session()->get('search_gender') : '')); 
 		
        /** QUERY SELECTION START **/            
		$seekers = job_seeker::join('job_seeker_education', function ($join) use ($request)
					{
			            $join->on('job_seekers.id', '=', 'job_seeker_education.seeker_id')
			                 ->whereRaw("job_seeker_education.level = 1")
			                 ->whereRaw("job_seeker_education.institute like '%".$request->session()->get('search_institute')."%'")
			                 ->whereRaw("job_seeker_education.highest_education like '%".$request->session()->get('search_education')."%'")
			                 ->whereRaw("job_seeker_education.major_study like '%".$request->session()->get('search_fos_search')."%'");
			        })    
                    ->join('education_for_count', "education_for_count.foscho", "=", "job_seeker_education.field_of_study") 
					->whereRaw("job_seekers.seeker_state like '%".$request->session()->get('search_state')."%'")
			    	->whereRaw("education_for_count.fosname like '%".$request->session()->get('search_eduCate')."%'") 
					->whereRaw("job_seekers.seeker_gender like '%".$request->session()->get('search_gender')."%'")   
					->whereRaw("job_seekers.seeker_state like '%".$request->session()->get('search_state')."%'") 
					->whereRaw("seeker_type = 'EXPERIENCE'")
					->with('experience')
					->orderBy('job_seekers.seeker_name', 'ASC')
		            ->orderBy('job_seekers.created_at', 'DESC') 
		            ->paginate(25); 
  
		$paidC = PaidCandidate::where('employer_id', '=', Auth::guard('employer')->user()->employer[0]->id)
					   ->with('seekerDtl')
					   ->orderBy('id', 'DESC')
					   ->get(); 

        $totalSeeker = job_seeker::selectRaw('count(*) as total') 
					        ->join('job_seeker_education', 'job_seekers.id', '=', 'job_seeker_education.seeker_id')
							->whereRaw("seeker_type = 'EXPERIENCE'")
        					->first();			

        $totalTakenResume = PaidCandidate::selectRaw('count(*) as total')
                            ->where('employer_id', '=', Auth::guard('employer')->user()->employer[0]->id)
                            ->where('seeker_type', '=', 'EXPERIENCE')
                            ->first();
  
		$duration = CandidateDuration::where('candidate_type', '=', 'Experience')->first();  
    	$currToken = EmployerTokenResume::where('employer_id', '=', Auth::guard('employer')->user()->employer[0]->id)->first();

        $eduCats = Education_Category::selectRaw('education_for_count.fosname as name')
                             ->selectRaw('count(education_for_count.fosname) as total')
                             ->join('job_seeker_education', "education_for_count.foscho", "=", "job_seeker_education.field_of_study")
                             ->join('job_seekers', "job_seeker_education.seeker_id", "=", "job_seekers.id") 
                             ->where('job_seekers.seeker_type', '=', 'EXPERIENCE')
                             ->groupby('education_for_count.fosname')
                             ->orderby('education_for_count.fosname', 'ASC')
                             ->get();  
        /** QUERY SELECTION END **/                     
        /** REQUEST AJAX START **/ 
	    if($request->ajax())
	    {
	      return view('employer.candidate.experience.index', compact('seekers' , 'paidC', 'duration', 'currToken', 'totalTakenResume', 'totalSeeker', 'eduCats'));
	    }
	    else
	    {
	      return view('employer.candidate.experience.ajax', compact('seekers', 'paidC', 'duration', 'currToken', 'totalTakenResume', 'totalSeeker', 'eduCats'));
	    } 
        /** REQUEST AJAX END **/ 
    } 

    /*
    	INTERNSHIP CANDIDATES 
    */
    public function candidate_search_intern(Request $request)
    { 
    	if($request->ajax())
	    {
      		return view('employer.candidate.intern.index');
	    }
	    else
	    {
      		return view('employer.candidate.intern.ajax');
	    }  
    }

    /*
    	OPERATOR CANDIDATES 
    */
    public function candidate_search_operator(Request $request)
    {	

		$request->session()->put('search_gender', $request
				            ->has('search_gender') ? $request->get('search_gender') : ($request->session()
				            ->has('search_gender') ? $request->session()->get('search_gender') : ''));  

		$request->session()->put('search_availability', $request
				            ->has('search_availability') ? $request->get('search_availability') : ($request->session()
				            ->has('search_availability') ? $request->session()->get('search_availability') : '')); 
    	
		$request->session()->put('search_working', $request
				            ->has('search_working') ? $request->get('search_working') : ($request->session()
				            ->has('search_working') ? $request->session()->get('search_working') : '')); 

    	/** QUERY SELECTION START **/ 
    	if($request->session()->get('search_availability') != '' OR $request->session()->get('search_gender') != '' OR $request->session()->get('search_working') != ''){
		$seekers = Operator::orderBy('operator_pool.name', 'ASC')  
					   		->whereRaw("availability_work = '".$request->session()->get('search_availability')."'")   
						    ->whereRaw("gender like '%".$request->session()->get('search_gender')."%'")  
						    ->whereRaw("working_status like '%".$request->session()->get('search_working')."%'") 
        		   		    ->paginate(25); 
       	}else{
   		$seekers = Operator::orderBy('operator_pool.name', 'ASC')  
    		   		    ->paginate(25); 
       	}
  
		$paidC = PaidCandidate::where('employer_id', '=', Auth::guard('employer')->user()->employer[0]->id)
					   ->with('seekerDtl')
					   ->orderBy('id', 'DESC')
					   ->get(); 

        $totalSeeker = Operator::count();		

        $totalTakenResume = PaidCandidate::selectRaw('count(*) as total')
                            ->where('employer_id', '=', Auth::guard('employer')->user()->employer[0]->id)
                            ->where('seeker_type', '=', 'OPERATOR')
                            ->first();
  
		$duration = CandidateDuration::where('candidate_type', '=', 'Operator')->first(); 
    	$currToken = EmployerTokenResume::where('employer_id', '=', Auth::guard('employer')->user()->employer[0]->id)->first();

    	/*
			SELECT fosname, count(fosname)
			FROM education_for_count
			INNER JOIN job_seeker_education ON education_for_count.foscho = job_seeker_education.field_of_study
			#WHERE education_for_count.fosname LIKE "%Art / Media / Communication%"
			GROUP by fosname
			ORDER BY fosname ASC
    	*/
        $eduCats = Education_Category::selectRaw('education_for_count.fosname as name')
                             ->selectRaw('count(education_for_count.fosname) as total')
                             ->join('job_seeker_education', "education_for_count.foscho", "=", "job_seeker_education.field_of_study")
                             ->join('job_seekers', "job_seeker_education.seeker_id", "=", "job_seekers.id") 
                             ->where('job_seekers.seeker_type', '=', 'FRESH')
                             ->groupby('education_for_count.fosname')
                             ->orderby('education_for_count.fosname', 'ASC')
                             ->get(); 
        /** QUERY SELECTION END **/                     
        /** REQUEST AJAX START **/ 
		if($request->ajax())
	    {
      		return view('employer.candidate.operator.index', compact('seekers', 'duration', 'currToken', 'totalSeeker', 'totalTakenResume'));
	    }
	    else
	    {
      		return view('employer.candidate.operator.ajax', compact('seekers', 'duration', 'currToken', 'totalSeeker', 'totalTakenResume'));
	    }  
    }

 
    /*
    	BUY CANDIDATES 
    */
    public function buy_candidate(Request $request)
    {	  
    	$statBuy = Input::get("statBuy") == 'Renew' ? Input::get("statBuy"):'New'; 
		$duration = Input::get("duration");
    	$boughtDate = date('Y-m-d');
    	$expiredDate = date('Y-m-d', strtotime("+".$duration, strtotime($boughtDate)));
    	//new balance

    	//getToken
    	$currToken = new EmployerTokenResume();
    	$currToken = $currToken->where('employer_id', '=', Auth::guard('employer')->user()->employer[0]->id)->first(); 
    	$BalToken = $currToken->balance - Input::get("tokenVal"); 

    	if(Input::get("statBuy") == 'Renew'){
    		$paid = PaidCandidate::find(Input::get("paidID"));
			//save
	    	$paid->employer_id = Input::get("employer");
	    	$paid->seeker_id = Input::get("seeker");
	    	$paid->seeker_type = Input::get("type");
	    	$paid->buy_tokenTaken = Input::get("tokenVal");
	    	$paid->buy_count = $paid->buy_count+1;
	    	$paid->boughtDate = $boughtDate;
	    	$paid->expiredDate = $expiredDate;
	    	$paid->buy_stat = $statBuy;
	    	$paid->created_at = date('Y-m-d H:i:s');  
    	}else{  
			$paid = new PaidCandidate(); 
			//save
	    	$paid->employer_id = Input::get("employer");
	    	$paid->seeker_id = Input::get("seeker");
	    	$paid->seeker_type = Input::get("type");
	    	$paid->buy_tokenTaken = Input::get("tokenVal");
	    	$paid->buy_count = 1;
	    	$paid->boughtDate = $boughtDate;
	    	$paid->expiredDate = $expiredDate;
	    	$paid->buy_stat = $statBuy;
	    	$paid->created_at = date('Y-m-d H:i:s');  
    	}
    	$paid->save();
    	//update 
		$currToken->balance = $BalToken;
		$currToken->save(); 

    	//$array_name = array('employer_id' =>$employer, 'seeker_id' =>$seeker); 
    	if ($request->ajax())
		{
		    return response()->json([ 
		        'redirect_url' => url('employer')
	      	]);
		} 
    }


	/*
    	PAID CANDIDATES 
    */
    public function paid(Request $request)
    {  
		$request->session()->put('search_talent_type', $request
				            ->has('search_talent_type') ? $request->get('search_talent_type') : ($request->session()
				            ->has('search_talent_type') ? $request->session()->get('search_talent_type') : '')); 

		$request->session()->put('search_fos_search', $request
				            ->has('search_fos_search') ? $request->get('search_fos_search') : ($request->session()
				            ->has('search_fos_search') ? $request->session()->get('search_fos_search') : '')); 

		$request->session()->put('search_institute', $request
				            ->has('search_institute') ? $request->get('search_institute') : ($request->session()
				            ->has('search_institute') ? $request->session()->get('search_institute') : ''));

		$request->session()->put('search_state', $request
				            ->has('search_state') ? $request->get('search_state') : ($request->session()
				            ->has('search_state') ? $request->session()->get('search_state') : ''));  

		$request->session()->put('search_education', $request
				            ->has('search_education') ? $request->get('search_education') : ($request->session()
				            ->has('search_education') ? $request->session()->get('search_education') : '')); 
 		
 		if($request->session()->get('search_talent_type') == 'OPERATOR'){
 		$paid_candidate = PaidCandidate::select('*', 'operator_pool.id')
						  ->join('operator_pool', function ($join) use ($request)
							{
					            $join->on('employer_paidforcandidate.seeker_id', '=', 'operator_pool.id')
									 ->whereRaw("operator_pool.state like '%".$request->session()->get('search_state')."%'") 
									 ->whereRaw("operator_pool.position = '".$request->session()->get('search_talent_type')."'");
					        })   
						  ->whereRaw("employer_paidforcandidate.seeker_type = '".$request->session()->get('search_talent_type')."'")
						  ->whereRaw('employer_paidforcandidate.employer_id = '.Auth::guard('employer')->user()->employer[0]->id) 
						  ->orderBy('employer_paidforcandidate.created_at', 'DESC')
						  ->paginate(10); 
 		}else{
		$paid_candidate = PaidCandidate::select('*', 'employer_paidforcandidate.id')
						  ->join('job_seekers', function ($join) use ($request)
							{
					            $join->on('employer_paidforcandidate.seeker_id', '=', 'job_seekers.id')
									 ->whereRaw("job_seekers.seeker_state like '%".$request->session()->get('search_state')."%'") 
									 ->whereRaw("job_seekers.seeker_type like '%".$request->session()->get('search_talent_type')."%'");
					        })   
						  ->join('job_seeker_education', function ($join) use ($request)
							{
					            $join->on('job_seekers.id', '=', 'job_seeker_education.seeker_id')
		                 			 ->whereRaw("job_seeker_education.level = 1")
					                 ->whereRaw("job_seeker_education.institute like '%".$request->session()->get('search_institute')."%'")
					                 ->whereRaw("job_seeker_education.highest_education like '%".$request->session()->get('search_education')."%'")
									 ->whereRaw("job_seeker_education.major_study like '%".$request->session()->get('search_fos_search')."%'");
					        })   
						  ->whereRaw('employer_paidforcandidate.employer_id = '.Auth::guard('employer')->user()->employer[0]->id) 
						  ->orderBy('employer_paidforcandidate.created_at', 'DESC')
						  ->paginate(10); 
		}				  

        $totalTakenResume = PaidCandidate::selectRaw('count(*) as total')
                            ->where('employer_id', '=', Auth::guard('employer')->user()->employer[0]->id)
                            ->first();
  
        $duration = CandidateDuration::all();
    	$currToken = EmployerTokenResume::where('employer_id', '=', Auth::guard('employer')->user()->employer[0]->id)->first();

    	$request->session()->put('search_eduCate', $request
				            ->has('search_eduCate') ? $request->get('search_eduCate') : ($request->session()
				            ->has('search_eduCate') ? $request->session()->get('search_eduCate') : '')); 

		$request->session()->put('search_gender', $request
				            ->has('search_gender') ? $request->get('search_gender') : ($request->session()
				            ->has('search_gender') ? $request->session()->get('search_gender') : '')); 

    	$eduCats = Education_Category::selectRaw('education_for_count.fosname as name')
                             ->selectRaw('count(education_for_count.fosname) as total') 
                             ->join('job_seeker_education', "education_for_count.foscho", "=", "job_seeker_education.field_of_study")
                             ->join('job_seekers', "job_seeker_education.seeker_id", "=", "job_seekers.id")  
                             ->whereExists(function($query)
					            {
					                $query->select(DB::raw(1))
					                      ->from('employer_paidforcandidate')
					                      ->whereRaw('employer_paidforcandidate.seeker_id = job_seeker_education.seeker_id')
					                      ->whereRaw('employer_paidforcandidate.employer_id = '.Auth::guard('employer')->user()->employer[0]->id);
					            }) 
                             ->groupby('education_for_count.fosname')
                             ->orderby('education_for_count.fosname', 'ASC')
                             ->get(); 


    	if($request->ajax())
	    {
	      return view('employer.candidate.paid.index', compact('paid_candidate', 'totalTakenResume', 'duration', 'currToken', 'eduCats'), ['edu'=>JobSeeker_Education::all(), 'exp'=>JobSeeker_Experience::all()]);
	    }
	    else
	    {
	      return view('employer.candidate.paid.ajax', compact('paid_candidate', 'totalTakenResume', 'duration', 'currToken', 'eduCats'), ['edu'=>JobSeeker_Education::all(), 'exp'=>JobSeeker_Experience::all()]);
	    } 
    }

    public function seeker_profile($id)
    {    
	    $seeker = job_seeker::find(decrypt($id));
	    $experience = JobSeeker_Experience::where('seeker_id', '=', decrypt($id))
	                                        ->orderby('exp_toDt', 'DESC')
	                                        ->get();
	    $education = JobSeeker_Education::where('seeker_id', '=', decrypt($id))->get();

	    return view('employer.candidate.seeker_profile', compact('seeker', 'education', 'experience'));   
    }
}
