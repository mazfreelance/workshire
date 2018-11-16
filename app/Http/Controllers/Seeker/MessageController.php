<?php

namespace App\Http\Controllers\Seeker;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Message;

class MessageController extends Controller
{
    public function index()
   	{
   		$msgs = new Message();
   		$msgs = $msgs->where('users_id', '=', Auth::user()->seeker->id)
   					 ->orderBy('created_at', 'DESC')
   					 ->get();

   		return view('message.template', compact('msgs'));
 
   	}
}
