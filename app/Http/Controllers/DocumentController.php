<?php

namespace App\Http\Controllers;
 
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Storage;

use App\User; 
use App\Model\job_seeker; 
use App\Model\JobSeeker_Experience;
use App\Model\JobSeeker_Education;

use App\Model\Cart_Order;
use App\Model\Cart_Order_Product;
use App\Model\Cart_Product;
use App\Model\employer;


class DocumentController extends Controller
{
	public function getDocument($id){
		$filePath = $id; 
	    // file not found
	    if( ! Storage::exists($filePath) ) {
	      abort(404);
	    }

	    $pdfContent = Storage::get($filePath);

	    // for pdf, it will be 'application/pdf'
	    $type       = Storage::mimeType($filePath);
	    $fileName   = Storage::name($filePath);

	    return Response::make($pdfContent, 200, [
	      'Content-Type'        => $type,
	      'Content-Disposition' => 'inline; filename="'.$fileName.'"'
	    ]);
	}

	public function print(Request $request, $id)
    {    
        if($request->isMethod('get')){
            $seeker = job_seeker::find(decrypt($id));
            $user = User::find($seeker->user_id);
            $experience = JobSeeker_Experience::where('seeker_id', '=', decrypt($id))
                                                ->orderby('level', 'ASC')
                                                ->orderby('exp_toDt', 'DESC')
                                                ->get();
            $education = JobSeeker_Education::where('seeker_id', '=', decrypt($id)) 
                                            ->orderby('level', 'ASC') 
            								->get();

            return view('print.seeker', compact('seeker', 'education', 'experience', 'user'));  
        }
    }

    public function list_invoice(){

		$orders = Cart_Order::where('employer_id', '=', Auth::guard('employer')->user()->employer[0]->id)
							->orderby('created_at', 'desc')
							->get();
    	return view('employer.cart.list_invoice', compact('orders', 'order_product', 'product', 'emp'));
    }

    public function invoice($date){
		$order = Cart_Order::where('employer_id', '=', Auth::guard('employer')->user()->employer[0]->id)
							->where('created_at', '=', str_replace('_', ' ', $date))
							->first();
		$order_product = Cart_Order_Product::where('cart__order_id', '=', $order->id)->first();
		$product = Cart_Product::find($order_product->cart__product_id);

		$emp = employer::find(Auth::guard('employer')->user()->employer[0]->id);
    	return view('employer.cart.invoice', compact('order', 'order_product', 'product', 'emp'));
    }
}
