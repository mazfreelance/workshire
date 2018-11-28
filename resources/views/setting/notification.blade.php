@extends('layouts.master')

@section('title', 'Notification Settings')

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
						{!! Form::open(['route' => 'employer.setting.notification.edit', 'id' => 'notificationForm']) !!}
							<input type="hidden" name="id" value="{{$noti->id}}">
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
						{!! Form::close() !!}
					</div> 
					@else  
					<div class="tab-pane fade {{Request::path() == 'seeker/setting/notification' ? 'show active':''}}" id="nav-notification" role="tabpanel" aria-labelledby="nav-notification-tab">
						<h4 class="my-2"><span class="fa fa-bell float-right"></span> Notification</h4> 
						<h5 class="mb-1">Subscriptions</h5>
						<p class="text-justify">
							I would like to receive Emails updates for: Important notifications on Workshire.com.my products, Job Opportunities, job seeker services & career advice
						</p>
						{!! Form::open(['route' => 'seeker.setting.notification.edit', 'id' => 'notificationForm']) !!} 
							<input type="hidden" name="id" value="{{$noti->id}}">
							<?php 
								$jobAlert = explode('|', $noti->job_alert); 
							?>  
							<div class="form-group row">
							    <div class="col-sm-4">
								    <label for="jobalert">
								    	Job Alerts Email
								    </label>
								</div>
							    <div class="col-sm">
							      	<div class="custom-control custom-radio custom-control-inline">
									  	<input type="radio" id="jobalertsubsid" name="jobalertsubs" class="custom-control-input" value="Y" {{ $jobAlert[0] =='Y' ? 'checked':''}}>
									  	<label class="custom-control-label" for="jobalertsubsid">Subscribe</label>
									</div>
									<div class="custom-control custom-radio custom-control-inline">
									  	<input type="radio" id="jobalertunsubs" name="jobalertsubs" class="custom-control-input" value="N" {{ $jobAlert[0] =='N' ? 'checked':''}}>
									  	<label class="custom-control-label" for="jobalertunsubs">Unsubscribe</label>
									</div>
							    </div> 
							</div>
							<div class="form-group row jobschedule">
							    <div class="col-sm-4">
								    <label for="jobalert">
								    	Job Alert Schedule
								    </label>
								</div>
							    <div class="col-sm">
							      	<div class="custom-control custom-radio custom-control-inline">
									  	<input type="radio" id="scheduleDaily" name="schedule" class="custom-control-input" value="Daily" 
									  	{{in_array('Daily', $jobAlert) ? 'checked' : ''}}/>
									  	<label class="custom-control-label" for="scheduleDaily">Daily</label>
									</div>
									<div class="custom-control custom-radio custom-control-inline">
									  	<input type="radio" id="scheduleWeekly" name="schedule" class="custom-control-input" value="Weekly" 
									  	{{in_array('Weekly', $jobAlert) ? 'checked' : ''}}/>
									  	<label class="custom-control-label" for="scheduleWeekly">Weekly</label>
									</div>
        							<span id="error-schedule" class="invalid-feedback"></span>
							    </div> 
							</div>

							<input type="hidden" name="job_alert"/>

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
						{!! Form::close() !!}
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

@section('js')
<script>
$(document).ready(function(){
	$('.jobschedule').hide();
	$("input[name='jobalertsubs'], input[name='schedule']").on('change', function(e){
		e.preventDefault();
		var val_jobalertsubs = $("input[name='jobalertsubs']:checked").val(); 

		if(val_jobalertsubs == 'Y'){
			$('.jobschedule').show();
			$('input[name="job_alert"]').val(val_jobalertsubs+'|'+$("input[name='schedule']:checked").val());
		}
		else if(val_jobalertsubs == 'N') {
			$('.jobschedule').hide();
			$('input[name="job_alert"]').val(val_jobalertsubs);
		} 
	});
	if($("input[name='jobalertsubs']:checked").val() == 'Y'){
		$('.jobschedule').show();
		$('input[name="job_alert"]').val($("input[name='jobalertsubs']:checked").val()+'|'+$("input[name='schedule']:checked").val());
	}
	else if($("input[name='jobalertsubs']:checked").val() == 'N') {
		$('.jobschedule').hide();
		$('input[name="job_alert"]').val($("input[name='jobalertsubs']:checked").val());
	} 


	$(document).on('submit', 'form#notificationForm', function (event){
		event.preventDefault();
		$('.loading').show();
	    var form = $(this);
	    var data = new FormData($(this)[0]);
	    var url = form.attr("action");
	    var method = form.attr("method");
	    $.ajax({
	        type: method,
	        url: url,
	        data: data,
	        cache: false,
	        contentType: false,
	        processData: false,
	        success: function (data) { 
	            $('.is-invalid').removeClass('is-invalid');
	            if (data.fail) { 
	            	$.each(data.errors, function (key, value) {   
	            		//alert(key);
	                    //$('#' + key).addClass('is-invalid');
	                    $('input[name="'+key+'"').addClass('is-invalid');
	                    $('#error-' + key).html(value); 
					}); 
	                $('.loading').hide();
	            } else {   
	                $.confirm({
	                    icon: 'fa fa-check-circle',
	                    theme: 'modern',
	                    type: 'green',
	                    title: false,
	                    content: '<p>Successfully saved notification.</p>',
	                    buttons:{
	                        okay: function(){   
	                            location.replace(data.redirect_url);   
	                            //alert(data.redirect_url);   
	                            /*$.each(data.redirect_url, function (key, value) {
	                            	console.log(key+' = '+value);
	                            });*/
	                            //$('.loading').hide();
	                        }
	                    }
	                }); 
	            }
	        },
	        error: function (xhr, textStatus, errorThrown){
	            //alert("Error: " + errorThrown);
	            $.alert({
	                icon: 'fa fa-times-circle',
	                theme: 'modern',
	                type: 'red',
	                title: 'Fail to save notification',
	                content: xhr.responseText,
	                confirm: function(){}
	            });
	        }
	    });   
	});
});
</script>
@endsection