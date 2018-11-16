<main class="py-0">  
	<div class="row border border border-dark border-top-0  mr-0 mx-1">
		<div class="col-sm-12 pl-sm-5 pt-sm-1 pt-0 pl-4">
			<h3 class="text-primary">Paid Candidates</h3>
			<h6>You have bought {{$totalTakenResume->total}} candidates</h6> 
			<hr style="margin-bottom:0.1em">  
			<!-- FILTER CANDIDATE START -->
			@include('employer.includes.candidate_filter')
			<!-- FILTER CANDIDATE END -->  
		</div>   
		@foreach($exp as $exps)   
			<?php
				$array_exp = $exps->seeker_id; 	 
				$final_exp[] = $array_exp;									
			?>   
		@endforeach 
		<div class="col-sm-3 pl-sm-5 pl-4"> 
			<h5>Candidates filter <i class="fas fa-filter float-right"></i></h5> 
			<!-- FILTER MENU CANDIDATES START -->
			@include('employer.includes.candidate_type')
			<!-- FILTER MENU CANDIDATES END -->   
		</div>
		<div class="col-sm pl-sm-5 pl-4">   
			@if($paid_candidate->total() > 0)   
			<div class="d-block">Candidate: {{$paid_candidate->count()}} of {{$paid_candidate->total()}}</div>
			@foreach($paid_candidate as $paids)   
		    <div class="row">   
				<div class="col-sm col-md">  
					<div class="btn-group float-right"> 
						@if(file_exists(public_path().'/document/uploadsCV/'.$paids->seeker_resume_location))
		                <a class="btn btn-outline-dark btn-sm resume_attach" title="Resume attached" data-toggle="tooltip" data-placement="top">
		                	<i class="fa fa-file-pdf"></i>
		                </a>   
		                @endif 
		                <?php 
		                	if(in_array($paids->seeker_id, $final_exp) )
		                		$dur = $duration[1];
		                	else 
		                		$dur = $duration[0];
		                ?>  
						@if( date('Y-m-d', strtotime($paids->expiredDate)) < date('Y-m-d'))
			                <a 	class="btn btn-outline-primary btn-sm buy_candidate" href="" 
		                		data="&employer={{Auth::guard('employer')->user()->employer[0]->id}}
	                				&seeker={{$paids->seeker_id}}
	                				&tokenVal={{$dur->token_value}}
	                				&duration={{$dur->duration}}
	                				&type=OPERATOR&statBuy=Renew
	                				&paidID={{$paids->id}}"
	                			data-duration="{{$dur->duration}}"
	                			data-token="{{$dur->token_value}}">
		                    	Renew
			                </a> 
			                <!-- Modal #buy_candidate -->
							<div class="modal fade" tabindex="-1" role="dialog" id="buy_candidate_modal">
							  	<div class="modal-dialog modal-sm" role="document">
								    <div class="modal-content">
								      	<div class="modal-header">
								        	<h5 class="modal-title" id="buy_candidateLabel">
								        		Renew candidate profile 
								        	</h5>
								        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          		<span aria-hidden="true">&times;</span>
								        	</button>
								      	</div>
								      	<div class="modal-body">
								        	<h5>
								        		Your remaining tokens:  {{ isset($currToken) ? $currToken->balance : 'Please add new token to proceed'}} 
								        	</h5> 
								        	<a href="" class="small">Add topup</a>
											<div>
												Click "Renew" to purchase <span class="font-weight-bold">or</span> "Abort" to cancel the purchasing.
											</div> 
											<div class="d-sm-flex justify-content-center mt-2">
												<button class="btn btn-md btn-danger" data-dismiss="modal">Abort</button>
												@if(isset($currToken))
												<button type="button" id="" class="btn btn-md btn-primary submit_buy ml-3">Renew</button>
												@else 
												<button type="button" id="" class="btn btn-md btn-primary ml-3" disabled>Renew</button> 
												@endif
											</div>
											<hr>
											<div class="small font-italic">
												Notes: <span class="font-weight-bold" id="token_value"></span> token will be deduct after purchase the profile. This profile available to view for <span class="font-weight-bold" id="dur_token"></span> after purchase.
											</div>
								      	</div> 
							    	</div>
							  	</div>
							</div>
						@else 
			                <a class="btn btn-outline-success btn-sm" href="{{url('employer/applicant/profile/seeker/'.encrypt($paids->seeker_id))}}" target="_blank">
		                    	View
			                </a>
						@endif
		            </div>
					<h4 class="text-uppercase">{{$paids->seeker_name}}</h4> 
				</div>
			</div>
		    <div class="row">   
				<div class="col-sm col-md">
					<h6><i class="fa fa-book"></i>&nbsp;
						{{$paids->highest_education}}
						@if($paids->highest_education != 'SPM')
							&nbsp;-&nbsp;
							{{$paids->field_of_study}}
							@if($paids->major_study != '')
								({!! str_replace('( ', '(', ucwords(str_replace('(', '( ', strtolower($paids->major_study)))) !!})  
							@endif
						@endif 
					</h6>
				</div>
			</div>
		    <div class="row"> 
				<div class="col-sm-3">
					<h6><i class="fa fa-map-marker-alt"></i>&nbsp;
						@if($paids->seeker_city != '')
						{{$paids->seeker_city}}, {{$paids->seeker_state}}
						@else
						{{$paids->seeker_state}}
						@endif
					</h6>
				</div>
				<div class="col-sm-4">
					<h6>
						@if(in_array($paids->seeker_id, $final_exp) )   
						<i class="fa fa-briefcase"></i>
						<span class="text-info"> Experience</span> 
						@else
						<i class="fa fa-user-graduate"></i> 
						<span class="text-primary"> Fresh</span> 
						@endif 
					</h6>
				</div>
			</div>
		    <div class="row"> 
				<div class="col-sm col-md">
					<h6 class="small">  
						@if( date('Y-m-d', strtotime($paids->expiredDate)) < date('Y-m-d') )
						<span class="badge badge-danger"><i class="fa fa-info-circle"></i>  Expired</span> 
						@else 
							@if( $paids->buy_stat == 'New' )
							<span class="badge badge-success"><i class="fa fa-info-circle"></i>  Paid</span>
							<span>(Last date: {{ date('M d, Y', strtotime($paids->expiredDate)) }})</span>
							@else
							<span class="badge badge-primary"><i class="fa fa-info-circle"></i>  Renew</span>
							<span>(Last date: {{ date('M d, Y', strtotime($paids->expiredDate)) }})</span>
							@endif
						@endif 
					</h6>
				</div>  
						 
			</div> 
			<hr>
			@endforeach  
			<nav class="table-responsive" aria-label="pagination">
                {{ $paid_candidate->links('vendor.pagination.bootstrap-4') }}
          	</nav>   
			@else  
		        <div class="row my-1">
		          <img src="{{url('images/icon/search_not_found.png')}}" style="pointer-events: none;"/>
		        </div>
			@endif
		</div>
	</div>
</main>  