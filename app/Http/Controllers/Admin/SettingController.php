<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\AlertEmailToEmployerForPackage; 
 
use App\Model\Candidate;
use App\Model\Status;
use App\Model\CandidateDuration;
use App\Model\PostingDuration;
use App\Model\Cart_Order;
use App\Model\Cart_Product;
use App\Model\Cart_Order_Product;
use App\Model\PackagePlan;
use App\Model\employer;
use App\Model\EmployerTokenResume;
use App\Model\EmployerTokenPost;
use App\Model\Admin_Email;
use App\User_Admin;
use App\User_Employer;

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

    	return view('admin.setting.candidate', compact('status', 'candidates'));
    }

    public function post_search_candidate(Request $request)
    {   
        $candidate_id = $request->input('candidate_id');
        $status = $request->input('status');
        $candidates = Status::find($candidate_id);

        if($status == 'ENABLE'){ 
            $fresh = Candidate::find($request->input('fresh_id'));
            $exp = Candidate::find($request->input('exp_id'));
            $intern = Candidate::find($request->input('intern_id'));
            $operator = Candidate::find($request->input('operator_id'));

            $fresh_radio = $request->input('fresh-radio') == 'YES' ? 'YES' : 'NO'; 
            $exp_radio = $request->input('exp-radio') == 'YES' ? 'YES' : 'NO'; 
            $intern_radio = $request->input('intern-radio') == 'YES' ? 'YES' : 'NO'; 
            $operator_radio = $request->input('operator-radio') == 'YES' ? 'YES' : 'NO';

            $fresh->status = $fresh_radio;
            $fresh->message = $request->input('fresh-msg');
            $fresh->save();

            $exp->status = $exp_radio;
            $exp->message = $request->input('exp-msg');
            $exp->save();

            $intern->status = $intern_radio;
            $intern->message = $request->input('intern-msg');
            $intern->save();

            $operator->status = $operator_radio;
            $operator->message = $request->input('operator-msg');
            $operator->save();

            $candidates->status = $status; 
        }elseif($status == 'DISABLE'){
            $candidates->status = $status; 
        }

        $candidates->message = $request->input('status-msg');
        $candidates->save();

        return back()->with('success', 'Successfully saved candidates search.');

    }

    public function candidate_expired()
    {
        $duration = CandidateDuration::all();  
        return view('admin.setting.candidate_exp', compact('duration'));
    }

    public function update_candidate_expired(Request $request, $id)
    {
        if ($request->isMethod('get')) 
            return view('admin.setting.candidate_exp', ['duration' => CandidateDuration::all(), 
                                                        'editDuration' => CandidateDuration::find($id)]);

        $candidate = CandidateDuration::find($id);
        $limit = $request->input('limit');
        if($limit == 0) $candidate->duration = $limit;
        else{
            $number = $request->input('number');
            $number_dur = $request->input('number_dur');
            $duration = $number.' '.$number_dur;
            $candidate->duration = $duration;
        } 

        $candidate->token_value = $request->input('token_value');
        $candidate->save();

        return redirect()->route('admin.candidate_expired')->with('success', 'Successfully saved search '.$candidate->candidate_type.' candidate duration');
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

        return redirect('admin/setting/mail')->with('Success', 'Succesfully update email '. $request->input('email'));
    }

    public function destroy_email($id)
    { 
        $e = Admin_Email::find($id);
        $email = $e->email;
        Admin_Email::destroy($id);
        return redirect('admin/setting/mail')->with('Success', 'Succesfully deleted email '. $email);
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

        return redirect('admin/setting/user')->with('Success', 'Succesfully update email '. $request->input('email'));
    }
    public function destroy_user($id){
        $e = User_Admin::find($id);
        $email = $e->email;
        User_Admin::destroy($id);
        return redirect('admin/setting/user')->with('Success', 'Succesfully deleted email '. $email);
    }

    public function web()
    {  
        return view('admin.setting.web', compact('duration'));
    } 


    /*Package and Cart*/

    public function package()
    {  
        $pkgs = PackagePlan::orderby('type', 'ASC')->paginate(5);
        $postDur = PostingDuration::all();
        return view('admin.setting.package', compact('pkgs', 'postDur'));
    }

    public function create_package(Request $request)
    { 
        $pkgs = PackagePlan::create([
            'type' => $request->input('type'),
            'description' => $request->input('description'),
            'token_amount' => $request->input('token_amt'),
            'token_count' => 0,
            'status' => 'A',
        ]);

        return back()->with('success', 'Succesfully added new package');
    }

    public function update_package(Request $request, $id)
    {   
        $editPkg = PackagePlan::find($id);
        if ($request->isMethod('get')){ 
            $pkgs = PackagePlan::orderby('type', 'ASC')->paginate(5);
            $postDur = PostingDuration::all();
            return view('admin.setting.package', compact('pkgs', 'editPkg', 'postDur'));
        }

        $editPkg->type = $request->input('type');
        $editPkg->description = $request->input('description');
        $editPkg->token_amount = $request->input('token_amt');
        $editPkg->save();

        return redirect()->route('admin.package')->with('success', 'Succesfully updated '.$editPkg->type.'|'.$editPkg->id.' package');
    }

    public function destroy_package($id)
    {   
        $pkg = PackagePlan::find($id); 
        $old = $pkg->type.'|'.$pkg->id;
        PackagePlan::destroy($id); 

        return redirect()->route('admin.package')->with('success', 'Succesfully deleted '.$old.' package');
    }

    public function create_jobpostingduration(Request $request)
    {    
        $pkgs = PostingDuration::create([
            'post_type' => $request->input('jobpost'),
            'duration' => $request->input('number').' '.$request->input('number_dur'),
            'token_value' => $request->input('token_amt')
        ]);

        return back()->with('success', 'Succesfully added new job posting duration package');
    }

    public function update_jobpostingduration(Request $request, $id)
    {   
        $editPkgDur = PostingDuration::find($id);
        if ($request->isMethod('get')){ 
            $pkgs = PackagePlan::orderby('type', 'ASC')->paginate(5);
            $postDur = PostingDuration::all();
            return view('admin.setting.package', compact('pkgs', 'editPkgDur', 'postDur'));
        }

        $editPkgDur->post_type = $request->input('jobpost');
        $editPkgDur->duration = $request->input('number').' '.$request->input('number_dur');
        $editPkgDur->token_value = $request->input('token_amt');
        $editPkgDur->save();

        return redirect()->route('admin.package')->with('success', 'Succesfully updated '.$editPkgDur->post_type.' job posting duration package');
    }

    public function destroy_jobpostingduration($id)
    {   
        $pkg = PostingDuration::find($id); 
        $old = $pkg->post_type;
        PostingDuration::destroy($id); 

        return redirect()->route('admin.package')->with('success', 'Succesfully deleted '.$old.' job posting duration package');
    }


    public function cart_package()
    {   
        $cartPro = Cart_Product::paginate(10); 
        return view('admin.setting.cartpackage', compact('pkgs', 'cartPro'));
    }

    public function create_cart_package(Request $request)
    {
        //return dd($request->all());
        if($request->input('type') == 'lifetime') $limit = $request->input('type');
        else{
            $limit = $request->input('number').' '.$request->input('number_dur');
        }

        Cart_Product::create([
            'name' => $request->input('name'), 
            'post_id' => $request->input('jobpost'), 
            'resume_id' => $request->input('viewresume'), 
            'price' => $request->input('total'), 
            'disc_price' => $request->input('discount'), 
            'duration' => $limit, 
            'description' => $request->input('description')
        ]);

        return back()->with('success', 'Succesfully added new cart package');
    }

    public function update_cart_package(Request $request, $id)
    {   
        $editPkg = Cart_Product::find($id);
        if ($request->isMethod('get')){ 
            $cartPro = Cart_Product::paginate(10);
            return view('admin.setting.cartpackage', compact('cartPro', 'editPkg'));
        }
       

        if($editPkg->id == 1 OR $editPkg->id == 2){
            $editPkg->name = $request->input('name');
            $editPkg->description = $request->input('description'); 
        }else{
            if($request->input('type') == 'lifetime') $limit = $request->input('type');
            else{
                $limit = $request->input('number').' '.$request->input('number_dur');
            }    
            $editPkg->name = $request->input('name');
            $editPkg->post_id = $request->input('jobpost');
            $editPkg->resume_id = $request->input('viewresume');
            $editPkg->price = $request->input('total');
            $editPkg->disc_price = $request->input('discount');
            $editPkg->duration = $limit; 
            $editPkg->description = $request->input('description'); 
        } 
        $editPkg->save();
        
        return redirect()->route('admin.cart_package')->with('success', 'Succesfully updated '.$editPkg->name.' package');
    }

    public function destroy_cart_package($id)
    {   
        $pkg = Cart_Product::find($id); 
        $old = $pkg->name;
        Cart_Product::destroy($id); 

        return redirect()->route('admin.cart_package')->with('success', 'Succesfully deleted '.$old.' package');
    }

    public function package_cart()
    {    
        $pkgs = PackagePlan::all();
        $post = PostingDuration::all();
        $cartPro = Cart_Product::all();

        return view('admin.setting.package', compact('pkgs', 'post', 'cartPro'));
    }

    public function orders()
    {   
        $COP = Cart_Order_Product::paginate(10);
        return view('admin.setting.package_order', compact('COP'));
    }

    public function update_orders(Request $request, $id)
    {
        $editPkg = Cart_Order::find($id);
        if ($request->isMethod('get')){ 
            $COP = Cart_Order_Product::paginate(10);
            return view('admin.setting.package_order', compact('COP', 'editPkg'));
        } 
        $editPkg->status = $request->input('status'); 
        $editPkg->save();
        
        return redirect()->route('admin.orders')->with('success', 'Succesfully updated #'.$editPkg->id.' package');
    }

    public function add_token_cart(Request $request, $emp_id, $post_id, $resume_id)
    {
        $employer = employer::find($emp_id);
        $user = User_Employer::find($employer->users_id); 

        $postPlan = 'P|'.$post_id;
        $resumePlan = 'V|'.$resume_id;

        $TokenPost = EmployerTokenPost::where('employer_id', '=', $emp_id)->first();
        $TokenResume = EmployerTokenResume::where('employer_id', '=', $emp_id)->first();

        $postPP = PackagePlan::where('id', '=', $post_id)->first();
        $resumePP = PackagePlan::where('id', '=', $resume_id)->first();
        $token_post = $postPP->token_amount; 
        $token_resume = $resumePP->token_amount;

        $duration = Cart_Product::where('post_id', '=', $post_id)->where('resume_id', '=', $resume_id)->pluck('duration')->first(); 
        $now = \Carbon::now();
        $mod_date = strtotime($now."+ ".$duration);
        $expired_date = date("Y-m-d H:i:s",$mod_date) . "\n";

        if(isset($TokenPost) AND isset($TokenResume)){
            //Reset new if exist another package ealier  
            $TokenPost->package_plan = $postPlan;
            $TokenPost->balance = $token_post;
            $TokenPost->subscribe_date = $now;
            $TokenPost->expired_date = $expired_date;
            $TokenPost->created_at = $now;
            $TokenPost->save();

            $TokenResume->package_plan = $resumePlan;
            $TokenResume->balance = $token_resume;
            $TokenResume->subscribe_date = $now;
            $TokenResume->expired_date = $expired_date;
            $TokenResume->created_at = $now;
            $TokenResume->save();
        }else{
            //create new
            return 'xmasuk '.$emp_id; 
            EmployerTokenPost::create([
                'employer_id' => $employer->id, 
                'package_plan' => $postPlan, 
                'balance' => $token_post,
                'subscribe_date' => $now, 
                'expired_date' => $expired_date
            ]);
            EmployerTokenResume::create([
                'employer_id' => $employer->id, 
                'package_plan' => $resumePlan, 
                'balance' => $token_resume,
                'subscribe_date' => $now, 
                'expired_date' => $expired_date
            ]);
        }


        $new_count_post = $postPP->token_count+1;
        $postPP->token_count = $new_count_post;
        //$postPP->save(); 

        $new_count_resume = $resumePP->token_count+1;
        $resumePP->token_count = $new_count_resume;
        //$resumePP->save();

        Mail::send(new AlertEmailToEmployerForPackage($user->email, $employer->emp_name));

        return redirect()->route('admin.orders')->with('success', 'Succesfully added token to customer and successfully sent email on '.$employer->emp_name);
    }

    /********************************************/
 

































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
