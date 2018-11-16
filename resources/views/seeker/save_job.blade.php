@extends('layouts.master')

@section('title', 'Application History')

@section('content')     
<main class="py-0">   
	<div class="row border border border-dark  mr-0 mx-1">  
		<div class="col-sm pl-sm-5 pt-sm-1 pt-0 pl-4">
			<h3 class="font-weight-bold">Saved Job</h3>  
			<hr style="margin-bottom:0.1em">   
			@if ($message = Session::get('save'))
			<div class="alert alert-success alert-block mt-2">
				<button type="button" class="close" data-dismiss="alert">×</button> 
				<strong>{{ $message }}</strong>
			</div>
          	@endif 
			@if($save->total() > 0 )   
				<div class="row mt-3">
		          	<div class="col-sm col-md">
		           	 	Page {{$save->count()}} of {{$save->total()}}
		          	</div> 
		        </div> 
				<div class="row mr-1"> 
				@foreach ($save as $saveDtl)  
					<div class="col-sm-4 py-1 border border-dark">
						<div class="col-sm col-md"> 
							<a href="{{ url('ViewJob') }}/{{str_replace(' ', '-', $saveDtl->jobpost_position)}}/{{$saveDtl->job_id}}" target="_blank"> 
								<h4>{!! $saveDtl->jobpost_position !!}</h4>
							</a>  
						</div>
						<div class="col-sm col-md">
							<h6><i class="fa fa-building"></i> {!!$saveDtl->emp_name!!}</h6>
						</div>
						<div class="col-sm col-md">
							<h6><i class="fa fa-map-marker-alt"></i>&nbsp;
								{{ $saveDtl->jobpost_loc_state }}
							</h6>
						</div>
						<div class="col-sm col-md small">
							<span>
								<a href="{{route('unsave_job')}}?id={{$saveDtl->id}}" data-toggle="tooltip" data-placement="top" title="Unsave this job"><i class="fas fa-star"></i> Unsave job
		                        </a>
							</span> 
						</div>
						<div class="col-sm col-md small">
							<span><i class="fa fa-calendar-alt"></i> Posted on&nbsp;
							{{ date('d F Y', strtotime($saveDtl->jobpost_startDate)) }} 
							</span>
							<span class="float-sm-right d-block">
								@if(isset($saveDtl->appl_id)) 
									<span class="badge badge-danger fa-lg">Job applied</span>
								@endif 
							</span>
						</div>
					</div>
				@endforeach
				</div> 
				<hr class="ml-sm-2">
				<nav aria-label="pagination" class="mt-2 d-flex justify-content-center">
		          {{ $save->links('vendor.pagination.bootstrap-4') }}
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
