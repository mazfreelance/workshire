@extends('layouts.master')

@section('title', 'Search Candidates')

@section('content')  
<main class="py-0">    
	@include('employer.includes.menu')
	<div class="row border border border-dark border-top-0 mr-0">
		<div class="col-sm-12 pl-sm-5 pt-sm-1 pt-0 pl-4">
			<h3 class="text-primary">Search Candidates</h3> 
			<hr style="margin-bottom:0.1em">  
			<!-- FILTER CANDIDATE START -->
			@include('employer.includes.candidate_filter')
			<!-- FILTER CANDIDATE END -->
			@include('employer.includes.candidate_type')
			<hr style="margin-top:0.1em;margin-bottom:0.1em"> 
		</div>
		 
		<div class="col-sm-8 pl-sm-5 pl-4">
			@if($statusSet[0]->status == 'ENABLE')
				@if($candidateSet[1]->status == 'YES')
				@foreach($seekers as $seeker) 
					<div class="row my-1"> 
						<div class="container">    
						    <div class="row justify-content-center vertical-center"> 
								<div class="col-sm">
									<div class="row"> 
										<div class="col-sm col-md pt-1">
											<div class="col-sm col-md">  
												<h4 class="text-uppercase">{!! $seeker->seeker_name !!}</h4> 
												<div class="btn-group float-right"> 
									                <a class="btn btn-outline-dark btn-sm" href="#">
								                    	Buy
									                </a> 
									            </div>
											</div>
											<div class="col-sm col-md">
												<h6>
													<i class="fa fa-book"></i>&nbsp;
													{{$seeker->education[0]->highest_education}} - 
													{{$seeker->education[0]->field_of_study}}
													@if($seeker->education[0]->major_study != '')  
														({{ str_replace('( ', '(', ucwords(str_replace('(', '( ', strtolower($seeker->education[0]->major_study)))) }})  
													@endif
												</h6>
											</div>
											<div class="col-sm col-md">
												<h6><i class="fa fa-map-marker"></i>&nbsp;
													@if($seeker->seeker_city != '')
													{{$seeker->seeker_city}}, {{$seeker->seeker_state}}
													@else
													{{$seeker->seeker_state}}
													@endif
												</h6>
											</div>
											<div class="col-sm col-md small">
												<span><i class="fa fa-briefcase"></i> <font class="text-danger">Experience</font></span> 
												@if(isset($seeker->experience[0])) 
													@if($seeker->experience[0]->exp_company != '') 
													<span><i class="fa fa-building"></i>&nbsp; 
														{{ str_replace('( ', '(', ucwords(str_replace('(', '( ', strtolower($seeker->experience[0]->exp_company)))) }}
													</span>
													@endif 
												@endif 
											</div> 
										</div>
									</div>
								</div>
							</div>
							<hr>    
					    </div><!--container-->  
					</div>  
					@endforeach
					<nav aria-label="pagination" class="mt-2 d-flex justify-content-center">
		                {{ $seekers->links('vendor.pagination.bootstrap-4') }}
	              	</nav>  
				@else 
					{{$candidateSet[1]->message}}
				@endif
			@else 
				{{$statusSet[0]->message}}
			@endif
		</div>
		<div class="col-sm border border-dark-left border-right-0 border-bottom-0 border-top-0 pl-sm-3 pl-4"> 
			<h4 class="mt-1 text-muted">Paid candidates</h4> 
			<hr style="margin-top:0.1em;margin-bottom:0.5em"> 
		    <div class="row"> 
				<div class="col-sm">
					<div class="row"> 
						<div class="col-sm col-md pt-1">
							<div class="col-sm col-md">  
								<h4>Name</h4> 
								<div class="btn-group float-right">
					                <a class="btn btn-outline-dark btn-sm" title="Resume attached"><i class="fa fa-file-pdf"></i></a> 
					                <a class="btn btn-outline-dark btn-sm" href="#">
				                    	View
					                </a> 
					            </div>
							</div>
							<div class="col-sm col-md"><h6><i class="fa fa-book"></i>  Education</h6></div>
							<div class="col-sm col-md"><h6><i class="fa fa-map-marker"></i> LOC</h6></div>
							<div class="col-sm col-md small">
								<span><i class="fa fa-briefcase"></i> <font class="text-danger">Experience</font></span> 
								<span><i class="fa fa-building"></i> Company</span>
							</div>
							<div class="col-sm col-md small">
								<span>
									<i class="fa fa-money"></i> Paid by
								</span>
								<span class="float-right">Status:&nbsp; 
									<font color="red">Expired</font> /
									<font color="green">Paid</font>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>  
		</div>
	</div>
</main> 
<!-- Footer -->  
@include('includes.footer') 

@endsection