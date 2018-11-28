@extends('layouts.master')

@section('title', 'Account Settings')

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
			      	<div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
						<div class="tab-pane fade {{Request::path() == 'employer/setting' ? 'show active':''}}" id="nav-account" role="tabpanel" aria-labelledby="nav-account-tab">
							<h5 class="my-2"><span class="fa fa-user float-right"></span> Account Settings</h5> 
							{!! Form::open(['route' => 'employer.updateAcc', 'id' => 'acc_form']) !!} 
							  	<div class="form-group row">
								    <label for="emailUser" class="col-sm-2 col-form-label">Email</label>
								    <div class="col-sm-10"> 
								      	<input type="text" class="form-control" name="email" id="email" placeholder="Email" value="{{Auth::guard('employer')->user()->email}}">  
								      	<span id="error-email" class="invalid-feedback"></span>
								    </div>
							  	</div> 
							  <div class="form-group row">
							    <div class="col-sm-10">
							      <button type="submit" class="btn btn-third">Update</button>
							    </div>
							  </div>
							{!! Form::close() !!}
						</div> 
					</div>
					@else
					<div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
						<div class="tab-pane fade {{Request::path() == 'seeker/setting' ? 'show active':''}}" id="nav-account" role="tabpanel" aria-labelledby="nav-account-tab">
							<h5 class="my-2"><span class="fa fa-user float-right"></span> Account Settings</h5>  

							{!! Form::open(['route' => 'seeker.updateAcc', 'id' => 'acc_form']) !!}  
							  	<div class="form-group row">
								    <label for="email" class="col-sm-2 col-form-label">Email</label>
								    <div class="col-sm-10"> 
								      	<input type="text" class="form-control" id="email" value="{{$email}}" disabled/>  
								    </div>
							  	</div>
							  	<div class="form-group row">
								    <label for="username" class="col-sm-2 col-form-label">Username</label>
								    <div class="col-sm-10">
								      	<input type="text" class="form-control" id="username" name="username" placeholder="Username" value="{{$username}}" />
								      	<span id="error-username" class="text-danger invalid-feedback"></span>
								    </div>
							  	</div>  
							  	<div class="form-group row">
								    <div class="col-sm-10">
								      <button type="submit" class="btn btn-third">Save account</button>
								    </div>
							  	</div>
							{!! Form::close() !!}
						</div> 
					</div> 
					@endif
			    </div>
		  	</div> 
		</div> 
	</div> 
</main>
@section('js')
<script> 
$(document).ready(function(){
	$('#acc_form').submit(function(evt){  
		evt.preventDefault(); 

	    var form = $(this);
	    var data = new FormData($(this)[0]);
	    var url = form.attr("action");
	    var method = form.attr("method");

		$.ajax({
			url: url,
			type: method,
			data: data,
		    cache:false,
		    contentType: false,
		    processData: false, 
		    success: function(data){
                $('.is-invalid').removeClass('is-invalid');
		    	if (data.fail) { 
		    		for (control in data.errors) {   
                        $('#' + control).addClass('is-invalid');
                        $('#error-' + control).html(data.errors[control]);
                        //alert(control+' '+data.errors[control]);
                    } 
                }else {   
                    $.confirm({
                        icon: 'fa fa-check-circle',
                        theme: 'modern',
                        type: 'green',
                        title: false,
                        content: '<p>Successfully saved account</p>',
                        buttons:{
                            okay: function(){   
                                location.replace(data.redirect_url);   
                                //alert(data.redirect_url);   
                            }
                        }
                    }); 
                }
		    }, error: function (xhr, textStatus, errorThrown){
                console.log("Error: " + xhr.responseText);
                $.alert({
                    icon: 'fa fa-times-circle',
                    theme: 'modern',
                    type: 'red',
                    title: 'Fail to save job',
                    content: xhr.responseText,
                    confirm: function(){}
                });
            }
		});
	});
});
</script>
@endsection
<!-- Footer -->  
@include('includes.footer') 

@endsection