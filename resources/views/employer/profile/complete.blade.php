@extends('layouts.master')

@section('title', 'Profile')

@section('content') 
<main class="py-0 my-2"> 
	<div class="container py-2">
		<p class="text-danger">Complete and verify your profile.</p>  
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
						</ul>
					</td>
					<td>
						&nbsp;
						<ul>
							<li>
								{{ $completeProfile = round(100 - ($emp->incomplete * 100) / 14) }}%
							</li>
							<li>
								{{ $completePhoto = round(100 - ($emp->incomplete * 100) / 1) }}%
								(<a href="" class="small" id="addphoto">Click update photo</a>)
								@include('employer.profile.includes.modalphoto')
							</li>
						</ul>
					</td> 
				</tr>
				@if($completeProfile == '100' AND $completePhoto == '100')
				<tr>
					<td colspan="3">
						<button class="btn btn-md btn-success" 
						onClick="location.href='{{ route('employer.account.verify.complete', ['id' => Auth::guard('employer')->user()->id]) }}'">Verify profile</button>
					</td>
				</tr>
				@endif
	        </tbody>
	    </table>
	</div> 
	@include('employer.profile.includes.update_profile') 
</main>
@include('employer.profile.includes.script') 
<!-- Footer -->  
@include('includes.footer') 

@endsection 