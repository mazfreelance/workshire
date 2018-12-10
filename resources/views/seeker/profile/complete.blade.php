@extends('layouts.master') 
@section('title', 'Profile Complete')

@section('content')     
<main class="pb-5">   
	<div class="container py-2">
		<table class="table  table-sm">
	        <thead class="table-info">
	        	<tr>
					<th>No.</th>
					<th>Detail</th>
					<th>Percentage Completed</th> 
				</tr> 
	        </thead>
	        <tbody> 
				<tr>
					<td>1.</td>
					<td>Account
						<ul>
							<li>Profile</li>
							<li>Photo</li>
							<li>Resume</li>
						</ul>
					</td>
					<td>
						&nbsp;
						<ul>
							<li>
								{{ $completeProfile = round(100 - ($seek->incomplete * 100) / 13) }}%
								(<a href="" class="small updProf">Click update profile</a>)
							</li>
							<li>
								{{ $completePhoto = round(100 - ($photo->incomplete * 100) / 1) }}%
								(<a href="" class="small" id="addphoto">Click update photo</a>)
								@include('seeker.profile.includes.modalphoto')
							</li>
							<li>
								{{ $completeResume = isset($resume) ? round(100 - ($resume->incomplete * 100) / 1) : 0 }}%
								(<a href="" class="small" id="addresume">Click update resume</a>)
								@include('seeker.profile.includes.modalresume')
							</li>
						</ul>
					</td> 
				</tr>
				<tr>
					<td>2.</td>
					<td>Education</td>
					<td>   
						{{ $completeEdu = isset($edu) ? round(100 - ($edu->incomplete * 100) / 6) : 0 }}%	 
						(<a href="" class="small" id="addedu">Click update education</a>)
						@include('seeker.profile.includes.modaledu')
					</td> 
				</tr>
				<tr>
					<td>3.</td>
					<td>Experience</td>
					<td> 
						{{ $completeExp = isset($exp) ? round(100 - ($exp->incomplete * 100) / 6) : 0 }}%	 
						(<a href="" class="small" id="addexp">Click update experience</a>)
						@include('seeker.profile.includes.modalexp')
					</td> 
				</tr>
				@if($completeProfile == '100' AND $completePhoto = '100'  AND $completeResume == '100' AND $completeEdu == '100' OR $completeExp == '100')
				<tr>
					<td colspan="3">
						<button class="btn btn-md btn-success" 
						onClick="location.href='{{ route('seeker.account.verify.complete', ['id' => Auth::guard('web')->user()->id]) }}'">Verify profile</button>
					</td>
				</tr>
				@endif
	        </tbody>
	    </table>
	</div> 
	@include('seeker.profile.includes.updprof')
</main>
	@include('seeker.profile.includes.script') 
	<!-- Footer -->  
	@include('includes.footer') 

@endsection 