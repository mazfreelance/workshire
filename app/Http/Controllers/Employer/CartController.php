<?php

namespace App\Http\Controllers\Employer;

use Illuminate\Support\Facades\DB;
use Gloudemans\Shoppingcart\Facades\Cart; // for cart lib
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Model\Cart_Product;

class CartController extends Controller
{	
	public function index(){
        $cartItems = Cart::content();
        return view('employer.cart.index', compact('cartItems'));

    }

    public function addItem(Request $request, $id){ 
        $products = Cart_Product::find($id); // get prodcut by id
        if(isset($request->newPrice))
        {
          $price = $request->newPrice; // if size select
        }
        else{
          $price = $products->price; // default price
        } 
        Cart::add($id,$products->name,1,$price,['duration' => $products->duration,'description' => $products->description]);  
     	
     	return back(); // will keep same page
    }

    public function update(Request $request)
    {
        $qty = $request->qty;
      	$proId = $request->proId;
	   	$rowId = $request->rowId;
	    Cart::update($rowId,$qty); // for update
	    $cartItems = Cart::content(); // display all new data of cart
	    //return view('cart.upCart', compact('cartItems'))->with('status', 'cart updated');
	    return back()->with('update', 'Price updated successfully!');

	    /*  $products = products::find($proId);
	      $stock = $products->stock;
	      if($qty<$stock){
	          $msg = 'Cart is updated';
	         Cart::update($id,$request->qty);
	         return back()->with('status',$msg);
	      }else{
	           $msg = 'Please check your qty is more than product stock';
	            return back()->with('error',$msg);
	      }        */ 
  	}

    public function destroy($id){
        Cart::remove($id);
        return back()->with('destroy', 'Items deleted successfully'); // will keep same page 
    }
}
