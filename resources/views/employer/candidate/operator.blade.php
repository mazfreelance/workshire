@extends('layouts.master')

@section('title', 'Search Candidates')

@section('content')   
<main class="py-0">    
	@include('employer.includes.menu')
	<div class="row border border border-dark border-top-0 mr-0">
		<div class="col-sm-12 pl-sm-5 pt-sm-1 pt-0 pl-4">
			<h3 class="text-primary">Search Candidates</h3> 
			<hr style="margin-bottom:0.1em"> 
			<div class="row mx-1 bg-third border border-bottom-primary py-2 pl-sm-4 mr-0">
				<div class="col-sm-6 col-md-2">  
					<select class="form-control form-control-sm border">
						<option value="" selected="">Experience level</option>
					</select>
				</div> 
				<div class="col-md-2"> 
					<div class="input-group">
					  	<div class="input-group-prepend">
					    	<button class="btn btn-sm btn-secondary border-right-0 border" type="button">
					    		<span class="fa fa-search"></span>
					    	</button>
					  	</div>
						<input class="form-control form-control-sm py-2 border-left-0 border" type="text" placeholder="Search Field of study..."/> 
					</div>
				</div> 
				<div class="col-md-3">  
					<select class="form-control form-control-sm border">
						<option value="" selected="">Institute</option>
					</select>
				</div> 
				<div class="col-md-2">  
					<select class="form-control form-control-sm border">
						<option value="" selected="">Entire Malaysia</option>
					</select>
				</div>   
				<div class="col-md-3">  
					<select class="form-control form-control-sm border">
						<option value="" selected="">Qualification</option>
					</select>
				</div>   
			</div>
 
			@include('employer.includes.candidate_type')
			<hr style="margin-top:0.1em;margin-bottom:0.1em"> 
		</div>
		 
		<div class="col-sm-8 pl-sm-5 pl-4">
			@if($statusSet[0]->status == 'ENABLE')
				@if($candidateSet[3]->status == 'YES')
				<div class="row my-1"> 
					<div class="container">   
					    <div class="row justify-content-center vertical-center"> 
							<div class="col-sm">
								<div class="row"> 
									<div class="col-sm col-md pt-1">
										<div class="col-sm col-md">  
											<h4>Name</h4> 
											<div class="btn-group float-right">
								                <a class="btn btn-outline-dark btn-sm" title="Resume attached"><i class="fa fa-file-pdf"></i></a> 
								                <a class="btn btn-outline-dark btn-sm" href="#">
							                    	Buy
								                </a> 
								            </div>
										</div>
										<div class="col-sm col-md"><h6><i class="fa fa-book"></i>  Education</h6></div>
										<div class="col-sm col-md"><h6><i class="fa fa-map-marker"></i> LOC</h6></div>
										<div class="col-sm col-md small">
											<span><i class="fa fa-graduation-cap"></i> <font class="text-primary">Fresh</font></span> 
											<span><i class="fa fa-university"></i> Institute</span>
										</div> 
									</div>
								</div>
							</div>
						</div> 
						<hr> 
					    <div class="row justify-content-center vertical-center"> 
							<div class="col-sm">
								<div class="row"> 
									<div class="col-sm col-md pt-1">
										<div class="col-sm col-md">  
											<h4>Name</h4> 
											<div class="btn-group float-right"> 
								                <a class="btn btn-outline-dark btn-sm" href="#">
							                    	Buy
								                </a> 
								            </div>
										</div>
										<div class="col-sm col-md"><h6><i class="fa fa-book"></i>  Education</h6></div>
										<div class="col-sm col-md"><h6><i class="fa fa-map-marker"></i> LOC</h6></div>
										<div class="col-sm col-md small">
											<span><i class="fa fa-briefcase"></i> <font class="text-danger">Experience</font></span> 
											<span><i class="fa fa-building"></i> Company</span>
										</div> 
									</div>
								</div>
							</div>
						</div>  
						<hr style="margin-bottom:0.1em">
				    </div><!--container-->  
				</div> 
				@else 
					{{$candidateSet[3]->message}}
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