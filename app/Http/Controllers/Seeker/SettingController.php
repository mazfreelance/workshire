<?php

namespace App\Http\Controllers\Seeker;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use App\User;
use App\Model\Notification_Seeker;

class SettingController extends Controller
{
	public function __construct()
    {
        
    }
    
    public function showAccount()
    {     
        $email = Auth::user()->email;
        $username = Auth::user()->username;
    	return view('setting.account', compact('email', 'username'));
    }

    public function updateAcc(Request $request)
    {       
        Validator::extend('valid_username', function($attr, $value){ 
            return preg_match('/^(?=.*[a-z])(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])/', $value); 
        }); 

        $rules = [
          'username' => 'required|valid_username|unique:users'
        ];
        $message = [ 
            'username.required'=>'The username field is required.',
            'username.valid_username'=>'<ul style="list-style:none" class="ml-0">
                                        <li>Username field must contain: <ol><li>at least one(1) lowercase alphabetical character</li><li>at least one(1) uppercase alphabetical character</li><li>at least one(1) numeric character</li><li>example: User123</li></ol></li>
                                        </ul>'
        ]; 

        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails())
        return response()->json([
          'fail' =>true, 
          'errors' => $validator->errors()
        ]); 

        $user = User::find(Auth::guard('web')->user()->id);
        $user->username = $request->username;
        $user->save();
        
        //return back()->with('success', 'Successfully updated your account.');
        return response()->json([
          'fail' =>false, 
          'redirect_url' => 'setting'
        ]); 
    }

    public function showPassword()
    {
        return view('setting.password');
    } 

    public function updatePass(Request $request)
    {    
        Validator::extend('valid_password', function($attr, $value){ 
            return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{6,})/', $value); 
        }); 
        Validator::extend('passwordNotSame', function($attribute, $value, $parameters, $validator) {
            return Hash::check($value, Auth::user()->password);
        });
        $rules = [
          'newpass' => 'required|valid_password',
          'confirmnewpass' => 'required|same:newpass'

        ];
        $message = [ 
            'newpass.required'=>'The new password field is required.',
            'newpass.valid_password'=>'<ul style="list-style:none" class="ml-0">
                                        <li>Password field must contain: <ol><li>at least one(1) lowercase alphabetical character</li><li>at least one(1) uppercase alphabetical character</li><li>at least one(1) numeric character</li><li>at least six(6) characters or longer</li><li>eg: Password123</li></ol></li>
                                        </ul>'
        ]; 

        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails())
        return response()->json([
          'fail' =>true, 
          'errors' => $validator->errors()
        ]); 

        $user = User::find(Auth::guard('web')->user()->id);
        $user->password = Hash::make($request->newpass);
        $user->save();
        return response()->json([
          'fail' =>false, 
          'redirect_url' => 'password'
        ]); 
    }
    //$2y$10$HqjgoUV.Cb4LrKZVqmE13e63QODf1YNQyWcrANXmDv.hc0yZIpBXy
    public function notification()
    {
        $noti = Notification_Seeker::where('user_id', '=', Auth::guard('web')->user()->id)->first();
        return view('setting.notification', compact('noti'));
    }
}
