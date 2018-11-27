@extends('layouts.master') 
@section('title', 'Resume View')

@section('content')     
<main class="py-0">  
	<div class="row my-1 mx-2">
		<div class="col-sm-12">
			<h3>Profile</h3>
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
		                            <h5 class="mt-2"><span class="fa fa-file float-right"></span> Resume</h5>
		                            <button class="btn btn-sm btn-primary my-1" data-toggle="tooltip" data-placement="top" title="Update New Resume">
		                            	<i class="fa fa-edit"></i> Update New
		                            </button>
		                            <?php 

										$updated_at = date_create($seek->resume->updated_at);
										$now = date_create(date('Y-m-d h:i:s'));
										$diff = date_diff($updated_at, $now);
										$day = intval($diff->format("%a"));
		                            ?>
	                            	@if(file_exists(public_path().'/document/uploadsCV/'.$seek->resume->resume_loc) AND $day < 30)  
		                            <input type="hidden" name="resume_updated" value="{{$seek->resume->updated_at}}">
		                            <h6>Updated on: <span id="updateresumejs"></span></h6>
						      		<h2 class="text-center">{{ucwords(strtolower($seek->seeker_name))}}&#39;s Resume</h2> 
									<div class="text-center">
										<embed 
										    src="{{ action('DocumentController@getDocument', ['id'=> $seek->resume->resume_loc]) }}#toolbar=0"
										    style="width:100%; height:655px;"
										    frameborder="0"
										>
									</div>
									@else 
						      		<h2 class="text-center">{{ucwords(strtolower($seek->seeker_name))}}&#39;s Profile</h2>
						      		<div class="text-center">
										<p>
											Your resume is outdated. Update new one to proceed the next phase.
											Your resume will be 30 days after upload it.
										</p>
									</div>
									@endif
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