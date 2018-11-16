<?php

namespace App\Http\Controllers\Employer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Model\employer;
use App\Model\Message;

class MessageController extends Controller
{
    public function message()
   	{
   		$msgs = Message::where('users_id', '=', Auth::guard('employer')->user()->employer[0]->id)
   					 	->orderBy('created_at', 'DESC')
   					 	->get();

   		return view('message.template', compact('msgs'));
 
   	}
}
