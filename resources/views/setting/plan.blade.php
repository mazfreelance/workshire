@extends('layouts.master')

@section('title', 'Plans & Billing Settings')

@section('content')     
<main class="py-0 mb-5"> 
	<div class="row my-1 mx-2">
		<div class="col-sm-12">
			<h3 class="text-primary">Setting</h3> 
			<p style="margin-bottom:-0.2em;">You can set your account</p>
			<hr>   
		</div>   
		<div class="col-sm-12">  
		  	<div class="row justify-content-around">
			    <div class="col-md-4 border border-dark">
			    	<h5 class="mt-2">You</h5>
					@include('setting.includes.nav')
			    </div>
			    <div class="col-md-7 mt-sm-0 mt-2 border border-dark">
			      	<div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">   
						<div class="tab-pane fade {{Request::path() == 'employer/setting/plan' ? 'show active':''}}" id="nav-plan-billing" role="tabpanel" aria-labelledby="nav-plan-billing-tab"> 
							<h5 class="my-2"><span class="fa fa-truck float-right"></span> Plans & Billing Settings</h5>  
							<span class="d-block"><a href="{{route('employer.invoice')}}"><i class="fas fa-file-invoice"></i> Invoice</a></span> 
							<span class="d-block">Member since: {{date('jS F Y', strtotime(Auth::user()->employer[0]->created_at))}}</span>
							<span class="d-block">Your subscriptions:</span> 
							<ol>
								@if(isset($tokenPs))
								<li>Job Posting: {{ isset($plans_P) ? $plans_P->description : ''}}
									<ul class="ml-4"> 
										@if($tokenPs->package_plan == 'P|26') 
										<li>Token Balance:&nbsp;{{ __('Free') }}</li> 
										@else
										<li>Token Balance:&nbsp;{{$tokenPs->balance}}</li>
										<li>Token Taken: </li>
										<li>Expired date: {{date('jS F Y', strtotime($tokenPs->expired_date))}}</li>
										@endif
									</ul>
								</li>
								@else
								<li>Job Posting: N/A</li>
								@endif

								@if(isset($tokenRs))
								<li>Resume: {{ isset($plans_R) ? $plans_R->description : ''}}
									<ul class="ml-4">
										@if($tokenRs->package_plan == 'V|25') 
										<li>Token Balance:&nbsp;{{ __('Free') }}</li>
										@else
										<li>Expired date: {{date('jS F Y', strtotime($tokenRs->expired_date))}}</li> 
										<li>Token Balance:&nbsp;{{$tokenRs->balance}}</li> 
										@endif
										<li>Token Taken: {{$totalTakenResume->total}}
											<ol>
											@if(isset($totalTakenResumeFresh->total))
												<li>Fresh: {{$totalTakenResumeFresh->total}}</li>
											@endif
											@if(isset($totalTakenResumeExp->total))
												<li>Experience: {{$totalTakenResumeExp->total}}</li>
											@endif 
											</ol>
										</li> 
									</ul> 
								</li>
								@else
								<li>Resume: N/A</li>
								@endif
							</ol>

							@if(isset($tokenPs) AND isset($tokenRs))
								@if($tokenRs->expired_date < date('Y-m-d') AND $tokenPs->package_plan == 'P|26')
							 	<span class="d-block">
									<button type="submit" class="btn btn-info">Renew Package</button>
								</span>
								<span class="d-block mt-3">
									<a href="" class="">See our price</a>
								</span>
								@elseif($tokenRs->expired_date < date('Y-m-d') AND ($tokenPs->package_plan != 'P|26' AND $tokenPs->expired_date < date('Y-m-d')))
								<span class="d-block">
									<button type="submit" class="btn btn-info">Renew Package</button>
								</span>
								<span class="d-block mt-3">
									<a href="" class="">See our price</a>
								</span>
								@endif
							@else
							<span class="d-block">
								<button type="submit" class="btn btn-success" onClick="location.href='{{route('employer.pricing')}}'">Add Package</button>
							</span> 
							@endif
							
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