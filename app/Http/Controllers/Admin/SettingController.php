<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
 
use App\Model\Candidate;
use App\Model\Status;
use App\Model\CandidateDuration;
use App\Model\PackagePlan;
use App\Model\employer;
use App\Model\EmployerTokenResume;
use App\Model\EmployerTokenPost;

class SettingController extends Controller
{ 
    public function __construct()
    {
        $this->middleware('auth:admin'); // (auth:'guards')
    }

    public function search_candidate()
    {
    	$status = Status::all();
    	$candidates = Candidate::all();


    	return view('admin.setting.candidate', compact('status'));
    }

    public function candidate_expired()
    {
        $duration = CandidateDuration::all();  
        return view('admin.setting.candidate_exp', compact('duration'));
    }

    public function mail()
    { 
        return view('admin.setting.mail', compact('duration'));
    }

    public function web()
    {  
        return view('admin.setting.web', compact('duration'));
    } 

    public function package()
    {  
        $pkgs = new PackagePlan();
        $pkgs = $pkgs->orderby('type', 'ASC')->paginate(5);

        return view('admin.setting.package', compact('pkgs'));
    }

    public function package_employer(Request $req)
    {   
        $req->session()->put('employer_name', $req
            ->has('employer_name') ? $req->get('employer_name') : ($req->session()
            ->has('employer_name') ? $req->session()->get('employer_name') : ''));

        $employers = new employer(); 
        $tokenRs = new EmployerTokenResume();
        $tokenPs = new EmployerTokenPost();
        
        $tokenRs = $tokenRs->all();
        $tokenPs = $tokenPs->all();
        if($req->session()->get('employer_name') != '')
            $employers = $employers->whereRaw("emp_name LIKE '%".$req->session()->get('employer_name')."%'")
                                   ->paginate(10);   
        else 
            $employers = $employers->paginate(10);   

        return view('admin.setting.package_employer', compact('employers', 'tokenRs', 'tokenPs'));
    }

    public function package_add()
    {  
        $pkgs = new PackagePlan();
        $pkgs = $pkgs->orderby('type', 'ASC')->paginate(5);

        return view('admin.setting.package_add', compact('pkgs'));
    }

    public function package_reload(Request $req)
    {  
        $req->session()->put('idR', $req
            ->has('idR') ? $req->get('idR') : ($req->session()
            ->has('idR') ? $req->session()->get('idR') : ''));
        
        $req->session()->put('idP', $req
            ->has('idP') ? $req->get('idP') : ($req->session()
            ->has('idP') ? $req->session()->get('idP') : ''));

        $req->session()->put('employer', $req
            ->has('employer') ? $req->get('employer') : ($req->session()
            ->has('employer') ? $req->session()->get('employer') : '')); 

        $employers = new employer(); 
        $tokenRs = new EmployerTokenResume();
        $tokenPs = new EmployerTokenPost();

        $employers = $employers->find($req->session()->get('employer')); 
        $tokenRs = $tokenRs->find($req->session()->get('idR'));
        $tokenPs = $tokenPs->find($req->session()->get('idP'));

        return view('admin.setting.package_reload', compact('employers', 'tokenRs', 'tokenPs'));
    }
}
