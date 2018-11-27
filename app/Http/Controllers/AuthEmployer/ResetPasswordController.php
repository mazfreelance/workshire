<?php

namespace App\Http\Controllers\AuthEmployer;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;  

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;
 
use App\User_Employer;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {   
        $this->redirectTo = route('employer.dashboard'); 
        $this->middleware('guest:employer');
    }

     public function guard()
    {
        return Auth::guard('employer');
    }

    public function broker(){
        return Password::broker('employers');
    }

    public function showResetForm(Request $request, $token = null){
        return view('authEmployer.passwords.reset')
             ->with(['token' => $token, 'email' => $request->email]);
    } 
}
