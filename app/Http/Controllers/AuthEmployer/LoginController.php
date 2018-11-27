<?php

namespace App\Http\Controllers\AuthEmployer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Mail;

use App\Mail\VerifyMailEmployer;
use App\User_Employer;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */ 
    protected $redirectTo;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {   
        if(Auth::guard('employer')->check()){
            $this->redirectTo = route('employer.dashboard'); 
        }
         
        $this->middleware('guest:employer')->except(['logout', 'employerLogout']);
    }

    public function showLoginForm()
    {
        return view('authEmployer.login');
    }
    /*
    public function EmployerLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        $credential = [
            'email' => $request->email,
            'password' => $request->password
        ];
        // Attempt to log the user in
        if (Auth::guard('employer')->attempt($credential, $request->member)){
            // If login succesful, then redirect to their intended location
            return redirect()->intended(route('employer.dashboard'));
        }
        // If Unsuccessful, then redirect back to the login with the form data
        return redirect()->back()->withInput($request->only('email', 'remember'));
    } */
    public function EmployerLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        $credential = [
            'email' => $request->email,
            'password' => $request->password
        ];
        // Attempt to log the user in
        if (Auth::guard('employer')->attempt($credential, $request->member)){
            // If login succesful, then redirect to their intended location
            $user = Auth::guard('employer')->user();
            //return dd($user->verified);
            if (!$user->verified) {
                Auth::guard('employer')->logout();
                Mail::to($user->email)->send(new VerifyMailEmployer($user));
                return back()->with('warning', 'You need to confirm your account. We have sent you an activation code, please check your email.');
            }  
            //dd(redirect()->intended( $this->redirectPath() )); 
            if(!$user->complete){ 
                return redirect()->intended(route('employer.account.complete'));
            } 
            return redirect()->intended(route('employer.dashboard'));
        }    
        // If Unsuccessful, then redirect back to the login with the form data
        return redirect()->back()->withInput($request->only('email', 'remember')); 
    }

    public function employerLogout()
    {
        Auth::guard('employer')->logout();  
        //return $this->loggedOut($request) ?: redirect('/');
        return redirect('/employer/home');
    }
 
}
