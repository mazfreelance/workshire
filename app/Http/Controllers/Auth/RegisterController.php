<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request; 


use App\User;
use App\Model\job_seeker;
use App\Model\Notification_Seeker;
use App\Model\VerifyUser;
use App\Mail\VerifyMailSeeker;

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
    public function __construct()
    { 
        $this->redirectTo = route('main');  
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
        Validator::extend('valid_username', function($attr, $value){ 
            return preg_match('/^(?=.*[a-z])(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])/', $value); 
        });  
        /*return Validator::make($data, [  
            'username' => 'required|valid_username',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]); */

        $rules = [
            'username' => 'required|valid_username|unique:users',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'survey' => 'required',
            'other_survey' => 'required_if:survey,==,Others', 
            'subs' => 'required',
            'schedule' => 'required_if:subs,==,Y',
        ];
        $message = [  
            'username.valid_username'=>'<ul style="list-style:none" class="ml-0">
                                        <li>Username field must contain: <ol><li>at least one(1) lowercase alphabetical character</li><li>at least one(1) uppercase alphabetical character</li><li>at least one(1) numeric character</li><li>example: User123</li></ol></li>
                                        </ul>',
            'other_survey.required'=>'The other of survey field is required.'
        ]; 
        //return dd($rules);
        return $validator = Validator::make($data, $rules, $message);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {    
        //dd($data); 
        $user = User::create([
            'username' => $data['username'],
            'email' => $data['email'], 
            'password' => Hash::make($data['password']),
        ]);  
        job_seeker::create([
            'user_id' => $user->id,
            'seeker_name' => $data['name'], 
            'seeker_survey_list' => $data['survey'], 
            'seeker_survey_others' => $data['other_survey']
        ]);
        Notification_Seeker::create([
            'user_id' => $user->id,
            'job_alert' => $data['job_alert'], 
            'profile_remind' => $data['profile_remind'], 
            'promo_alert' => $data['promo_alert']
        ]);
        VerifyUser::create([
            'user_id' => $user->id,
            'token' => str_random(40)
        ]);

        Mail::to($user->email)->send(new VerifyMailSeeker($user));

        return $user; 
        
        //return User::createNewUser($data); 
    }

    //verify account 
    public function verifyUser($token)
    {
        $verifyUser = VerifyUser::where('token', $token)->first();
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
            return redirect('/login')->with('warning', "Sorry your email cannot be identified.");
        }

        return redirect('/login')->with('status', $status);
    }


    protected function registered(Request $request, $user)
    {
        $this->guard()->logout();
        return redirect('/login')->with('status', 'We sent you an activation code. Check your email and click on the link to verify.');
    }
}
