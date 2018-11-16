<?php

namespace App\Model;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model; 
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

use App\Model\Cart_Product;
use App\Model\employer;

class Cart_Order extends Model
{
	protected $table = 'cart_orders';
    protected $fillable = ['total', 'status', 'name', 'payment_method'];

    public function orderFields() {
        return $this->belongsToMany(Cart_Product::class)->withPivot('qty', 'total');
    }

    public static function createOrder(Request $request) {

        // for order inserting to database

        $user = Auth::guard('employer')->user()->id;
        $emp = employer::select('id')->where('users_id', '=', $user)->first();
        $order = $emp->orders()->create(['total' => Cart::total(), 
                                         'status' => 'pending', 
                                         'name' => $request->fullname, 
                                         'payment_method' => $request->pay
                                        ]);

        $cartItems = Cart::content();
        foreach ($cartItems as $cartItem) {
            $order->orderFields()->attach($cartItem->id, ['total' => $cartItem->qty * $cartItem->price, 
                                                          'tax' => Cart::tax(), 
                                                          'qty' => $cartItem->qty, 
                                                          'created_at' => date('Y-m-d H:i:s')
                                                         ]);
        }
    }
}
