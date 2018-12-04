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
		@foreach($paidC as $paid)   
			<?php
				$array_paid = $paid->seekerDtl->id; 	 
				$final_paid[] = $array_paid;									
			?>   
		@endforeach

		<div class="col-sm-3 pl-sm-5 pl-4"> 
			<h5>Candidates filter <i class="fas fa-filter float-right"></i></h5> 
			<!-- FILTER MENU CANDIDATES START -->
			@include('employer.includes.candidate_type')
			<!-- FILTER MENU CANDIDATES END -->  
			<h5>Advance search <i class="fab fa-searchengin float-right"></i></h5> 
			<!-- FILTER ADVANCE SEARCH START -->
			@include('employer.includes.advancesearch') 
			<!-- FILTER ADVANCE SEARCH END -->   
		</div>
		@if($statusSet[0]->status == 'ENABLE')
			@if($candidateSet[1]->status == 'YES')
				@if( isset($currToken) AND ($currToken->balance > 0 AND $currToken->expired_date > date('Y-m-d')) )
					@if($seekers->total() > 0) 
					<div class="col-sm pl-sm-5 pl-4">
						<hr class="d-lg-none">
						<h6>Available: {{$totalSeeker->total-$totalTakenResume->total}} candidates</h6> 
						<h6 class="font-weight-normal">Candidate: {{$seekers->count()}} of {{$seekers->total()}}</h6>
						<hr class="d-lg-none">
						@foreach($seekers as $seeker)    
							@if(! in_array($seeker->seeker_id, $final_paid) )  
						    <div class="row justify-content-center vertical-center"> 
								<div class="col-sm">
									<div class="row"> 
										<div class="col-sm col-md pt-1">
											<div class="col-sm col-md">  
												<div class="btn-group float-right">
													@if(file_exists(public_path().'/document/uploadsCV/'.$seeker->seeker_resume_location))
									                <a class="btn btn-outline-dark btn-sm resume_attach" title="Resume attached" data-toggle="tooltip" data-placement="top">
									                	<i class="fa fa-file-pdf"></i>
									                </a>   
									                @endif

									                <button class="btn btn-outline-primary btn-sm buy_candidate" data="&employer={{Auth::guard('employer')->user()->employer[0]->id}}&seeker={{$seeker->seeker_id}}&tokenVal={{$duration->token_value}}&duration={{$duration->duration}}&type=EXPERIENCE">
								                    	Buy
									                </button> 
									                <!-- Modal #buy_candidate --> 
			                						@include('employer.candidate.experience.modal')  
									            </div>

												<h4 class="text-uppercase">{!! $seeker->seeker_name !!}</h4>  
											</div>
											<div class="col-sm col-md">
												<h6>
													<i class="fa fa-book"></i>&nbsp;
													{{$seeker->highest_education}} - 
													{{$seeker->field_of_study}}
													@if($seeker->highest_education != 'SPM')
														&nbsp;-&nbsp;
														{{$seeker->field_of_study}}
														@if($seeker->major_study != '')
															({{ str_replace('( ', '(', ucwords(str_replace('(', '( ', strtolower($seeker->major_study)))) }})  
														@endif
													@endif 
												</h6>
											</div>
											<div class="col-sm col-md">
												<h6><i class="fa fa-map-marker-alt"></i>&nbsp;
													@if($seeker->seeker_city != '')
													{{$seeker->seeker_city}}, {{$seeker->seeker_state}}
													@else
													{{$seeker->seeker_state}}
													@endif
												</h6>
											</div>
											<div class="col-sm col-md small"> 
												@if(isset($seeker->experience[0])) 
													@if($seeker->experience[0]->exp_company != '') 
													<span><i class="fa fa-building"></i>&nbsp; 
														{{ str_replace('( ', '(', ucwords(str_replace('(', '( ', strtolower($seeker->experience[0]->exp_company)))) }} - {{$seeker->seeker_noYrsExp}} years experience
													</span>
													@endif 
												@else
													<span><i class="fa fa-building"></i>&nbsp;  
														{{$seeker->seeker_noYrsExp}} years experience
													</span>
												@endif  
											</div> 
										</div>
									</div>
								</div>
							</div> 
							<hr>   
							@endif   
						@endforeach  
						<nav class="table-responsive" aria-label="pagination">
			                {{ $seekers->links('vendor.pagination.bootstrap-4') }}
		              	</nav>   
					</div> 
					@else  
			        <div class="col-sm mb-1">
			          <img src="{{asset('public/images/icon/search_not_found.png')}}" style="pointer-events:none;width:250px;display: block;margin-left: auto;margin-right: auto;"/>
			        </div>
	    			@endif 
				@else
			        <div class="col-sm  pl-sm-5 pl-4 mb-1">
			          	<p>
			          		Your account balance is insufficient OR Your account package is already expired OR You dont have subcribe with our packages. Go to &#39;Plans & Billing Settings&#39; to check your balance. <a href="{{route('employer.setting.plan')}}">Here</a>
			      		</p>
			        </div> 
				@endif
			@else  
				<div class="col-sm  pl-sm-5 pl-4 mb-1">
		          <p>{{$candidateSet[1]->message}}</p>
		        </div> 
			@endif
		@else 
	        <div class="col-sm  pl-sm-5 pl-4 mb-1">
	          <p>{{$statusSet[0]->message}}</p>
	        </div> 
		@endif
	</div>
</main>    