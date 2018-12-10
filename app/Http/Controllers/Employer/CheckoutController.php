<?php

namespace App\Http\Controllers\Employer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Http\Controllers\Controller;
 
use App\Model\employer; 
use App\Model\Cart_Order;

class CheckoutController extends Controller
{  
   	public function index() { 
      	$cartItems = Cart::content(); 
      	$employer = employer::where('users_id', '=', Auth::guard('employer')->user()->id)->first();
        return view('employer.cart.checkout', compact('cartItems', 'employer')); 
    }

    public function checkout_post(Request $request){

        $this->validate($request, [
            'fullname' => 'required|min:5|max:35',
            'pincode' => 'required|numeric',
            'city' => 'required|min:5',
            'state' => 'required',
            'receipt_bank' => 'required|mimes:jpeg,bmp,png,jpg']);
        
        Cart_Order::createOrder($request); 
        Cart::destroy();

        return redirect('employer/thankyou');
        /*
        $address = new Cart_Address;
        $address->name = $request->fullname;
        $address->state = $request->state;
        $address->city = $request->city;  
        $address->employer_id = $userid;
        $address->pincode = $request->pincode;
        $address->payment_type = $request->pay;
        $address->created_at = date('Y-m-d H:i:s');
        $address->save(); */
    }
}
