@extends('layouts.master') 
@section('title', 'Profile View')

@section('content')     
<main class="py-0">  
	<div class="row my-1 mx-2">
		<div class="col-sm-12">
			<h3>Profile</h3>
			<p style="margin-bottom:-0.2em;" class="text-danger">Your profile not update, please update your profile.</p> 
			<hr style="height:1px;border-width:0;background-color:#6066c4">
		</div> 
		<div class="col-sm ml-sm-2"> 
		    <div class="row my-1 pt-2 shadow p-3 bg-white rounded" style="background-color:#fff;">
		        <div class="col-lg-8 order-lg-2">
		            @include('seeker.profile.includes.menutab')
		            <div class="tab-content py-4"> 
		                <div class="tab-pane active" id="education_work"> 
		                    <div class="row"> 
		                        <div class="col-12">
		                            <h5 class="mt-2"><span class="fa fa-book float-right"></span> Education</h5>
		                            <div class="container row text-left px-4 mb-2"> 
		                            	@for ($i = 0; $i < count($edu_detail); $i++) 
										<div class="col-5 table-bordered bg-dark text-white">Institution</div>
										<div class="col-7 table-bordered bg-light">
											{!! str_replace('( ', '(', ucwords(str_replace('(', '( ', strtolower($edu_detail[$i]->institute)))) !!}
										</div>
										<div class="col-5 table-bordered bg-dark text-white">Field of Study</div>
										<div class="col-7 table-bordered bg-light">
											{!!$edu_detail[$i]->field_of_study!!}
										</div>
										<div class="col-5 table-bordered bg-dark text-white">Course</div>
										<div class="col-7 table-bordered bg-light">
											({!!$edu_detail[$i]->highest_education!!})&nbsp;
											{!!str_replace('( ', '(', ucwords(str_replace('(', '( ', strtolower($edu_detail[$i]->major_study))))!!}
										</div>
										<div class="col-5 table-bordered bg-dark text-white">Qualification</div>
										<div class="col-7 table-bordered bg-light">
											{!!$edu_detail[$i]->qualification!!}
										</div>
										<div class="col-5 table-bordered bg-dark text-white">CGPA</div>
										<div class="col-7 table-bordered bg-light">
											{!!$edu_detail[$i]->grade_achievement!!} 
										</div> 
										@endfor
		                            </div>
		                        </div>
	                            <hr> 
		                        <div class="col-12">
		                            <h5 class="mt-2"><span class="fa fa-building float-right"></span> Work Experience</h5> 
		                            @for ($i = 0; $i < count($exp_detail); $i++) 
		                            <div class="container row text-left px-4 mb-2">
										<div class="col-5 table-bordered bg-dark text-white">Company</div>
										<div class="col-7 table-bordered bg-light">
											{!!$exp_detail[$i]->exp_company!!} 
										</div>
										<div class="col-5 table-bordered bg-dark text-white">Positon</div>
										<div class="col-7 table-bordered bg-light">
											{!!$exp_detail[$i]->exp_position!!} 
										</div>
										<div class="col-5 table-bordered bg-dark text-white">From</div>
										<div class="col-7 table-bordered bg-light">
											{!!$exp_detail[$i]->exp_fromDt!!} 
										</div>
										<div class="col-5 table-bordered bg-dark text-white">To</div>
										<div class="col-7 table-bordered bg-light">
											{!!$exp_detail[$i]->exp_toDt!!} 
										</div> 
										<div class="col-5 table-bordered bg-dark text-white">Monthly Salary</div>
										<div class="col-7 table-bordered bg-light">
											{!!$exp_detail[$i]->exp_salary!!} 
										</div>
										<div class="col-5 table-bordered bg-dark text-white pb-5">Job Description</div>
										<div class="col-7 table-bordered bg-light"> 
						       				{!!$exp_detail[$i]->exp_jobd!!}  
										</div> 
									</div> 
									@endfor  
		                        </div>
		                    </div>
		                    <!--/row-->
		                </div> 
		            </div>
		        </div>
		        <div class="col-lg-4 order-lg-1 text-center"> 
		            @include('seeker.profile.includes.dp')
		        </div>
		    </div> 

			 
		</div> 
	</div> 
</main>
	@include('seeker.profile.includes.script') 
	<!-- Footer -->  
	@include('includes.footer') 

@endsection 