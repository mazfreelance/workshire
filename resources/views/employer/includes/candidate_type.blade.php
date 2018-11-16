<hr> 
<ul class="small" style="list-style:none;"> 
	<li class="mb-1">
		<a class="btn btn-outline-primary btn-sm d-block {{ Request::path() == 'employer/candidate-fresh' ? 'active' : '' }}" href="{{route('employer.candidate.fresh')}}">Fresh</a>
	</li>
	<li class="mb-1">
		<a class="btn btn-outline-danger btn-sm d-block {{ Request::path() == 'employer/candidate-exp' ? 'active' : '' }}" href="{{route('employer.candidate.experience')}}">Experience</a>
	</li>
	<li class="mb-1">
		<a class="btn btn-outline-warning btn-sm d-block {{ Request::path() == 'employer/candidate-intern' ? 'active' : '' }}" href="{{route('employer.candidate.intern')}}">Internship</a>
	</li>
	<li class="mb-1">
		<a class="btn btn-outline-success btn-sm d-block {{ Request::path() == 'employer/candidate-operator' ? 'active' : '' }}" href="{{route('employer.candidate.operator')}}">Operator</a>
	</li>
	<li class="mb-1"><a class="btn btn-outline-info btn-sm d-block">Senior Citizen</a></li>
</ul>
<hr>