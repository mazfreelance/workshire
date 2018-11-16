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
		            	<!--tab 1-->
		                <div class="tab-pane active" id="profile">
		                    <h5 class="mb-2">{{$seek->seeker_name}}&#39;s Profile</h5>
		                    <h6 class="mb-1">
		                    	<i class="fa fa-envelope fa-1x" aria-hidden="true"></i>&nbsp;
		                    	{{$seek->seeker_ctc_email1}}
		                	</h6>
		                    <h6 class="mb-1">
		                    	<i class="fa fa-mobile fa-lg" aria-hidden="true"></i>&nbsp;&nbsp;
		                    	{{$seek->seeker_ctc_tel1}}
		                	</h6> 
                            <span class="badge badge-primary"><i class="fa fa-user"></i> 900 Followers</span>
                            <span class="badge badge-success"><i class="fa fa-cog"></i> 43 Forks</span>
                            <span class="badge badge-danger"><i class="fa fa-eye"></i> 245 Views</span>  
		                	<hr>
		                    <div class="row">
		                        <div class="col-md-6">
		                            <h6>About<i class="fa fa-user float-right"></i></h6>
		                            <div class="container row text-left px-4 mb-2"> 
		                                <div class="col-5 table-bordered bg-dark text-white">Location</div>
										<div class="col-7 table-bordered bg-light">
											{{$seek->seeker_zip}}, {{$seek->seeker_state}}
										</div>
										<div class="col-5 table-bordered bg-dark text-white">I/C Number</div>
										<div class="col-7 table-bordered bg-light">
											{{$seek->seeker_nric}}
										</div>
										<div class="col-5 table-bordered bg-dark text-white">Date of Birth</div>
										<div class="col-7 table-bordered bg-light">
											{{date('d F Y' , strtotime($seek->seeker_DOB))}}<br/>
											(<span id="dobTxt"></span>&nbsp;years old) 
											<input type="hidden" id="dob" value="{{$seek->seeker_DOB}}"/>
										</div>  
										<div class="col-5 table-bordered bg-dark text-white">Expected Salary</div>
										<div class="col-7 table-bordered bg-light wrap-break">
											MYR&nbsp;
											@foreach($salarys as $salary)  
												@if($salary->rangeValue == $seek->seeker_expect_salary)
					        						{{$salary->rangeFrom}} - {{$salary->rangeTo}}
					        					@endif
											@endforeach
										</div>
										<div class="col-5 table-bordered bg-dark text-white">Relocate</div>
										<div class="col-7 table-bordered bg-light">
											@if($seek->seeker_will_travel == 'willing')
												Willing to relocate
											@else
												No willing to relocate
											@endif
										</div>  
		                            </div>
		                        </div>
		                        <div class="col-md-6"> 
		                            <h6>Language<i class="fa fa-language float-right"></i></h6>
		                            @if($seek->seeker_language != '')
			                            <?php $langsets = explode(',', $seek->seeker_language)?>
								              	
								        @foreach($langsets as $langset)
							        	<a href="" class="badge badge-info badge-pill">{!!$langset!!}</a>
								        @endforeach        
								    @else
								    	<p>No language found.</p>	
								    @endif	    	 
		                            <hr>
		                            <h6>Skills<i class="fa fa-wrench float-right"></i></h6>
		                            @if($seek->seeker_skillSets != '')
			                            <?php $skillsets = explode(',', $seek->seeker_skillSets)?>
								              	
								        @foreach($skillsets as $skillset)
							        	<a href="" class="badge badge-dark badge-pill">{!!$skillset!!}</a>
								        @endforeach  
								    @else
								    	<p>No skill found.</p>	
								    @endif	    
		                        </div> 
		                        <div class="col-md-12">
		                        	<hr>
		                            <h5 class="mt-2"><span class="fa fa-clock-o ion-clock float-right"></span> Recent Activity</h5>
		                            <table class="table table-sm table-hover table-striped">
		                                <tbody>                                    
		                                    <tr>
		                                        <td>
		                                            <strong>Abby</strong> joined ACME Project Team in <strong>`Collaboration`</strong>
		                                        </td>
		                                    </tr>
		                                    <tr>
		                                        <td>
		                                            <strong>Gary</strong> deleted My Board1 in <strong>`Discussions`</strong>
		                                        </td>
		                                    </tr>
		                                    <tr>
		                                        <td>
		                                            <strong>Kensington</strong> deleted MyBoard3 in <strong>`Discussions`</strong>
		                                        </td>
		                                    </tr>
		                                    <tr>
		                                        <td>
		                                            <strong>John</strong> deleted My Board1 in <strong>`Discussions`</strong>
		                                        </td>
		                                    </tr>
		                                    <tr>
		                                        <td>
		                                            <strong>Skell</strong> deleted his post Look at Why this is.. in <strong>`Discussions`</strong>
		                                        </td>
		                                    </tr>
		                                </tbody>
		                            </table>
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