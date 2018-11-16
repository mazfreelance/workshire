<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input; 

use App\Model\Cart_Product;
use App\Model\Poskod;

class HomeController extends Controller
{ 
    public function pricePLAN(Request $request)
    {   
        $Products = Cart_Product::all(); 
        return view('employer.price', compact('Products'));
    } 

    public function poskod(Request $request)
    {   
    	$zip = $request->input('zip');
    	$token = $request->input('_token');
    	return Poskod::whereRaw('posod LIKE "%'.$zip.'%"')->first(); 
    } 
}
