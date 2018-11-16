<!--<div class="row mx-1 bg-third border border-bottom-primary py-2 pl-sm-4 mr-0">-->
<div class="row mx-1 py-2 pl-sm-4 mr-0">
	@if(Request::path() == 'employer/paid-candidate')
	<div class="col-sm">  
		<select class="form-control border chosen" id="talent_type">
			<option value="" {{request()->session()->get('search_talent_type')==''? 'selected':''}}>All</option>
			<option value="FRESH" {{request()->session()->get('search_talent_type')=='FRESH'? 'selected':''}}>Fresh Level</option>
			<option value="EXPERIENCE" {{request()->session()->get('search_talent_type')=='EXPERIENCE'? 'selected':''}}>Experience level</option>
			<option value="OPERATOR" {{request()->session()->get('search_talent_type')=='OPERATOR'? 'selected':''}}>Operator level</option>
			<option value="INTERNSHIP" {{request()->session()->get('search_talent_type')=='INTERNSHIP'? 'selected':''}}>Internship level</option>
			<option value="SENIOR" {{request()->session()->get('search_talent_type')=='SENIOR'? 'selected':''}}>Senior level</option>
		</select>
	</div> 
	@endif
	<div class="col-md"> 
		<div class="input-group">
		  	<div class="input-group-prepend">
		    	<button class="btn btn-sm btn-secondary border-right-0 border" type="button">
		    		<span class="fa fa-search"></span>
		    	</button>
		  	</div>
			<input class="form-control border border-left-0" type="text" placeholder="Search Field of study..." id="fos_search" value="{{ request()->session()->get('search_fos_search') !== null ? request()->session()->get('search_fos_search'):''}}"/> 
		</div>
	</div> 
	<div class="col-md-3">  
		<select class="form-control border chosen" id="institute">
			<option value="" selected>Institute</option>
			@foreach($institutes as $inst)
				<option value="{{$inst->uni_name}}" {{request()->session()->get('search_institute')==$inst->uni_name? 'selected':''}}>{{$inst->uni_name}}</option>
			@endforeach
		</select>
	</div> 
	<div class="col-md">  
		<select class="form-control border chosen" id="state">
			<option value="" selected>Entire Malaysia</option>
			@foreach($state_array as $state)
				<option value="{{$state->state_name}}" {{request()->session()->get('search_state')==$state->state_name? 'selected':''}}>{{$state->state_name}}</option>
			@endforeach
		</select>
	</div>   
	<div class="col-md">  
		<select class="form-control border chosen" id="education">
			<option value="" selected>Education</option>
			<?php $edus = array('SPM' => 'SPM', 'STPM' => 'STPM', 'Certificate' => 'Certificate', 'Diploma' => 'Diploma', 'Degree' => 'Bachelor Degree', 'Master' => 'Master Degree', 'PHD' => 'Doctor of Philosophy Degree'); ?>

			@foreach($edus as $key => $edu)
				<option value="{{$key}}" {{request()->session()->get('search_education')==$key? 'selected':''}}>{{$edu}}</option>
			@endforeach
		</select>
	</div>   
</div>    

@if(request()->session()->get('search_institute') != '' OR request()->session()->get('search_state') != '' OR request()->session()->get('search_education') != '' OR request()->session()->get('search_fos_search') != '' OR (Request::path() == 'employer/paid-candidate' AND request()->session()->get('search_talent_type') != '' ) )
<hr style="margin-top:0.1em;margin-bottom:0.1em;"> 
<div class="">You are using candidates filter:</div> 
@endif

@if(request()->session()->get('search_institute') != '')  
  <span class="cursor select_search_institute_remove font-weight-bold">{{request()->session()->get('search_institute')}}
  	<a href="" ><i class="fa fa-times text-danger"></i></a> 
  </span>
	@endif 
@if(request()->session()->get('search_state') != '')  
  <span class="cursor select_search_state_remove font-weight-bold">{{request()->session()->get('search_state')}}
  	<a href="" ><i class="fa fa-times text-danger"></i></a> 
  </span>
	@endif 
@if(request()->session()->get('search_education') != '')  
  <span class="cursor select_search_education_remove font-weight-bold">{{request()->session()->get('search_education')}}
  	<a href="" ><i class="fa fa-times text-danger"></i></a> 
  </span>
@endif 
@if(request()->session()->get('search_fos_search') != '')  
  <span class="cursor select_search_fos_search_remove font-weight-bold">{{request()->session()->get('search_fos_search')}}
  	<a href="" ><i class="fa fa-times text-danger"></i></a> 
  </span>
@endif 

@if(Request::path() == 'employer/paid-candidate')
	@if(request()->session()->get('search_talent_type') != '')  
	  <span class="cursor select_talent_type_remove font-weight-bold">{{request()->session()->get('search_talent_type')}}
	  	<a href="" ><i class="fa fa-times text-danger"></i></a> 
	  </span>
	@endif 
@endif 
<hr style="margin-top:0.1em;">  