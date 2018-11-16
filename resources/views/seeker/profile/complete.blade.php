<table>
	<tr>
		<th>No.</th>
		<th>Detail</th>
		<th>Percentage Completed</th>
		<th>Action</th>
	</tr> 
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
				<li>{{ $completeProfile = round(100 - ($seek->incomplete * 100) / 13) }}%</li>
				<li>{{ $completePhoto = round(100 - ($photo->incomplete * 100) / 1) }}%</li>
				<li>{{ $completeResume = round(100 - ($resume->incomplete * 100) / 1) }}%</li>
			</ul>
		</td>
		<td>

		</td>
	</tr>
	<tr>
		<td>2.</td>
		<td>Education</td>
		<td> 
			@if($edu !== null) ada
			@else 0%  
			@endif 
		</td>
		<td>

		</td>
	</tr>
	<tr>
		<td>3.</td>
		<td>Experience</td>
		<td>
			{{$exp}}
			@if($exp !== null) ada
			@else 0%  
			@endif 
		</td>
		<td>

		</td>
