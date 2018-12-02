<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
 
use App\Model\Candidate;
use App\Model\Status;
use App\Model\CandidateDuration;
use App\Model\PackagePlan;
use App\Model\employer;
use App\Model\EmployerTokenResume;
use App\Model\EmployerTokenPost;
use App\Model\Admin_Email;
use App\User_Admin;

class SettingController extends Controller
{ 
    public function __construct()
    {
        $this->middleware('auth:admin'); // (auth:'guards') 


        $emailSignup = \DB::table('admin_email')->whereRaw('type = "signup"')->get();  
        $emailJob = \DB::table('admin_email')->whereRaw('type = "job"')->get();  

        $this->emailSignup = $emailSignup;
        $this->emailJob = $emailJob;  

        $user = User_Admin::all(); 
        $this->user = $user;  
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
        $emailSignup = $this->emailSignup;  
        $emailJob = $this->emailJob;  
        return view('admin.setting.mail', compact('emailSignup', 'emailJob'));
    }

    public function add_email(Request $request){

        $rules = [
            'email' => 'required|email',
            //'password' => 'required|string|min:6|confirmed',
            'type' => 'required',
            'name' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) return back()->with('Error', 'Error to add new email ')->withErrors($validator);
        
        Admin_Email::create([ 
            'email' => $request->input('email'), 
            'class' => 'cc', 
            'type' => $request->input('type'), 
            'name' => $request->input('name'),
        ]);  

        return back()->with('Success', 'Succesffully add email '. $request->input('email'));
    }

    public function update_email(Request $request, $id)
    {
        if ($request->isMethod('get')){ 
            $emailSignup = $this->emailSignup;
            $emailJob = $this->emailJob;  
            $editEmail = Admin_Email::find($id);

            return view('admin/setting/mail', compact('emailJob', 'emailSignup', 'editEmail'));
        } 

        $rules = [
            'email' => 'required|email',
            //'password' => 'required|string|min:6|confirmed',
            'type' => 'required',
            'name' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) return back()->with('Error', 'Error to update email')->withErrors($validator);

        $email = Admin_Email::find($id);
        $email->email = $request->input('email');
        $email->name = $request->input('name');
        $email->type = $request->input('type');
        $email->save();

        return redirect('admin/setting/mail')->with('Success', 'Succesffully update email '. $request->input('email'));
    }

    public function destroy_email($id)
    { 
        $e = Admin_Email::find($id);
        $email = $e->email;
        Admin_Email::destroy($id);
        return redirect('admin/setting/mail')->with('Success', 'Succesffully deleted email '. $email);
    } 

    public function user(Request $request){
        $user = $this->user; 
        return view('admin.setting.user', compact('user'));
    }
    public function create_user(Request $request){
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users_admin',
            'password' => 'required|string|min:6|confirmed',  
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) return back()->with('Error', 'Error to add user admin ')->withErrors($validator)->withInput();
        
        User_Admin::create([ 
            'email' => $request->input('email'),  
            'password' => Hash::make($request->input('password')),
            'name' => $request->input('name'),  
            'role_id' => 4
        ]);  

        return back()->with('Success', 'Succesffully add user admin'. $request->input('email'));
        
    }
    public function update_user(Request $request, $id){ 
        $user = $this->user; 
        if ($request->isMethod('get')) return view('admin.setting.user', compact('user'), ['editEmail' => User_Admin::find($id)]); 

        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:6|confirmed',  
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) return back()->with('Error', 'Error to update email')->withErrors($validator);

        $email = User_Admin::find($id);
        $email->email = $request->input('email');
        $email->name = $request->input('name');
        $email->password = Hash::make($request->input('password'));
        $email->save();

        return redirect('admin/setting/user')->with('Success', 'Succesffully update email '. $request->input('email'));
    }
    public function destroy_user($id){
        $e = User_Admin::find($id);
        $email = $e->email;
        User_Admin::destroy($id);
        return redirect('admin/setting/user')->with('Success', 'Succesffully deleted email '. $email);
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
