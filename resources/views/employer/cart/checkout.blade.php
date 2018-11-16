@extends('layouts.master_emp')

@section('title', 'Package')

@section('content')  
<style> 
.btnPAY {
    position: relative;
    margin-bottom: 0;
}
.btnPAY:focus {
    -moz-outline-style:none;
    outline:medium none;
}
.btnPAY:active, .btnPAY.active {
    top: 4px;
    border: 0;
    position: relative;
}
</style>
<script>   
function loadpage()
{ 
  location.reload();
    //setTimeout(loadpage, 50);
} 

$(document).ready(function(){
    $('#paypalbtn').hide(); 
    $('#fpxbtn').hide(); 

    $(':radio[id=paypal]').change(function(){
        $('#paypalbtn').show();
        $('#fpxbtn').hide(); 
        $('#cashbtn').hide(); 
    });

    $(':radio[id=cash]').change(function(){
        $('#paypalbtn').hide();
        $('#fpxbtn').hide(); 
        $('#cashbtn').show(); 
    });

    $(':radio[id=fpx]').change(function(){
        $('#paypalbtn').hide();
        $('#fpxbtn').show(); 
        $('#cashbtn').hide(); 
    });
});
</script>
  
<section class="info-section pricing py-5">
    <div class="container">
        <div class="head-box text-center my-5"></div>
                
        <div class="row bg-light mx-1" style="border-radius:15px;">   
            <div class="col-12"> 

                <nav aria-label="breadcrumb" class="mt-2">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('employer.main')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <i class="fa fa-credit-card" aria-hidden="true"></i> Check Out
                    </li>
                  </ol>
                </nav> 
 
                @if ($message = Session::get('destroy'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ $message }}</strong>
                </div>
                @endif  
                <form action="{{route('employer.checkout.post')}}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="shopper-informations">
                        <div class="row">
                            <div class="col-sm">
                                <div class="shopper-info">
                                    <h5>Shopper Information</h5>
                                    <div class="form-row">
                                        <div class="col-md mb-3">
                                            <label for="fullname">Display Name</label>  

                                            <input type="text" name="fullname" id="fullname"s class="form-control"  
                                            value="{{ old('fullname')!=''? old('fullname') : $employer->emp_ctc_person}}">
                                            <span style="color:red">{{ $errors->first('fullname') }}</span>
                                            <hr style="margin:0.5em 0 -0.5em 0">
                                        </div> 
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-4 mb-3">
                                            <label for="city">City Name</label> 

                                            <input type="text" name="city" id="city" class="form-control" 
                                            value="{{ old('city')!=''? old('city') : $employer->emp_city}}">
                                            <span style="color:red">{{ $errors->first('city') }}</span>
                                            <hr style="margin:0.5em 0 -0.5em 0" class="d-lg-none">
                                        </div> 
                                        <div class="col-md-4 mb-3">
                                            <label for="pincode">Postcode</label> 

                                            <input type="text" name="pincode" id="pincode" class="form-control" 
                                            value="{{ old('pincode')!=''? old('pincode') : $employer->emp_zipcode}}">
                                            <span style="color:red">{{ $errors->first('pincode') }}</span>
                                            <hr style="margin:0.5em 0 -0.5em 0" class="d-lg-none">
                                        </div> 
                                        <div class="col-md-4 mb-3">
                                            <label for="state">Country Name</label> 
 
                                            <select name="state" class="form-control" >
                                                <option value="{{ old('state')!=''? old('state') : $employer->emp_state}}" selected="selected">Select state</option>
                                                <option value="United States">United States</option>
                                                <option value="Bangladesh">Bangladesh</option>
                                                <option value="UK">UK</option>
                                                <option value="India">India</option>
                                                <option value="Pakistan">Pakistan</option>
                                                <option value="Ucrane">Ucrane</option>
                                                <option value="Canada">Canada</option>
                                                <option value="Dubai">Dubai</option>
                                            </select>
                                            <span style="color:red">{{ $errors->first('state') }}</span>
                                            <hr style="margin:0.5em 0 -0.5em 0" class="d-lg-none"> 
                                        </div> 
                                    </div> 
                                    <hr style="margin:0.2em 0 -0.1em 0"  class="d-none d-lg-block">     
                                </div>
                            </div>  
                        </div>
                    </div>

                    <?php // form end here?>

                    <div class="review-payment">
                        <h2>Review & Payment</h2>
                    </div>

                    <div class="table-responsive cart_info">
                        <table class="table table-condensed">
                            <thead>
                                <tr class="cart_menu"> 
                                    <th>Item</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th> 
                                    <th>Action</th> 
                                </tr>
                            </thead>
                            <tbody>
                                @if(!$cartItems->isEmpty())
                                    @foreach($cartItems as $cartItem)
                                    <tr> 
                                        <td class="cart_description w-100">
                                            <h4><a href="">{{$cartItem->name}} package</a></h4>
                                            Item ID: <p class="d-inline">{{$cartItem->id}}</p>
                                            <span class="d-block">Duration: 
                                                <p class="d-inline">{{$cartItem->options->duration}}</p>
                                            </span>
                                            <span class="d-block">Description: 
                                                <p>{{str_replace('|', ', ', $cartItem->options->description)}}</p>
                                            </span>
                                        </td>
                                        <td class="cart_price">
                                            <p>RM{{$cartItem->price}}</p>
                                        </td>
                                        <td class="cart_quantity">
                                            <div class="cart_quantity_button">
                                                <span>{{$cartItem->qty}}</span>
                                                <input class="cart_quantity_input" type="hidden" value="{{$cartItem->qty}}" 
                                                readonly="readonly" size="6"/> 
                                            </div>
                                        </td>
                                        <td class="cart_total">
                                            <p class="cart_total_price">RM{{$cartItem->subtotal}}</p>
                                        </td>
                                        <td class="cart_delete">
                                            <a class="cart_quantity_delete" href="{{url('/employer/cart/remove')}}/{{$cartItem->rowId}}">
                                                <i class="fa fa-times-circle"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5">
                                            No item in the cart found. Click <a href="{{route('employer.pricing')}}">here</a> for buy the package.
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <td colspan="3">&nbsp;</td>
                                    <td colspan="2">
                                        <table class="table table-condensed total-result">
                                            <tr>
                                                <td>Cart Sub Total</td>
                                                <td>{{Cart::subtotal()}}</td>
                                            </tr>
                                            <tr>
                                                <td> Tax</td>
                                                <td>${{Cart::tax()}}</td>
                                            </tr>
                                            <tr class="shipping-cost">
                                                <td>Shipping Cost</td>
                                                <td>Free</td>
                                            </tr>
                                            <tr>
                                                <td>Total</td>
                                                <td><span>${{Cart::total()}}</span></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                    <div class="review-payment">
                        <h5 class="font-weight-bold">Payment Method</h5>
                    </div>
                    <div class="payment-options">  
                        @if(Cart::count() > 0)
                        <div class="custom-control custom-radio custom-control">
                          <input type="radio" id="cash" name="pay" class="custom-control-input" value="COD" checked/>
                          <label class="custom-control-label" for="cash">CASH</label>
                        </div>
                        <div class="custom-control custom-radio custom-control">
                          <input type="radio" id="paypal" name="pay" class="custom-control-input" value="paypal"/>
                          <label class="custom-control-label" for="paypal">PAYPAL</label>
                        </div> 
                        <div class="custom-control custom-radio custom-control">
                          <input type="radio" id="fpx" name="pay" class="custom-control-input" value="fpx"/>
                          <label class="custom-control-label" for="fpx">FPX</label>
                        </div> 

                        <div class="d-block my-2"> 
                            <button type="submit" id="cashbtn" class="btn-primary btn-sm btnPAY">
                                <i class="fas fa-money-bill-alt"></i> CASH
                            </button>
                            <button id="fpxbtn" class="btn-primary btn-sm btnPAY" disabled>
                                <i class="fas fa-money-bill-alt"></i> Coming Soon
                            </button> 
                            @include('employer.cart.paypal')  
                        </div>  
                        @else
                            <div class="d-block my-2 font-italic">Your payment will not proceed untill you choose package first.</div>
                        @endif
                    </div>
                </form>
 
            </div>   
        </div>   
    </div>
</section>  
@endsection
