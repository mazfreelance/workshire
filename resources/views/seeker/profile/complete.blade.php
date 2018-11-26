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
				<li>
					<?php $completeResume = '' ?>
					@if($resume !== null) 
						{{ $completeResume = round(100 - ($resume->incomplete * 100) / 1) }}%	
					@else 0%  
					@endif 
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
		</td> 
	</tr>
</table> 
