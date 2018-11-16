<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use App\Mail\VerifyMailSeeker;
use Socialite;
use App\User;

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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        //if(Auth::guard('web')->check()){
            //$this->redirectTo = route('seeker.profile'); 
        //} 
        $this->middleware('guest')->except(['logout', 'userLogout']);
    }

    public function username()
    {
        $loginType = request()->input('username');
        $this->username = filter_var($loginType, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        request()->merge([$this->username => $loginType]);

        return property_exists($this, 'username') ? $this->username : 'email'; 
    }

 
    public function userLogout(Request $request)
    {
        Auth::guard('web')->logout();
        return redirect('/');
    }


    public function socialLogin($social) {
        return Socialite::driver($social)->redirect();
    }

    public function handleProviderCallback($social){
        $userSocial = Socialite::driver($social)->user();
        /*  
            data:
            $userSocial->getId(); // Do not send to your backend! Use an ID token instead. 
            $userSocial->getEmail();
            $userSocial->getName();
            $userSocial->getImageUrl(); // This is null if the 'email' scope is not present.
        */  
        $user = User::where(['email' => $userSocial->getEmail()])->first();
        if ($user) {
            Auth::guard('web')->login($user);
            return redirect()->intended( $this->redirectPath() ); //->action('Seeker\DashboardController@index');
        } else {
            return view('auth.register', ['name' => $userSocial->getName(),'email'=> $userSocial->getEmail()]);
        }
    }  

    //verify account
    protected function authenticated(Request $request, $user)
    {
       if (!$user->verified) {
            auth()->logout();
            Mail::to($user->email)->send(new VerifyMailSeeker($user));
            return back()->with('warning', 'You need to confirm your account. We have sent you an activation code, please check your email.');
        } 

        //dd(redirect()->intended( $this->redirectPath() )); 
        if(!$user->complete) { 
            return redirect()->intended(route('seeker.account.complete'));
        }
        return redirect()->intended( $this->redirectPath() ); //$this->redirectTo
    }
}
