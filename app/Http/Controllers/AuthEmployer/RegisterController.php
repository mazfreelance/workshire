<?php

namespace App\Http\Controllers\AuthEmployer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use App\User_Employer;
use App\Model\employer;
use App\Model\Notification_Employer;
use App\Model\VerifyUserEmployer;
use App\Mail\VerifyMailEmployer;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function showRegistrationForm()
    {
        return view('authEmployer.register');
    }

    public function __construct()
    {
        $this->redirectTo = route('employer.dashboard');
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {    
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'ssm_no' => 'required|string|max:255|unique:employers,emp_regno',
            'email' => 'required|string|email|max:255|unique:users_employer',
            'password' => 'required|string|min:6|confirmed',
            'subs' => 'required',
        ]); 
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {   
        $user = User_Employer::create([ 
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        employer::create([ 
            'users_id' => $user->id,
            'emp_name' => $data['name'],
            'emp_regno' => $data['ssm_no'],
        ]);

        Notification_Employer::create([
            'user_id' => $user->id,
            'job_alert' => $data['job_alert'], 
            'profile_remind' => $data['profile_remind'], 
            'promo_alert' => $data['promo_alert']
        ]);
        VerifyUserEmployer::create([
            'user_id' => $user->id,
            'token' => str_random(40)
        ]);

        Mail::to($user->email)->send(new VerifyMailEmployer($user));
        
        return $user;
        
        //return dd($data);
    }

    //verify account 
    public function verifyUser($token)
    {
        $verifyUser = VerifyUserEmployer::where('token', $token)->first();
        if(isset($verifyUser) ){
            $user = $verifyUser->user;
            if(!$user->verified) {
                $verifyUser->user->verified = 1;
                $verifyUser->user->save();
                $status = "Your e-mail is verified. You can now login.";
            }else{
                $status = "Your e-mail is already verified. You can now login.";
            }
        }else{
            return redirect('/employer/login')->with('warning', "Sorry your email cannot be identified.");
        }

        return redirect('/employer/login')->with('status', $status);
    }


    protected function registered(Request $request, $user)
    {
        //Auth::guard('employer')->logout();  
        $this->guard()->logout();
        return redirect('/employer/login')->with('status', 'We sent you an activation code. Check your email and click on the link to verify.');
    }
}
