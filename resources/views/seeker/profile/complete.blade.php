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
								(<a href="" class="small">Click update photo</a>)
							</li>
							<li>
								<?php $completeResume = '' ?>
								@if($resume !== null) 
									{{ $completeResume = round(100 - ($resume->incomplete * 100) / 1) }}%	
								@else 0%  
								@endif 
								(<a href="" class="small">Click update resume</a>)
							</li>
						</ul>
					</td> 
				</tr>
				<tr>
					<td>2.</td>
					<td>Education</td>
					<td> 
						<?php $completeEdu = '' ?>
						@if($edu !== null) 
							{{ $completeEdu = round(100 - ($edu->incomplete * 100) / 6) }}%	
						@else 0%  
						@endif 
						(<a href="" class="small">Click update education</a>)
					</td> 
				</tr>
				<tr>
					<td>3.</td>
					<td>Experience</td>
					<td> 
						<?php $completeExp = '' ?>
						@if($exp !== null)
							{{ $completeExp = round(100 - ($exp->incomplete * 100) / 6) }}%	
						@else 0%  
						@endif 
						(<a href="" class="small">Click update experience</a>)
					</td> 
				</tr>
	        </tbody>
	    </table>
	</div> 
	@include('seeker.profile.complete.updprof')
</main>
	@include('seeker.profile.includes.script') 
	<!-- Footer -->  
	@include('includes.footer') 

@endsection 