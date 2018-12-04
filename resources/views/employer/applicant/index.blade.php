<main class="py-0">    
	@include('employer.includes.menu')
	<div class="row border border border-dark  mr-0 mx-1">
		<div class="col-sm-12 pl-sm-5 pt-sm-1 pt-0 pl-4">
			<h3>Applicant for {{$jobName}}'s Position</h3> 
			<hr style="margin-bottom:0.1em">
		</div> 
		<div class="col-sm my-1 pl-sm-5 pl-4">
			@if($jobAppls->total() > 0)  
			@foreach($jobAppls as $jobAppl) 
			    <div class="row justify-content-center vertical-center"> 
					<div class="col-sm">
						<div class="row"> 
							<div class="col-sm col-md">
								<div class="col-sm col-md">  
									<h4 class="text-uppercase">{{$jobAppl->seeker_name}}</h4>
									<div class="btn-group float-right"> 

						                <?php $code = $jobAppl->appl_seeker.'|'.$jobAppl->appl_jobpostid.'|'.$jobName.'|'.$id; ?>

						                @if($jobAppl->appl_process_status == 'KIV') 
							                <a class="btn btn-outline-info btn-sm profile" href="{{url('employer/applicant/profile/seeker/'.encrypt($jobAppl->appl_seeker))}}" data-toggle="tooltip" data-placement="top" title="View {{$jobAppl->seeker_name}}&#39;s profile" target="_blank">
						                    	<i class="fa fa-user"></i>
							                </a> 

											<a class="btn btn-outline-success btn-sm check" href="javascript:ajaxLoad_redirect('{{url('employer/status_applicant/'.'Accept|'.$code)}}')" data-toggle="tooltip" data-placement="top" title="Accept">
						                    	<i class="fa fa-check"></i>
							                </a>  	
							                <a class="btn btn-outline-danger btn-sm times" href="javascript:ajaxLoad_redirect('{{url('employer/status_applicant/'.'Reject|'.$code)}}')" data-toggle="tooltip" data-placement="top" title="REJECT">
						                    	<i class="fa fa-times-circle"></i>
							                </a> 
										@elseif($jobAppl->appl_process_status == 'Processing') 
											<a class="btn btn-outline-success btn-sm check" href="javascript:ajaxLoad_redirect('{{url('employer/status_applicant/'.'KIV|'.$code)}}')" data-toggle="tooltip" data-placement="top" title="KIV">
						                    	<i class="fa fa-check"></i>
							                </a> 
							                <a class="btn btn-outline-danger btn-sm times" href="javascript:ajaxLoad_redirect('{{url('employer/status_applicant/'.'Reject|'.$code)}}')" data-toggle="tooltip" data-placement="top" title="REJECT">
						                    	<i class="fa fa-times-circle"></i>
							                </a> 
							                
							            @elseif($jobAppl->appl_process_status == 'Accept' OR $jobAppl->appl_process_status == 'Reject') 
							                <a class="btn btn-outline-info btn-sm profile" href="{{url('employer/applicant/profile/seeker/'.encrypt($jobAppl->appl_seeker))}}" data-toggle="tooltip" data-placement="top" title="View {{$jobAppl->seeker_name}}&#39;s profile" target="_blank">
						                    	<i class="fa fa-user"></i>
							                </a>  
										@endif  
						            </div>
								</div>
								<div class="col-sm col-md">
									<h6>
										<i class="fa fa-graduation-cap"></i>&nbsp;
										{{$jobAppl->highest_education}}
										@if($jobAppl->highest_education != 'SPM')
											&nbsp;-&nbsp;
											{{$jobAppl->field_of_study}}
											@if($jobAppl->major_study != '')
												({{ str_replace('( ', '(', ucwords(str_replace('(', '( ', strtolower($jobAppl->major_study)))) }})  
											@endif
										@endif 
									</h6>
								</div>
								<div class="col-sm col-md">
									<h6>
										<i class="fa fa-map-marker"></i>&nbsp; 
										@if($jobAppl->seeker_city != '')
										{{$jobAppl->seeker_city}}, {{$jobAppl->seeker_state}}
										@else
										{{$jobAppl->seeker_state}}
										@endif
									</h6>
								</div> 
								<div class="col-sm col-md small">
									<span><i class="fa fa-calendar"></i> Applied on {{date('M d, Y' , strtotime($jobAppl->appl_date))}}</span>
									<span class="float-right">Status:&nbsp; 
										@if($jobAppl->appl_process_status == 'Accept') 
											<span class="badge badge-success fa-lg">{{__('Accepted')}}</span>
										@elseif($jobAppl->appl_process_status == 'KIV') 
											<span class="badge badge-info fa-lg">{{__('Viewed')}}</span> 
										@elseif($jobAppl->appl_process_status == 'Reject') 
											<span class="badge badge-danger fa-lg">{{__('Rejected')}}</span>	
										@elseif($jobAppl->appl_process_status == 'Processing') 
											<span class="badge badge-primary fa-lg">{{$jobAppl->appl_process_status}}</span> 
										@endif 
									</span>
								</div>
							</div>
						</div>
					</div>
				</div> 
				<hr> 
				@endforeach
				<nav aria-label="pagination" class="mt-2 d-flex justify-content-center">
                	{{ $jobAppls->links('vendor.pagination.bootstrap-4') }}
              	</nav>  
			@else 
			    <div class="row justify-content-center vertical-center mb-5"> 
					<div class="col-sm mb-5">
						<p>No applicant found.</p>
					</div>
				</div>
			@endif
		</div> 
	</div> 
</main> 