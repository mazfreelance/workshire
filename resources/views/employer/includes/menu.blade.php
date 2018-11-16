<div class="row border border-dark border-top-0 border-bottom-0 py-4 px-sm-4 px-2 mx-1"> 
      <div class="col-sm d-flex justify-content-center">  
        <a href="{{ route('employer.postjob') }}" class="btn btn-outline-primary btn-md btn-block {{ Request::path() == 'employer/post' ? 'active' : '' }}">Post Job</a>
        <div class="input-group-prepend">
          <span class="input-group-text border-0" id="basic-addon1">or</span>
        </div> 
        @if(Request::path() == 'employer/candidate-fresh' OR Request::path() == 'employer/candidate-exp' OR Request::path() == 'employer/candidate-intern' OR Request::path() == 'employer/candidate-operator')
	        <a href="{{ route('employer.candidate.fresh') }}" class="btn btn-outline-info btn-md btn-block active">
	        Search Candidate
	    	</a>  
    	@else
    		<a href="{{ route('employer.candidate.fresh') }}" class="btn btn-outline-info btn-md btn-block">
	        Search Candidate
	    	</a> 
        @endif
      </div>   
</div>  