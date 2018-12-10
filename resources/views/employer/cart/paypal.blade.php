
<input type="hidden" name="cmd" value="_cart">
<input type="hidden" name="upload" value="1">
<input type="hidden" name="business" value="hardeephp@yahoo.com">

<?php $count =0;?>
@foreach($cartItems as $cartItem)
<?php $count++; ?>
<input type="hidden" name="item_name_{{$count}}" value="{{$cartItem->name}}">
<input type="hidden" name="item_number_{{$count}}" value="{{$cartItem->id}}">
<input type="hidden" name="quantity_{{$count}}" value="{{$cartItem->qty}}">
<input type="hidden" name="amount_{{$count}}" value="{{$cartItem->price}}">
<input type="hidden" name="shipping_{{$count}}" value="0.00">

<input type="hidden" name="tax_{{$count}}" value="{{Cart::tax()}}">

<!-- after payment -->
<input type="hidden" name="return" id="return" value="http://localhost/whfw/index.php/employer/thankyou" />
<!-- Cancel payment -->
<input type="hidden" name="cancel_return" id="cancel_return" value="http://localhost/whfw/index.php/employer/checkout" />
@endforeach

 
<button type="submit" name="submit" id="paypalbtn" value="PayPal" class="btn-primary btn-sm btnPAY" formaction="https://www.paypal.com/cgi-bin/webscr" disabled><i class="fab fa-paypal"></i> Paypall (Coming Soon)</button>
