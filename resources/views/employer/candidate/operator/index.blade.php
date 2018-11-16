<main class="py-0"> 
	@include('employer.includes.menu')  
	<div class="row border border border-dark  mr-0 mx-1">
		<div class="col-sm-12 pl-sm-5 pt-sm-1 pt-0 pl-4">
			<h3 class="text-primary">Search Candidates</h3>  
			<hr style="margin-bottom:0.1em">   
			<!-- FILTER CANDIDATE START -->
			@include('employer.includes.candidate_filter')
			<!-- FILTER CANDIDATE END --> 
		</div> 
 		

		{{--@foreach($paidC as $paid)   --}}
			<?php
				//$array_paid = $paid->seekerDtl->id; 	 
				//$final_paid[] = $array_paid;									
			?>   
		{{--@endforeach  --}}
		<div class="col-sm-3 pl-sm-5 pl-4"> 
			<h5>Candidates filter <i class="fas fa-filter float-right"></i></h5> 
			<!-- FILTER MENU CANDIDATES START -->
			@include('employer.includes.candidate_type')  
			<!-- FILTER MENU CANDIDATES END -->  
			<h5>Advance search <i class="fab fa-searchengin float-right"></i></h5> 
			<!-- FILTER ADVANCE SEARCH START -->
			{{-- @include('employer.includes.advancesearch')   --}}
			<!-- FILTER ADVANCE SEARCH END -->   
			<hr>
			<h6 class="font-weight-normal">Availability</h6> 
			<ul class="small" style="list-style:none;">
				<li class="">
					<a href="" class="gender" data="">All</a>
				</li>
				<?php 
					$arrayAvail = array('Two (2) weeks', 'One (1) week', 'One (1) month', 'Immediately');
					sort($arrayAvail);
				?>
				@foreach($arrayAvail as $avail)
				<li class="">
					<a href="" class="availability" data="{{$avail}}">{{$avail}}</a> 
				</li>
				@endforeach
			</ul> 
			<h6 class="font-weight-normal">Gender</h6> 
			<ul class="small" style="list-style:none;">
				<li class="">
					<a href="" class="gender" data="">All</a>
				</li>
				<li class="">
					<a href="" class="gender" data="M">Male</a> 
				</li>
				<li class=""> 
					<a href="" class="gender" data="F">Female</a>
				</li>
			</ul> 
			<h6 class="font-weight-normal">Work Experience</h6> 
			<ul class="small" style="list-style:none;">
				<li class="">
					<a href="" class="gender" data="">All</a>
				</li>
				<li class="">
					<a href="" class="gender" data="Yes">Yes</a> 
				</li>
				<li class=""> 
					<a href="" class="gender" data="No">No</a>
				</li>
			</ul> 
		</div>
		@if($statusSet[0]->status == 'ENABLE') 
			@if($candidateSet[3]->status == 'YES')
				@if($seekers->total() > 0)
				<div class="col-sm pl-sm-5 pl-4"> 
					<hr class="d-lg-none">
					<h6>Available: {{-- $totalSeeker->total-$totalTakenResume->total --}} candidates</h6> 
					<h6 class="font-weight-normal">Candidate: {{ $seekers->count().' of '.$seekers->total() }}</h6>
					<hr class="d-lg-none">
					@foreach($seekers as $seeker)  
						{{-- @if(! in_array($seeker->seeker_id, $final_paid) )   --}}
							<div class="row">  
								<div class="col-sm col-md">  
									<div class="float-right"> 
						                <button class="btn btn-outline-primary btn-sm buy_candidate" data="&employer=">
					                    	Buy
						                </button> 
						                <!-- Modal #buy_candidate -->
										<div class="modal fade" tabindex="-1" role="dialog" id="buy_candidate_modal">
										  	<div class="modal-dialog modal-sm" role="document">
											    <div class="modal-content">
											      	<div class="modal-header">
											        	<h5 class="modal-title" id="buy_candidateLabel">
											        		Buy candidate profile
											        	</h5>
											        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											          		<span aria-hidden="true">&times;</span>
											        	</button>
											      	</div>
											      	<div class="modal-body">
											        	<h5>Your remaining tokens:  {{-- $currToken->balance --}}
											        		<a href="{{route('employer.setting.plan')}}" class="small">Add topup</a>
											        	</h5>
														<div>
															Click "Buy" to purchase <span class="font-weight-bold">or</span> "Abort" to cancel the purchasing.
														</div> 
														<div class="d-sm-flex justify-content-center mt-2">
															<button class="btn btn-md btn-danger" data-dismiss="modal">Abort</button>
															<button type="button" id="" class="btn btn-md btn-primary submit_buy ml-3">Buy</button>
														</div>
														<hr>
														<div class="small font-italic">
															Notes: <span class="font-weight-bold">{{-- $duration->token_value --}}</span> token will be deduct after purchase the profile. This profile available to view for <span class="font-weight-bold">{{-- $duration->duration --}}</span> after purchase.
														</div>
											      	</div> 
										    	</div>
										  	</div>
										</div>
						            </div>

									<h4 class="text-uppercase">{!! $seeker->name !!}</h4>  
								</div>
							</div>
							<div class="row"> 		
								<div class="col-sm col-md">
									<h6><i class="fa fa-map-marker-alt"></i>&nbsp;
										@if($seeker->district != '')
											{{$seeker->poscode.' '.$seeker->district.', '.$seeker->state}}
										@else
											{{$seeker->poscode.' '.$seeker->state}}
										@endif
									</h6>
								</div>
							</div>
							<div class="row"> 
								<div class="col-sm col-md">
									<h6>
										<i class="fa fa-birthday-cake"></i>&nbsp; 
										<?php
											$nric = $seeker->nric;
											if(strlen($nric) == 12){
												$array = str_split($nric,6); 
												$array1 = str_split($nric,2);  
												$array2 = str_split($nric,4);  

												$rawDOB = $array[0]; //901010
												$arrayDOB = str_split($rawDOB,2); 
												//echo $arrayDOB[0].'\n'..'\n'.$arrayDOB[2]; 
												$date = $arrayDOB[0]; 
												$dates = DateTime::createFromFormat('y', $date); 
												$year = $dates->format('Y');    
												$breakDOB = $year.'-'.$arrayDOB[1].'-'.$arrayDOB[2];
												$DOB = $arrayDOB[2].'/'.$arrayDOB[1].'/'.$year;


												//$age = date('Y-m-d') - date('Y-m-d', strtotime($breakDOB));
												$tz  = new DateTimeZone('Asia/Kuala_Lumpur');
												$age = DateTime::createFromFormat('d/m/Y', $DOB, $tz)
												     ->diff(new DateTime('now', $tz))
												     ->y;

												$rawIC = $array2[2]; 
												if($rawIC%2 == 0) $gender ='Female';
												else $gender ='Male'; 
											} 
										?>
										{{$age.' years old'}} 
										&nbsp;<i class="fa fa-user"></i>&nbsp;{{$gender}} 
									</h6>
								</div>
							</div>
							<div class="row"> 		
								<div class="col-sm col-md small"> 
									@if($seeker->availability_work != '')  
								 	<div>
								 		<i class="fa fa-check"></i>&nbsp;
								  		{{ $seeker->availability_work }} 
								  	</div> 
									@endif
									<div>
										<i class="fas fa-registered"></i>&nbsp;
										{{date('M jS, Y', strtotime($seeker->sign_up))}} 
									</div>
								</div>  
							</div> 
						<hr>   
						{{-- @endif --}}
					@endforeach
					<nav class="table-responsive" aria-label="pagination">
		                {{$seekers->links('vendor.pagination.bootstrap-4')}}
		          	</nav>   
				</div> 
				@else
		        <div class="col-sm mb-1">
		          <img src="{{url('images/icon/search_not_found.png')}}" style="pointer-events:none;width:250px;display: block;margin-left: auto;margin-right: auto;"/>
		        </div>
    			@endif
			@else  
			<div class="col-sm  pl-sm-5 pl-4 mb-1">
	          <p>{{$candidateSet[3]->message}}</p>
	        </div> 
			@endif
		@else 
        <div class="col-sm  pl-sm-5 pl-4 mb-1">
          <p>{{$statusSet[0]->message}}</p>
        </div> 
		@endif
	</div>
</main>   