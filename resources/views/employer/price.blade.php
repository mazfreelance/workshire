@extends('layouts.master_emp')

@section('title', 'Package')

@section('content')   

<section class="info-section pricing py-5">
  <div class="container">
    <div class="head-box text-center my-5">
        <h2>Find the package that works for you.</h2> 
    </div>
      <div class="alert alert-success" role="alert" id="alert" style="display:none;"></div>
    <div class="row"> 
      @foreach($Products as $product)
        @if(!($product->name == 'SPECIAL REQUEST' OR $product->name == 'OTHER'))
          <div class="col-lg-4">
            <div class="card mb-5">
              <div class="card-body">
                <h5 class="card-title text-muted text-uppercase text-center">{{$product->name}}</h5>
                <h6 class="card-price text-center">RM {{$product->price}}<span class="period">/{{$product->duration}}</span></h6>
                <hr> 
                <ul class="fa-ul"> 
                  <?php $arrayDesc = explode('|', $product->description) ?>
                  @foreach($arrayDesc as $desc)
                  <li><span class="fa-li"><i class="fas fa-check"></i></span>
                      {!!$desc!!}
                  </li> 
                  @endforeach
                </ul>
                @if($product->name !== 'BASIC')
                  <div class="d-flex justify-content-center">
                    @if(Cart::count() == 0)
                    <button class="btn btn-md btn-success text-uppercase btnCart" onclick="addToCart('{{$product->id}}')">
                      Add to cart
                    </button>
                    @else
                    <div class="alert alert-success">
                      You can buy one package only. Check <span class="font-italic font-weight-bold">View cart</span> to see the items.
                    </div>
                    @endif
                  </div> 
                @else
                  <div class="d-flex justify-content-center">
                    <button class="btn btn-md btn-secondary text-uppercase" style="cursor: not-allowed;" disabled>Add to cart</button>
                  </div> 
                @endif
              </div>
            </div>
          </div>
        @endif 
      @endforeach
      
      @foreach($Products as $product)
        @if($product->name == 'SPECIAL REQUEST' OR $product->name == 'OTHER')
          <div class="col-lg-4">
            <div class="card mb-5">
              <div class="card-body">
                <h5 class="card-title text-muted text-uppercase text-center">{{$product->name}}</h5> 
                <hr> 
                <ul class="fa-ul">
                  <?php $arrayDesc = explode('|', $product->description) ?>
                  @foreach($arrayDesc as $desc)
                  <li><span class="fa-li"><i class="fas fa-check"></i></span>
                      {{$desc}}
                  </li> 
                  @endforeach
                </ul> 
              </div>
            </div>
          </div>
        @endif 
      @endforeach
    </div>
  </div>
</section> 
<!--
    PRICING FAQ INFO
-->  
<!-- Info block 1 -->
<section class="info-section">
    <div class="container">
        <div class="head-box text-center mb-1">
            <h2>Pricing FAQ</h2> 
        </div>
        <div class="three-panel-block mt-4">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="service-block-overlay text-center mb-5 p-lg-3">
                        <i class="fa fa-laptop box-circle-solid mt-3 mb-3" aria-hidden="true"></i>
                        <h3>Does Workshire have a free plan?</h3>
                        <p class="px-4">
                            Workshire has free and paid plans. With the free plan, you can monitor up to two cron jobs. Email and Slack integrations come with the free plan so you can use them as notification channels.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="service-block-overlay text-center mb-5 p-lg-3">
                        <i class="fa fa-thumbs-up box-circle-solid mt-3 mb-3" aria-hidden="true"></i>
                        <h3>How do I upgrade to a paid plan?</h3>
                        <p class="px-4">
                            If you want to upgrade to any of the paid plans you can go to "My Settings > Plans & Billing" page and click on "Upgrade" button. You will see a new popup where you can add your payment details and upgrade to a paid plan. Both plans come with a 7-day trial.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="service-block-overlay text-center mb-5 p-lg-3">
                        <i class="fa fa-ban box-circle-solid mt-3 mb-3" aria-hidden="true"></i>
                        <h3>How can I cancel my subscription?</h3>
                        <p class="px-4">
                            If you want to cancel your paid plan you can go to "My Settings > Plans & Billing" page and click on "Cancel Plan" button. Your plan will be canceled.
                        </p>
                    </div>
                </div> 
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="service-block-overlay text-center mb-5 p-lg-3">
                        <i class="fa fa-usd box-circle-solid mt-3 mb-3" aria-hidden="true"></i>
                        <h3>If I cancel my paid plan will I get a refund?</h3>
                        <p class="px-4">
                            You can cancel your plan anytime but no refunds are provided for your current period.
                        </p>
                    </div>
                </div> 
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="service-block-overlay text-center mb-5 p-lg-3">
                        <i class="fa fa-cog box-circle-solid mt-3 mb-3" aria-hidden="true"></i>
                        <h3>Do Workshire have involve with SST?</h3>
                        <p class="px-4">
                            Yes, Workshire have government tax which is 6%. 
                        </p>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</section>   
@endsection

@section('js')
<script>
function hideMessage()
{ 
  $('#alert').hide().html("");
  setTimeout(loadpage, 50);
}
function loadpage()
{ 
  location.reload();
}
function addToCart(id)
{
  // addToCart() : add an item to the cart
  // PARAM id : product id     
  $.ajax({
    url: '{{url('employer/cart/addItem')}}/'+id,
    type: "get"
  }).done(function(){
    $('.btnCart').hide();
    $('#alert').html("Your package has been added to cart").show();
    setTimeout(hideMessage, 2000);
  });  
}  
</script>
@endsection