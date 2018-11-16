<?php

namespace App\Http\Controllers\AuthEmployer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

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
    } 

    public function employerLogout()
    {
        Auth::guard('employer')->logout();  
        //return $this->loggedOut($request) ?: redirect('/');
        return redirect('/employer/home');
    }
}
