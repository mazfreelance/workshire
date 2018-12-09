@extends('layouts.master')

@section('title', 'Application History')

@section('content')     
<main class="py-0">   
	<div class="row border border border-dark  mr-0 mx-1">
		<div class="col-sm pl-sm-5 pt-sm-1 pt-0 pl-4">
			
			@if (session('success'))
	            <div class="alert alert-success">
	                {{ session('success') }}
	                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                  <span aria-hidden="true">&times;</span>
	                </button>
	            </div>
	        @endif
			
			<h3 class="font-weight-bold">Application History
				<a class="btn btn-sm btn-third" href="{{route('main')}}">Apply new job now</a>
			</h3>  
			<hr style="margin-bottom:0.1em">     
			@if($appls->total() > 0 )   
				@foreach ($appls as $applicant)  
				<div class="row"> 
					<div class="col-sm col-md py-1">
						<div class="col-sm col-md"> 
							<a href="{{ url('ViewJob') }}/{{str_replace(' ', '-', $applicant->jobpost->jobpost_position)}}/{{$applicant->jobpost->id}}" target="_blank">

								<h4>{!! $applicant->jobpost->jobpost_position !!}</h4>
							</a>  
						</div>
						<div class="col-sm col-md">
							<h6><i class="fa fa-tag"></i>&nbsp;
								{!! $applicant->jobpost->jobpost_field_study !!}
							</h6>
						</div>
						<div class="col-sm col-md">
							<h6><i class="fa fa-map-marker"></i> {{ $applicant->jobpost->jobpost_loc_state }}</h6>
						</div>
						<div class="col-sm col-md small">
							<span><i class="fa fa-building"></i> {!! $applicant->employer->emp_name !!}</span> 
						</div>
						<div class="col-sm col-md small">
							<span><i class="fa fa-calendar"></i> Applied on&nbsp;
							{{ date('d F Y', strtotime($applicant->appl_date)) }} 
							</span>
							<span class="float-sm-right d-block">Status:&nbsp; 
								@if($applicant->appl_process_status == 'Accept') 
									<span class="badge badge-success fa-lg">{{__('Accepted')}}</span>
								@elseif($applicant->appl_process_status == 'KIV') 
									<span class="badge badge-info fa-lg">{{__('Viewed')}}</span> 
								@elseif($applicant->appl_process_status == 'Reject') 
									<span class="badge badge-danger fa-lg">{{__('Rejected')}}</span>	
								@elseif($applicant->appl_process_status == 'Processing') 
									<span class="badge badge-primary fa-lg">{{$applicant->appl_process_status}}</span> 
								@endif 
							</span>
						</div>
					</div>
				</div> 
				<hr class="ml-sm-2">
				@endforeach
				<nav aria-label="pagination" class="mt-2 d-flex justify-content-center">
		          {{ $appls->links('vendor.pagination.bootstrap-4') }}
		        </nav>    
		    @else
				<div class="col-sm" style="height:250px;">  
					<div class="row justify-content-center vertical-center"> 
						<div class="col-sm">
							<div class="row pl-sm-5 bg-primary text-light"> 
								<div class="col-sm col-md py-1 fa-2x">
									No data found <span class="fa fa-exclamation"></span>
								</div>
							</div>
						</div>
					</div> 
				</div>
			@endif 
		</div>   
	</div>
</div>
<!-- Footer -->  
@include('includes.footer') 

@endsection
