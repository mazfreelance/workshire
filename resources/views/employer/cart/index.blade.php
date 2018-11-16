@extends('layouts.master_emp')

@section('title', 'Package')

@section('content') 
<script>  
function hideMessage()
{
    // hideMessage() : hides the system message bar 
    $('#alert').hide().html("");
    setTimeout(loadpage, 50);
}
function loadpage()
{ 
  location.reload();
}
function openCart()
{ 
  $('#AddCartModal').modal('show');    
}  
function deleteItemCart(id)
{
  // addToCart() : add an item to the cart
  // PARAM id : product id     
  $.ajax({
    url: '{{url('employer/cart/remove')}}/'+id,
    type: "get"
  }).done(function(){
    $('#alert').html("Item deleted successfully!").show();
    setTimeout(hideMessage, 2000);
  });  
}   

 
$(document).ready(function() {

    /** SHOPPING CART START **/     
    /* Set rates + misc */
    var taxRate = 0.05;
    var shippingRate = 0.00; 
    var fadeTime = 300;
     
     
    /* Assign actions */ 
    $('.product-quantity input').on('change', function(){ 
        updateQuantity(this);
    });
    $('.updNewPrice').on('click', function(){ 
        updatePrice(this);
    });
    /* Update quantity */
    function updateQuantity(quantityInput)
    {
      /* Calculate line price */
      var productRow = $(quantityInput).parent().parent();
      var price = parseFloat(productRow.children('.product-price').text());
      var quantity = $(quantityInput).val();
      var linePrice = price * quantity;
        
      /* Update line price display and recalc cart totals */
      productRow.children('.product-line-price').each(function () {
        $(this).fadeOut(fadeTime, function() {
            $(this).text(linePrice.toFixed(2));
            //recalculateCart();
            $(this).fadeIn(fadeTime);
        });
      });  
    }
    
    /* Update price */
    function updatePrice(id)
    {   
        var idData = $(id).attr('data');
        var qty = $('.product-quantity input').val();
        var data = idData+'&qty='+qty+'&_token={{csrf_token()}}';
        $.ajax({
            type: 'get', 
            url: '{{route('employer.update')}}',
            data: data,
            success: function (response) {
                //console.log(response); 
                setTimeout(loadpage, 50);
            }
        }); 
    }   
     
    /* Recalculate cart */
    function recalculateCart()
    {
      var subtotal = 0;
       
      /* Sum up row totals */
      $('.product').each(function () {
        subtotal += parseFloat($(this).children('.product-line-price').text());
      });
       
      /* Calculate totals */
      var tax = subtotal * taxRate;
      var shipping = (subtotal > 0 ? shippingRate : 0);
      var total = subtotal + tax + shipping;
       
      /* Update totals display */
      $('.totals-value').fadeOut(fadeTime, function() {
        $('#cart-subtotal').html(subtotal.toFixed(2));
        $('#cart-tax').html(tax.toFixed(2));
        $('#cart-shipping').html(shipping.toFixed(2));
        $('#cart-total').html(total.toFixed(2));
        if(total == 0){
          $('.checkout').fadeOut(fadeTime);
        }else{
          $('.checkout').fadeIn(fadeTime);
        }
        $('.totals-value').fadeIn(fadeTime);
      });
    }  
    /** SHOPPING CART END **/  
});
</script>


@if($cartItems->isEmpty())
    <section class="info-section pricing py-5">
        <div class="container">
            <div class="head-box text-center my-5"></div>
            <div class="alert alert-success" role="alert" id="alert" style="display:none;"></div>
            <div class="row bg-light mx-1" style="border-radius:15px;"> 
                <div class="col-12">  

                    <nav aria-label="breadcrumb" class="mt-2">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('employer.main')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i> Shopping Cart
                        </li>
                      </ol>
                    </nav> 

                    <div class="row d-sm-flex justify-content-center ml-sm-4 mt-2">
                        <button class="btn btn-md btn-primary" onClick="location.href='{{route('employer.pricing')}}'">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i> Continue Shopping
                        </button>
                    </div>
                    <div class="row d-sm-flex justify-content-center">
                        <img src="{{asset('public/images/icon/empty-cart.png')}}"/>
                    </div>
                </div> 
            </div>
        </div>
    </section> 
@else
    <section class="info-section pricing py-5">
        <div class="container">
            <div class="head-box text-center my-5"></div>
                    
            <div class="row bg-light mx-1" style="border-radius:15px;">   
                <div class="col-12"> 

                    <nav aria-label="breadcrumb" class="mt-2">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('employer.main')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i> Shopping Cart
                        </li>
                      </ol>
                    </nav> 

                    <div class="alert alert-success alert-block" role="alert" id="alert" style="display:none;"></div>
                    @if ($message = Session::get('destroy'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                            <strong>{{ $message }}</strong>
                    </div>
                    @endif

                    <div class="shopping-cart mt-2 mx-2 px-3 py-3"> 
                        <div class="column-labels">
                            <label class="product-details">Product</label>
                            <label class="product-price">Price</label>
                            <label class="product-quantity">Quantity</label>
                            <label class="product-line-price">Total</label>
                            <label class="product-removal">Action</label>
                        </div>
                        @foreach($cartItems as $cartItem) 
                        <div class="product"> 
                            <div class="product-details">
                              <div class="product-title h5 text-primary">{{$cartItem->name}}</div> 
                              <p class="product-description text-justify"> 
                                <span class="d-block"><scan class="font-weight-bold">Product ID:</scan> 
                                    {{$cartItem->id}}
                                </span>
                                <span class="d-block"><scan class="font-weight-bold">Description:</scan> 
                                    {{str_replace('|', ', ', $cartItem->options->description)}}
                                </span>
                                <span class="d-block"><scan class="font-weight-bold">Duration:</scan> 
                                    {{$cartItem->options->duration}}
                                </span>
                              </p>
                            </div>
                            <div class="product-price">{{$cartItem->price}}</div>
                            <div class="product-quantity">
                              <input type="number" value="{{$cartItem->qty}}" min="1">
                            </div>
                            <div class="product-line-price">{{number_format($cartItem->price * $cartItem->qty, 2)}}</div>
                            <div class="product-removal">
                                <button class="remove-product"  
                                        onClick="deleteItemCart('{{$cartItem->rowId}}')">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                        @endforeach  
                    </div> 
                </div>
                <div class="col-12"> 
                    <h3 class="text-sm-center">What would you like to do next?</h3>
                    <p class="text-sm-center">Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
                    <div class="row"> 
                        <div class="col-sm text-sm-center"> 
                            <ul style="list-style:none;">
                                <li>Cart Sub Total: <span class="totals-value" id="cart-subtotal">{{Cart::subtotal()}}</span></li>
                                <li>Gov Tax (SST 6%): <span class="totals-value" id="cart-tax">{{Cart::tax()}}</span></li>
                                <li>Shipping Cost: <span class="totals-value" id="cart-shipping">0.00</span></li>
                                <li>Coupon code:
                                    <span class="font-italic">Coming soon</span>
                                </li> 
                                <li>Grand Total: <span class="totals-value" id="cart-total">{{Cart::total()}}</span></li>
                                <li> 
                                    <button class="btn btn-md btn-info updNewPrice"
                                            data="&rowId={{$cartItem->rowId}}&proId={{$cartItem->id}}">
                                        Update
                                    </button>
                                    @if(Cart::count() > 0)
                                    <button class="btn btn-md btn-warning" onClick="location.href='{{route('employer.checkout')}}'">Check Out</button> 
                                    @else
                                    <button class="btn btn-md btn-primary" onClick="location.href='{{route('employer.pricing')}}'">
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i> Continue Shopping
                                    </button>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>  
            </div> 
        </div>
    </section> 
@endif
@endsection
