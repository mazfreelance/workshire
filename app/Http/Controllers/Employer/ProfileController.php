<?php

namespace App\Http\Controllers\Employer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Model\employer;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:employer'); // (auth:'guards')
    }

    public function index()
    {
    	$employer = employer::where('users_id', '=', Auth::guard('employer')->user()->id)->first();
    	return view('employer.profile', compact('employer'));
    }

    public function complete(){
    	return view('employer.profile.complete');
    }
}
