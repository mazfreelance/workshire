<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('includes.favicon') 
    <title>{{ config('app.name', 'Workshire') }} - {{$seeker->seeker_name}}&#39;s Profile</title>

    <!-- Meta | SEO -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}"> 

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('public/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous"> 
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">    
    <link href="{{ asset('public/css/bootstrap-social.css') }}" rel="stylesheet">  
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
		    background: white;
		}
	</style>
</head>
<body>
	<main class="py-0"> 
	  	<div class="row mt-1 py-2 pl-sm-4 mr-2 mx-0"> 
		    <div class="col-sm-12"> 
				<hr class="style-eight">
				<div class="container">
					<div class="row">
						<div class="col-2">
							<div class="my-0">   
      							@if(file_exists(public_path().'/default_pictures/medium/'.$seeker->seeker_profile_photo_loc)) 
									<img src="{{asset('public/default_pictures/medium/'.$seeker->seeker_profile_photo_loc)}}" class="img-thumbnail text-center" width="150" /> 
								@else
									<i class="fas fa-user-circle fa-5x mx-5 mt-4"></i>
				                @endif
							</div>
						</div>
						<div class="col-6 my-2">
							<h3 class="text-uppercase mt-1">{{$seeker->seeker_name}}</h3>
							<h5 class="text-uppercase"><i class="fa fa-map-marker"></i>
								@if($seeker->seeker_city != '')
									{{$seeker->seeker_city.', '.$seeker->seeker_state}}
								@else
									{{$seeker->seeker_state}}
								@endif
							</h5>
							<h6 class="text-uppercase"><i class="fa fa-usd"></i> Expected salary: MYR 
								@foreach($salarys as $salary)  
									@if($salary->rangeValue == $seeker->seeker_expect_salary)
		        						{{$salary->rangeFrom}} - {{$salary->rangeTo}}
		        					@endif
								@endforeach
							</h6>
						</div>
						<div class="col-4">
							<div class="my-3">
								<span class="d-block"><i class="fa fa-user fa-lg"></i>&nbsp;
									@if($seeker->seeker_gender == 'F') Female
									@else Male
									@endif
								</span>
								<span class="d-block"><i class="fa fa-at"></i> {{auth()->user()->email}}</span>
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
						<div class="col-2">
							<h4 class="gothic font-italic">Experience</h4> 
						</div>
						<div class="col-10">
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
						<div class="col-2">
							<h4 class="gothic font-italic">Education</h4> 
						</div>
						<div class="col-10">   
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
						<div class="col-2">
							<h4 class="gothic font-italic">Skills</h4> 
						</div>
						<div class="col-3">
							@if($seeker->seeker_skillSets != '')
	                            <?php $skillsets = explode(',', $seeker->seeker_skillSets)?>      	
						        @foreach($skillsets as $skillset) 
									<span class="badge badge-primary badge-pill  my-1" style="font-size:15px">{!!$skillset!!}</span> 
						        @endforeach   
						    @else
						    	<p style="font-size:23px">No skill found.</p>	
						    @endif	
						</div>
						  
						<div class="col-2">
							<h4 class="gothic font-italic">Language</h4> 
						</div>
						<div class="col-3">
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
		    </div>
	  	</div>
	</main> 
</body> 
<script src="{{ asset('public/js/app.js') }}"></script>
</html>