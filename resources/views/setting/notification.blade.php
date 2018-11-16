@extends('layouts.master')

@section('title', 'Reset Password Settings')

@section('content')     
<main class="py-0 mb-5"> 
	<div class="row my-1 mx-2">
		<div class="col-sm-12 mb-2">
			<h3>Setting</h3>
			<p style="margin-bottom:-0.2em;">You can set your account</p>
		</div>   
		<div class="col-sm-12">  
		  	<div class="row justify-content-around">
			    <div class="col-md-4 border border-dark">
			    	<h5 class="mt-2">You</h5> 
					@include('setting.includes.nav')
			    </div>
			    <div class="col-md-7 mt-sm-0 mt-2 border border-dark"> 
			    	@if(Auth::guard('employer')->check())
					<div class="tab-pane fade {{Request::path() == 'employer/setting/notification' ? 'show active':''}}" id="nav-notification" role="tabpanel" aria-labelledby="nav-notification-tab">
						<h5 class="my-2"><span class="fa fa-bell float-right"></span> Notification</h5> 
						<h6 class="mb-1">Subscriptions</h6>
						<form>  
						  <div class="form-group row"> 
						    <div class="col-sm-12"> 
								<span class="small">I would like to receive Emails updates for: Important notifications on Workshire.com.my products, Job Opportunities, job seeker services & career advice</span>
						    </div>
						    <div class="col-sm-10">
						      <div class="form-check">
						        <input class="form-check-input" type="checkbox" id="gridCheck1">
						        <label class="form-check-label" for="gridCheck1">
						          Emails
						        </label>
						      </div>
						    </div>
						  </div>
						  <div class="form-group row"> 
						    <div class="col-sm-12"> 
								<span class="small">Promotions & special offers</span>
						    </div>
						    <div class="col-sm-10">
						      <div class="form-check">
						        <input class="form-check-input" type="checkbox" id="gridCheck1">
						        <label class="form-check-label" for="gridCheck1">
						          Emails
						        </label>
						      </div>
						    </div>
						  </div>
						  <div class="form-group row">
						    <div class="col-sm-10">
						      <button type="submit" class="btn btn-primary">Update</button>
						    </div>
						  </div>
						</form>
					</div> 
					@else  
					<div class="tab-pane fade {{Request::path() == 'seeker/setting/notification' ? 'show active':''}}" id="nav-notification" role="tabpanel" aria-labelledby="nav-notification-tab">
						<h4 class="my-2"><span class="fa fa-bell float-right"></span> Notification</h4> 
						<h5 class="mb-1">Subscriptions</h5>
						<p class="text-justify">
							I would like to receive Emails updates for: Important notifications on Workshire.com.my products, Job Opportunities, job seeker services & career advice
						</p>
						<form>  
							<div class="form-group row">
							    <div class="col-sm-4">
								    <label for="jobalert">
								    	Job Alerts Email
								    </label>
								</div>
							    <div class="col-sm">
							      	<div class="custom-control custom-radio custom-control-inline">
									  	<input type="radio" id="jobalertsubsid" name="jobalertsubs" class="custom-control-input" value="Y" {{ $noti->job_alert =='Y' ? 'checked':''}}>
									  	<label class="custom-control-label" for="jobalertsubsid">Subscribe</label>
									</div>
									<div class="custom-control custom-radio custom-control-inline">
									  	<input type="radio" id="jobalertunsubs" name="jobalertsubs" class="custom-control-input" value="N" {{ $noti->job_alert =='N' ? 'checked':''}}>
									  	<label class="custom-control-label" for="jobalertunsubs">Unsubscribe</label>
									</div>
							    </div> 
							</div>
							<div class="form-group row">
							    <div class="col-sm-4">
								    <label for="jobalert">
								    	Profile Update Reminders Email
								    </label>
								</div>
							    <div class="col-sm">
							      	<div class="custom-control custom-radio custom-control-inline">
									  	<input type="radio" id="profilealertsubsid" name="profilealertsubs" class="custom-control-input" value="Y" {{ $noti->profile_remind =='Y' ? 'checked':''}}>
									  	<label class="custom-control-label" for="profilealertsubsid">Subscribe</label>
									</div>
									<div class="custom-control custom-radio custom-control-inline">
									  	<input type="radio" id="profilealertunsubs" name="profilealertsubs" class="custom-control-input" value="N" {{ $noti->profile_remind =='N' ? 'checked':''}}>
									  	<label class="custom-control-label" for="profilealertunsubs">Unsubscribe</label>
									</div>
							    </div> 
							</div>
							<div class="form-group row">
							    <div class="col-sm-4">
								    <label for="jobalert">
								    	Receive promotions from Workshire's partners via email
								    </label>
								</div>
							    <div class="col-sm">
							      	<div class="custom-control custom-radio custom-control-inline">
									  	<input type="radio" id="promoalertsubsid" name="promoalertsubs" class="custom-control-input" value="Y" {{ $noti->promo_alert =='Y' ? 'checked':''}}>
									  	<label class="custom-control-label" for="promoalertsubsid">Subscribe</label>
									</div>
									<div class="custom-control custom-radio custom-control-inline">
									  	<input type="radio" id="promoalertunsubs" name="promoalertsubs" class="custom-control-input" value="N" {{ $noti->promo_alert =='N' ? 'checked':''}}>
									  	<label class="custom-control-label" for="promoalertunsubs">Unsubscribe</label>
									</div>
							    </div> 
							</div>
 
						  	<div class="form-group row">
							    <div class="col-sm-10">
							      	<button type="submit" class="btn btn-primary">Update</button>
							    </div>
						  	</div>
						</form>
					</div>  
					@endif
			    </div>
		  	</div> 
		</div> 
	</div> 
</main>
<!-- Footer -->  
@include('includes.footer') 

@endsection