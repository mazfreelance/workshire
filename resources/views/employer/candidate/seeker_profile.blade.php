@extends('layouts.master')
@section('title', 'Applicant') 

@section('content') 	
	<main class="py-0"> 
	  	<div class="row mt-1 py-2 pl-sm-4 mr-2 mx-0"> 
		    <div class="col-sm-12">
				<div class="btn-group d-flex justify-content-end">
					<button class="btn btn-success btn-md btnPrint print_profile" 
						data-toggle="tooltip" data-placement="top" title="Print {{$seeker->seeker_name}}&#39;s profile">
						<i class="fa fa-print"></i>
					</button> 
		      		<button class="btn btn-md btn-danger discard" onclick="javascript:window.close()" 
		      			data-toggle="tooltip" data-placement="top" title="Discard Window">
		      			Discard
		      		</button> 
		      	</div> 
				@if(file_exists(public_path().'/document/uploadsCV/'.$seeker->seeker_resume_location))  
		      		<h2 class="text-center">{{ucwords(strtolower($seeker->seeker_name))}}&#39;s Profile</h2> 
					<div class="text-center">
						<embed 
						    src="{{ action('DocumentController@getDocument', ['id'=> $seeker->seeker_resume_location]) }}#toolbar=0"
						    style="width:100%; height:655px;"
						    frameborder="0"
						>
					</div>
				@else  
					<hr class="style-eight">
					<div class="container">
						<div class="row">
							<div class="col-sm-2">
								<div class="my-0">     
          							@if(file_exists(public_path().'/default_pictures/medium/'.$seeker->seeker_profile_photo_loc)) 
										<img src="{{asset('public/default_pictures/medium/'.$seeker->seeker_profile_photo_loc)}}" class="img-thumbnail text-center" width="150" /> 
									@else
										<i class="fas fa-user-circle fa-5x mx-5 mt-4 d-flex justify-content-center"></i>                
					                @endif
								</div>
							</div>
							<div class="col-sm-6 my-2">
								<h3 class="text-uppercase mt-1">{{$seeker->seeker_name}}</h3>
								<h5 class="text-uppercase"><i class="fa fa-map-marker-alt"></i>
									@if($seeker->seeker_city != '')
										{{$seeker->seeker_city.', '.$seeker->seeker_state}}
									@else
										{{$seeker->seeker_state}}
									@endif
								</h5>
								<h6 class="text-uppercase"><i class="fa fa-wallet"></i> Expected salary: MYR 
									@foreach($salarys as $salary)  
										@if($salary->rangeValue == $seeker->seeker_expect_salary)
			        						{{$salary->rangeFrom}} - {{$salary->rangeTo}}
			        					@endif
									@endforeach
								</h6>
							</div>
							<div class="col-sm-4">
								<div class="my-3">
									<span class="d-block"><i class="fa fa-genderless fa-lg"></i>&nbsp;
										@if($seeker->seeker_gender == 'F') Female
										@else Male
										@endif
									</span>
									<span class="d-block"><i class="fa fa-at"></i> {{$seeker->seeker_ctc_email1}}</span>
									<span class="d-block"><i class="fa fa-mobile fa-lg"></i>&nbsp;
										{{$seeker->seeker_ctc_tel1}}
									</span> 
									<span class="d-block"><i class="fa fa-plane"></i> 
										@if($seeker->seeker_will_travel == 'willing') 
										I&#39;m willing to travel
										@else 
										I&#39;m not willing to travel
										@endif
									</span>
								</div>
							</div>
						</div>
						<hr>
					</div>
					<div class="container">
						<div class="row">
							<div class="col-sm-2">
								<h4 class="gothic font-italic">Experience</h4> 
							</div>
							<div class="col-sm-10">
								@if(count($experience) > 0)
                            	@for ($i = 0; $i < count($experience); $i++) 
								<div class="row">
									<div class="col">
										<span class="float-right">
											{!!date('M Y', strtotime($experience[$i]->exp_fromDt))!!}
											-
											@if($experience[$i]->exp_toDt == 'Present')
												{!!$experience[$i]->exp_toDt!!}
											@else
												{!!date('M Y', strtotime($experience[$i]->exp_toDt))!!}
											@endif
											 
										</span>
									 	<span class="d-block gothic h5">{!!$experience[$i]->exp_company!!}</span>
									 	<span class="d-block gothic h6">{!!$experience[$i]->exp_position!!}</span>
									 	<p class="d-block gothic text-justify">
										 	{!!$experience[$i]->exp_jobd!!}
									 	</p>
								 	</div>
								</div>
								@endfor
								@else
								<div class="row">
									<div class="col"><p style="font-size:23px">No work experience found.</p></div>
								</div>
								@endif
							</div> 
						</div>
						<hr>
					</div>
					<div class="container">
						<div class="row">
							<div class="col-sm-2">
								<h4 class="gothic font-italic">Education</h4> 
							</div>
							<div class="col-sm-10">   
								@if(count($education) > 0)
                            	@for ($i = 0; $i < count($education); $i++) 
								<div class="row">
									<div class="col">
									 	<span class="d-block gothic h5">{!!$education[$i]->institute!!}</span>
									 	<span class="d-block gothic h6">
									 		@if($education[$i]->highest_education == 'SPM')
									 			{!!$education[$i]->highest_education!!}
									 		@else
									 			{!!$education[$i]->highest_education!!}
									 			&nbsp;-&nbsp;
									 			{!!$education[$i]->field_of_study!!}
									 		@endif
									 	</span>
									 	<p class="d-block gothic text-justify">
									 		@if($education[$i]->highest_education != 'SPM')
									 			@if($education[$i]->major_study != '')
									 				{!!$education[$i]->major_study!!}
												 	&nbsp;-&nbsp;
												 	<span class="font-weight-bold">{!!$education[$i]->qualification!!} {!!$education[$i]->grade_achievement!!}</span>
									 			@else 
												 	<span class="font-weight-bold">{!!$education[$i]->qualification!!} {!!$education[$i]->grade_achievement!!}</span>
									 			@endif
									 		@endif 
									 	</p>
									</div>
								</div>
								@endfor
							 	@else
							 	<div class="row">
									<div class="col"><p style="font-size:23px">No education found.</p></div>
								</div>
							 	@endif
							</div> 
						</div>
						<hr>
					</div> 
					<div class="container">
						<div class="row">
							<div class="col-sm-2">
								<h4 class="gothic font-italic">Skills</h4> 
							</div>
							<div class="col-sm-3">
								@if($seeker->seeker_skillSets != '')
		                            <?php $skillsets = explode(',', $seeker->seeker_skillSets)?>      	
							        @foreach($skillsets as $skillset) 
										<span class="badge badge-primary badge-pill  my-1" style="font-size:15px">{!!$skillset!!}</span> 
							        @endforeach   
							    @else
							    	<p style="font-size:23px">No skill found.</p>	
							    @endif	
							</div>
							  
							<div class="col-sm-2">
								<h4 class="gothic font-italic">Language</h4> 
							</div>
							<div class="col-sm-3">
								@if($seeker->seeker_language != '') 
		                            <?php $langsets = explode(',', $seeker->seeker_language)?> 
							        @foreach($langsets as $langset) 
						        		<span class="badge badge-success badge-pill my-1" style="font-size:15px">{!!$langset!!}</span> 
							        @endforeach   
							    @else
							    	<p style="font-size:23px">No language found.</p>	
							    @endif	
							</div> 
						</div>
						<hr>
					</div> 
				@endif  
		    </div>
	  	</div>
	</main> 
  <!-- Footer -->  
  @include('includes.footer') 
@endsection

@section('css')
<style>
hr.style-eight {
    overflow: visible; /* For IE */
    padding: 0;
    border: none;
    border-top: medium double #333;
    color: #333;
    text-align: center;
}
hr.style-eight:after {
    content: "§";
    display: inline-block;
    position: relative;
    top: -0.7em;
    font-size: 1.5em;
    padding: 0 0.25em;
    background: transparent;
}
</style>
@endsection
@section('js')
<script type="text/javascript" src="{{ asset('public/js/jquery.printPage.js') }}"></script>
<script>
$(document).ready(function(){   
    $('.print_profile').tooltip();
    $('.discard').tooltip();

	
    $(".btnPrint").printPage({
      url: "{{ URL::to('profile/print').'/'.encrypt($seeker->id)}}",
      attr: "href",
      message:"Your document is being created"
    }) 
}); 
</script>
@endsection