@extends('layouts.master')

@section('title', str_replace('-', ' ', $name).' Job')
@section('css')
<style>
.boximpress {
	text-align:center;    
	padding-top: 5px; 
	padding-bottom: 5px;
	padding-left:1px;
	padding-right:1px;
	border:solid 2px; 
	border-color:#003466;
	background-color: #003466;     	
}  
.editorCoverLetter { 
	background-color:#ffffff;
	color:#000000;
	padding: 0px;
	margin: 0px;
	border: solid black;
	text-align:justify;
	height: 310px;  
}
</style>
@endsection
@section('content')  
<main class="py-0">  
	@if($post->jobpost_statusPosting == 'SHOW')
	<div class="row mt-1 py-2 pl-sm-4 mr-2 mx-0"> 
		<div class="col-sm-8">
			<h2>{{ $post->jobpost_position }}</h2>
			<div class="row">   
	   			<div class="col-sm-12"> 
	   				<div  class="d-inline" style="margin-top:-1em;">
	   					{{ $post->jobpost_emp_type }}
	   				</div> 
					<div class="d-sm-inline float-sm-right">  
						MYR&nbsp; {{number_format($post->jobpost_minSalary,2)}} - {{number_format($post->jobpost_maxSalary,2)}} / month
					</div> 
	   			</div>  
		    </div><!--row--> 
			<hr class="mb-2" style="margin-top:0.5em;border-color: #000;">
			<div class="row">  
				<div class="col-sm-3">   
					@if (file_exists(public_path().'/default_pictures/medium/'.$post->emp_logo_loc) AND $post->emp_logo_loc != '')
						<img src="{{ asset('public/default_pictures/medium/'.$post->emp_logo_loc) }}" class="img-fluid img-rounded border border-dark" style="height:150px;width:304px;"/> 
					@else
						<img src="{{ asset('public/images/default/company.jpg') }}" class="img-fluid img-rounded border border-dark" style="height:150px;width:304px;" />
					@endif
				</div>
				<div class="col-sm">  
					<h4 class="font-weight-bold text-dark">{!!$post->emp_name!!}</h4>
					<h6 class="font-weight-bold text-dark">
						<scan class="d-block"><i class="fa fa-map-marker-alt"></i>&nbsp;&nbsp;  
							{{$post->jobpost_loc_city}}, {{$post->jobpost_loc_state}}
						</scan>  
						@if($post->emp_website != '')
						<scan class="d-block"><i class="fa fa-globe"></i>&nbsp;&nbsp;  
							<a href="http://{{$post->emp_website}}" target="_blank">
								{!!$post->emp_name!!}&#39;s website
							</a>
						</scan>  
						@endif
						@if($post->emp_facebook != '')
						<scan class="d-block"><i class="fa fa-facebook"></i>&nbsp;&nbsp;&nbsp;  
							<a href="{!!$post->emp_facebook!!}" target="_blank">
								{!!$post->emp_name!!}&#39;s facebook
							</a>
						</scan>  
						@endif  
						<scan class="d-inline">
							<i class="fa fa-briefcase"></i>&nbsp;  
							No. of vacancy:&nbsp;{!!$post->job_noofvacancy!!}
						</scan> 
					</h6>
				</div> 
			</div>
			<hr class="mb-2" style="margin-top:0.5em;background-color: #bcbcbc;height:1px;border:0;">
			<div class="row">   
				<h3 class="font-weight-bold text-info mx-3">Job scope</h3>  
				<div class="col-sm-12 mt-1 ml-3"> 
	   				<scan class="text-justify">
	   					<scan class="text-justify"> 
	   						{!!htmlspecialchars_decode(stripslashes($post->jobpost_desc))!!} 
	   					</scan>
	   					<div class="d-block" style="margin-top:-1em;"> 
							<u class="font-weight-bold mx-4">Detail scope:</u> 
							<ul style="list-style:none;"> 
								@if($post->jobpost_exp != '')
								<li class="ml-3 text-justify">
									{!!htmlspecialchars_decode(stripslashes($post->jobpost_exp))!!}   
								</li>  
								@endif
								@if($post->jobpost_allowance != '')
								<li class="ml-3">
									Allowances: {!!htmlspecialchars_decode(stripslashes($post->jobpost_allowance))!!} 
								</li>  
								@endif
								@if($post->jobpost_skill != '')
								<li class="ml-3">
									Skills: {!!htmlspecialchars_decode(stripslashes($post->jobpost_skill))!!} 
								</li>  
								@endif
								@if($post->jobpost_education != '')
								<li class="ml-3">
									Education level: {!!htmlspecialchars_decode(stripslashes($post->jobpost_education))!!} 
								</li> 
								@endif
								@if($post->jobpost_field_study != '')
								<li class="ml-3">
									Field of study: {!!htmlspecialchars_decode(stripslashes($post->jobpost_field_study))!!} 
								</li>
								@endif
								@if($post->jobpost_years_exp != '')
								<li class="ml-3">
									No. of years: {!!htmlspecialchars_decode(stripslashes($post->jobpost_years_exp))!!} 
								</li>
								@endif 
							</ul> 
						</div>
	   				</scan>
	   			</div> 

	   			@if($post->emp_aboutus != '')
				<h4 class="font-weight-bold text-info mx-3 mt-2">Company Overview</h4>
	   			<div class="col-sm-12"> 
	   				<scan class="text-justify d-block">  
	   					{!!htmlspecialchars_decode(stripslashes($post->emp_aboutus))!!} 
	   				</scan>
		   		</div> 
		   		@endif
			</div>   
		</div>
		<div class="col-sm mt-1">
			<div class="border border-dark px-1 py-2">
				<div class="col-sm-12">
					@guest
						<button class="btn btn-outline-primary applynow">Apply now</button>
					@else  
						@if ($message = Session::get('save'))
		                <div class="alert alert-success alert-block">
		                    <button type="button" class="close" data-dismiss="alert">×</button> 
		                        <strong>{{ $message }}</strong>
		                </div>
		                @endif   

					 	@if(isset($post->saved_id))
					 		<div class="d-block mb-1 small">
					 			<a href="{{route('unsave_job')}}?id={{$post->saved_id}}"><i class="fas fa-star"></i></a>&nbsp;Job saved.
					 		</div>
					 	@else
						 	<div class="d-block mb-1 small">
						 		<a href="{{route('save_job')}}?jobpost={{$post->id}}&seeker={{Auth::user()->seeker[0]->id}}"><i class="far fa-star"></i>
						 		</a>&nbsp;Job unsaved.
						 	</div>
						@endif

		                @if(isset($post->appl_id)) 
							<span><i class="fa fa-thumbs-o-up"></i>&nbsp;
								<span class="text-danger">You&#39;re already applied this positon.</span>
							</span>  
			            @else 
							<button class="btn btn-outline-primary" data-toggle="modal" data-target=".modalApply">Apply now</button> 
							<div class="modal fade modalApply" tabindex="-1" role="dialog" aria-labelledby="modalApply" aria-hidden="true">
							  	<div class="modal-dialog modal-md" role="document">
								    <div class="modal-content">
								      	<div class="modal-header">
									        <h4 class="modal-title" id="exampleModalLabel">Application for</h4>
									        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
									          	<span aria-hidden="true">&times;</span>
									        </button>
								      	</div>
								      	<div class="modal-body">
								      		<h5>{!! strtoupper($post->jobpost_position) !!}</h5>
								      		<div class="row">
								      			<div class="col-sm-12 text-small"><i class="fa fa-building"></i>
								      				{!!$post->emp_name!!}
								      			</div>
								      			<div class="col-sm-12 text-small"><i class="fa fa-map-marker"></i>&nbsp;
								      				{{$post->jobpost_loc_city}}, {{$post->jobpost_loc_state}}
								      			</div>
								      		</div>
									        <form id="applyjob" method="POST" action="{{ route('seeker.process_apply') }}">
									        	@csrf
									        	<input type="hidden" name="seeker_id" value="{{Auth::user()->seeker->id}}"/>
									        	<input type="hidden" name="employer_id" value="{{$post->emp_id}}"/>
									        	<input type="hidden" name="job_id" value="{{$post->id}}"/>
									        	<input type="hidden" name="job_name" value="{{str_replace('-', ' ', $name)}}">
									          	<div class="form-group boximpress text-light mt-2">
										            <label for="message-text" class="col-form-label pl-2">
										            	Make a pitch to impress the employer:
										            </label>
										            <textarea class="editorCoverLetter" name="editorCoverLetter" id="editorCoverLetter" cols="30"></textarea>  
										            <h6 class="text-small" id="wordCount"></h6>
									          	</div>
									        	<hr>
									        	<div class="text-center">
										        	<div class="form-check">
											            <input class="form-check-input radio1" type="radio" value="a_now" name="available" id="radio1" required>
													  	<label class="form-check-label" for="radio1">
												    		Available now
													  	</label>
										          	</div> 
										        	<div class="form-check">
											            <input class="form-check-input radio2" type="radio" name="available" value="a_after" id="radio2" required>
													  	<label class="form-check-label" for="radio2">
												    		Available after
													  	</label>
										          	</div>
										          	<div class="form-group datepickertemp" style="display:none;"> 
													    <input type="text" class="form-control datepicker" name="datepicker"/>
												  	</div>
												</div>
										      	<div class="modal-footer d-flex justify-content-center" style="margin-bottom:-1em"> 
											        <button type="submit" class="btn btn-primary confirm_apply">Confirm Application</button>
										      	</div>
									        </form>
								      	</div>
								    </div>
							  	</div>
							</div> 
		                @endif 
					@endguest	
				</div>
				<div class="col-sm-12 mt-2">
					Posted: 
					<p id="postedTimeAgo"></p>
					<input type="hidden" id="postedTimeAgo_raw" value="{{$post->jobpost_startDate}}" />
					Closes:
					<p>{{date('jS F Y', strtotime($post->jobpost_endDate))}} </p>
					Share This
					<p>
						<a class="btn btn-social-icon btn-facebook social-share" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::fullUrl()) }}">
						    <span class="fab fa-facebook-f text-light"></span>
					  	</a>
					  	<a class="btn btn-social-icon btn-twitter social-share" href="https://www.twitter.com/intent/tweet?url={{ urlencode(Request::fullUrl()) }}">
					    	<span class="fab fa-twitter text-light"></span>
					  	</a>
					  	<a class="btn btn-social-icon btn-google social-share" href="https://plus.google.com/share?url={{ urlencode(Request::fullUrl()) }}">
					    	<span class="fab fa-google-plus-g text-light"></span>
					  	</a>
					  	<a class="btn btn-social-icon btn-linkedin social-share" href="https://www.linkedin.com/shareArticle?url={{ urlencode(Request::fullUrl()) }}">
					    	<span class="fab fa-linkedin text-light"></span>
					  	</a>
					</p>
				</div>
			</div>
		</div>
	</div>
	@else
	<div class="row mt-1 py-2 pl-sm-4 mr-2 mx-0 mb-5"> 
		<div class="col-sm-12 mb-5">
			<h2>{{ $post->jobpost_position }}</h2> 
			<div  class="d-inline" style="margin-top:-1em;">
				{{ $post->jobpost_emp_type }}
			</div>  
			<hr class="mb-5" style="border-color: #000;">
			<p class="text-danger fa-2x">Sorry, job vacation is closed.</p>
		</div>
	</div>   
	@endif
</main>
<div class="loading">
	<i class="fa fa-spinner fa-spin fa-2x fa-tw"></i> 
	<span class="futura d-block">Loading</span>
</div>
<!-- Footer -->  
@include('includes.footer')  
@endsection
@section('js')
<script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('js/ckeditor/adapters/jquery.js') }}"></script> 
<script>     

$(document).ready(function() {  
	/**submit**/
	$('form#applyjob').on('submit', function (event) {
		$('.loading').show();	
		$('.confirm_apply').attr('disabled', true);
		var value = $('textarea.editorCoverLetter').val();
	    var wordCount = value.trim().replace(/\s+/gi, ' ').split(' ').length;  

		if (value.length == 0 || wordCount < 10) { 
			$.confirm({
			    title: 'Encountered an error!',
			    content: 'Your pitch must be minimum 10 words to proceed',
			    type: 'red',
			    typeAnimated: true,
			    buttons: {
			        tryAgain: {
			            text: 'Try again',
			            btnClass: 'btn-red',
		            	keys: ['enter'],
			            action: function(){
	        				//$("#image_upload_form").trigger('reset');
			            }
			        } 
			    }
			});
			$('.loading').hide(); 
			$('.confirm_apply').attr('disabled', false);
      		return false;
		}
		else if ($("#radio2").is(":checked") && $(".datepicker").val() == ''){
			$.confirm({
			    title: 'Encountered an error!',
			    content: 'Select available date !',
			    type: 'red',
			    typeAnimated: true,
			    buttons: {
			        tryAgain: {
			            text: 'Try again',
			            btnClass: 'btn-red',
		            	keys: ['enter'],
			            action: function(){
	        				//$("#image_upload_form").trigger('reset');
							$('.loading').hide(); 
							$('.confirm_apply').attr('disabled', false);
			            }
			        } 
			    }
			});  
      		return false;	
		}else{
			event.preventDefault();
			var form = $(this);
			var data = new FormData($(this)[0]);
			var url = form.attr("action");
			var method = form.attr("method");
	      	$.ajax({
				type: method,
				url: url,
				data: data,
				cache: true,
				contentType: false,
				processData: false,
				success: function (data) { 
					var APP_URL = {!! json_encode(url('/')) !!}+'/'+data.url; 
					
					$.confirm({
						theme: 'modern',
					    title: 'Alert!',
					    content: data.msg,
					    buttons: {
					        Okay: function () {
					            //$.alert(APP_URL);
					            window.location =  APP_URL; 
					        } 
					    }
					});

              		$('.loading').hide(); 
					$('.confirm_apply').attr('disabled', false);
	          	},
	          	error: function (xhr, textStatus, errorThrown) {
	              	alert("Error: " + errorThrown);
	              	$('.loading').hide();
					$('.confirm_apply').attr('disabled', false);
	          	}
	      	}); 
	    }
  	});

	/**count word **/
	counter = function() {
	    var value = $('textarea.editorCoverLetter').val();

	    if (value.length == 0) {
	        $('#wordCount').html('Words: '+0);  
	        return;
	    } 
	    var regex = /\s+/gi;
	    var wordCount = value.trim().replace(regex, ' ').split(' ').length;  
	    $('#wordCount').html('Words: '+wordCount);  
	}; 
    $('textarea.editorCoverLetter').change(counter);
    $('textarea.editorCoverLetter').keydown(counter);
    $('textarea.editorCoverLetter').keypress(counter);
    $('textarea.editorCoverLetter').keyup(counter);
    $('textarea.editorCoverLetter').blur(counter);
    $('textarea.editorCoverLetter').focus(counter); 

	//posted time
	var raw = $('#postedTimeAgo_raw').val();
	var timeago = moment(raw).fromNow(); 
	$('#postedTimeAgo').text(timeago);

	//social share triggered event
	$('.social-share').on('click', function(event){
	    event.preventDefault();  
	    var url = $(this).attr('href');
	    var popup = window.open(url, 'Social Share', 
        			'height=400, width=400, '+
        			'top=' + ($(window).height() / 2 - 400) + ', left=' + ($(window).width() / 2 - 600) +
        			', toolbar=0, location=0, menubar=0, directories=0, scrollbars=0'); 
	    if (popup) {
	        popup.focus();
	        return false;
	    }
	});

	//datepicker
	$('.datepicker').datepicker({ 
		calendarWeeks: true, 
		uiLibrary: 'bootstrap4', 
		format: 'dd/mm/yyyy' 
	});
	$('.datepickertemp').hide();
	$('.radio1').on('change', function(){
		$('.datepickertemp').hide();
		$('.datepicker').val('');
	});
	$('.radio2').on('change', function(){
		$('.datepickertemp').show();
	});

	//editor
	//$('textarea.editorCoverLetter').ckeditor(); 
		
	//trigger action apply now before login
	$('.applynow').on('click', function(){
		$.confirm({
		    title: 'Can&#39;t apply ?',
		    content: 'Sign up / login to our website to proceed your application',
		    type: 'red',
		    buttons: {   
		        ok: {
		            text: "ok!",
		            btnClass: 'btn-primary',
		            keys: ['enter'],
		            action: function(){
		                 console.log('the user clicked confirm');
		            }
		        }
		    }
		});
	});
	 
	return false;
});
</script>
@endsection