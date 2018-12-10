@extends('layouts.master_emp')

@section('title', 'Thank you')

@section('content')  
@section('js')
<script>
    $( document ).ready(function() {
        
    }); 
</script>
@endsection
<section class="info-section pricing py-5">
    <div class="container py-4">
        <div class="head-box text-center my-5"></div>
                
        <div class="row bg-light mx-1" style="border-radius:15px;">   
            <div class="col-12"> 

                <nav aria-label="breadcrumb" class="mt-2">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('employer.main')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <i class="fa fa-credit-card" aria-hidden="true"></i> Successfully Paid
                    </li>
                  </ol>
                </nav> 
 
				<div class="card bg-light mb-3" style="max-width: 18rem;">
				  	<div class="card-header">Redirect from payment gateway</div>
			  		<div class="card-body">
			    		<h5 class="card-title">Thank you, {{Auth::guard('employer')->user()->employer[0]->emp_name}}</h5>
			    		<p class="card-text">
			    			Your order has been placed. Our team will accept your order as soon as possible.
			    			Thank you using the services that provided.
			    		</p>
                        <button class="btn btn-success btn-md" data-toggle="tooltip" data-placement="top" title="" onClick="location.href='{{route('employer.invoice')}}'">See invoice</button> 
    			  		</div>
				</div>

    		</div>
    	</div>
    </div> 
</section>
@endsection