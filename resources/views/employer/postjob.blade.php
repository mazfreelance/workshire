@extends('layouts.master')

@if(isset($jposts))
	@section('title', 'Edit Post Job')
@else
	@section('title', 'New Post Job')
@endif

@section('content')   
<main class="py-0">    
	@include('employer.includes.menu')
	<div class="row border border border-dark border-top-0 border-bottom-0  mr-0 mx-1">
		<div class="col-sm-12 pl-sm-5 pt-sm-1 pt-0 pl-4 text-center">
			<h3 class="text-primary">{{isset($jposts)?'Edit':'New'}} Post Job</h3> 
			<hr style="margin-bottom:0.1em">
		</div>
	</div>
    <!--<form class="mx-2" id="jobpostingForm" name="jobpostingForm" method="post" enctype="multipart/form-data">--> 
    @if(isset($jposts))
        {!! Form::model($jposts,['method'=>'put','id'=>'frm']) !!} 
    @else  
        {!! Form::open(['route'=>'employer.createPost','id'=>'frm']) !!}  
    @endif 
	<div class="row border border border-dark  mr-0 mx-1"> 
		<!-- col-sm my-1 pl-4 start--> 
		<div class="col-sm my-1 pl-4">   
			<legend class="col-form-legend form-control bg-info text-light bold">Job Details</legend> 
	  		<div class="form-row">
    			<div class="form-group col-md-12">
					<label class="col-md-12 form-control bg-dark text-light mb-1">Position title</label>
					<input class="form-control" type="text" name="jobpost_position" id="jobpost_position" placeholder="eg: Programmer" value="{{isset($jposts) ?$jposts->jobpost_position : null}}" /> 

            		<span id="error-jobpost_position" class="invalid-feedback"></span>
			    </div>
			</div> 
	  		<div class="form-row">
    			<div class="form-group col-md">
					<label class="form-control bg-dark text-light mb-1">Position level</label>
					<select class="custom-select mr-sm-2" name="jobpost_position_level" id="jobpost_position_level">
				        <option value="" selected>Choose...</option> 
		                @foreach($poslvl_array as $poslvl)  
		                	<?php
		                		echo '<option value="'.$poslvl->post_level.'" ';
		                		if(isset($jposts)){
		                			echo $jposts->jobpost_position_level==$poslvl->post_level? 'selected': '';
		                		}
		                		echo '>'.$poslvl->post_level.'</option>';
		                	?>
		                @endforeach
				    </select>
            		<span id="error-jobpost_position_level" class="invalid-feedback"></span>
			    </div>
			    <div class="form-group col-md">
					<label class="form-control bg-dark text-light mb-1">Employement type</label>
					<select class="custom-select mr-sm-2" name="jobpost_emp_type" id="jobpost_emp_type">
				        <option value=""  selected>Choose...</option>  
		                @foreach($empType_array as $empType)  
		                	<?php
		                		echo '<option value="'.$empType->emp_type.'" ';
		                		if(isset($jposts)){
		                			echo $jposts->jobpost_emp_type==$empType->emp_type? 'selected': '';
		                		}
		                		echo '>'.$empType->emp_type.'</option>';
		                	?>
		                @endforeach
				    </select>
            		<span id="error-jobpost_emp_type" class="invalid-feedback"></span>
			    </div> 
    			<div class="form-group col-md">
					<label class="form-control bg-dark text-light mb-1">No. of Vacancy</label>  
			        <input type="text" class="form-control" name="job_noofvacancy" id="job_noofvacancy" autocomplete="off" value="{{isset($jposts) ?$jposts->job_noofvacancy : null}}"/> 

            		<span id="error-job_noofvacancy" class="invalid-feedback"></span>
			    </div> 
			</div>     
			<div class="form-row"> 
				<div class="form-group col-md-12">
					<label class="form-control bg-dark text-light mb-1">Location</label>
					<div class="form-row">
						<div class="col-md-6 input-group mb-sm-2"> 
							<input class="form-control" type="text" name="jobpost_loc_city" id="jobpost_loc_city" value="{{isset($jposts) ?$jposts->jobpost_loc_city : Auth::user()->employer[0]->emp_city}}"/>
            				<span id="error-jobpost_loc_city" class="invalid-feedback"></span>
					    </div>
						<div class="col-md-6 input-group mb-sm-2"> 
				        	<select class="custom-select mr-sm-2" name="jobpost_loc_state" id="jobpost_loc_state">
						        <option value="" selected>Choose State...</option> 
				                @foreach($state_array as $state)  
				                	<?php
				                		echo '<option value="'.$state->state_name.'" ';
				                		if(isset($jposts)){
				                			echo $jposts->jobpost_loc_state==$state->state_name? 'selected':'';
				                		}
				                		else{
				                			echo Auth::user()->employer[0]->emp_state==$state->state_name? 'selected':'';
				                		}

				                		echo '>'.$state->state_name.'</option>';
				                	?>
				                @endforeach
						    </select>
            				<span id="error-jobpost_loc_state" class="invalid-feedback"></span>
					    </div>
					</div>
			    </div>  
			</div>  
			<div class="form-row"> 
				<div class="form-group col-md-12">
					<label class="form-control bg-dark text-light mb-1">Salary range (RM)</label>
					<div class="form-row">
						<div class="col-md-6 input-group mb-sm-2"> 
							<div class="input-group-prepend">
					          <div class="input-group-text">From</div>
					        </div>
					        <input type="text" class="form-control" name="jobpost_minSalary" id="jobpost_minSalary" autocomplete="off" value="{{isset($jposts) ?$jposts->jobpost_minSalary : null}}"/> 
            				<span id="error-jobpost_minSalary" class="invalid-feedback"></span>
					    </div>
						<div class="col-md-6 input-group mb-sm-2"> 
				        	<div class="input-group-prepend">
					          <div class="input-group-text">To</div>
					        </div>
					        <input type="text" class="form-control" name="jobpost_maxSalary" id="jobpost_maxSalary" autocomplete="off" value="{{isset($jposts) ?$jposts->jobpost_maxSalary : null}}"/> 
            				<span id="error-jobpost_maxSalary" class="invalid-feedback"></span>
					    </div>
					</div> 
			    </div>  
			</div>  
			<div class="form-row">
    			<div class="form-group col-md-6"> 
					<label class="form-control bg-dark text-light mb-1">Additional allowance 
						<font class="small text-danger font-italic">(optional)</font>
					</label>   
                    <a class="btn btn-sm btn-primary btn-add-more-allowance text-light">Add more allowance</a> 
 
                	@if(isset($jposts))
                    	<?php $array_allow = explode(',', $jposts->jobpost_allowance); ?>
                    	@foreach($array_allow as $allows)
                        <div class="form-group category-allowance my-1">
							<div class="input-group">
								<input type="text" name="allowance[]" id="allowance" class="form-control" value="{{$allows}}" />
								<span class="input-group-btn">
									<a class="btn btn-danger btn-remove-allowance"><i class="fa fa-times" aria-hidden="true"></i></a>
								</span>
							</div>
						</div>
						@endforeach
					@else
						<!--<div class="form-group category-allowance my-1">
							<div class="input-group">
								<input type="text" name="allowance[]" id="allowance" class="form-control"/>
								<span class="input-group-btn">
									<a class="btn btn-danger btn-remove-allowance"><i class="fa fa-times" aria-hidden="true"></i></a>
								</span>
							</div>
						</div>-->
					@endif 
					<div  class="onerowallow"></div>
	    		</div>
	    		<div class="form-group col-md-6"> 
					<label class="form-control bg-dark text-light mb-1">Skill(s) 
						<font class="small text-danger font-italic">(optional)</font>
					</label>    
                    <a class="btn btn-sm btn-primary btn-add-more-skill text-light">Add more skill</a> 
                      
                	@if(isset($jposts))
                    	<?php $array_skill = explode(',', $jposts->jobpost_skill); ?>
                    	@foreach($array_skill as $skills)
                        <div class="form-group category-skill my-1">
							<div class="input-group">
								<input class="form-control" type="text" name="skill[]" id="skill" placeholder="eg: Commnunication" value="{{$skills}}" />
								<span class="input-group-btn">
									<a class="btn btn-danger btn-remove-skill"><i class="fa fa-times" aria-hidden="true"></i></a>
								</span>
							</div>
						</div>
						@endforeach
					@else
						<div class="form-group category-skill my-1">
							<!--<div class="input-group">
								<input class="form-control" type="text" name="skill[]" id="skill" placeholder="eg: Commnunication" value="" />
								<span class="input-group-btn">
									<a class="btn btn-danger btn-remove-skill"><i class="fa fa-times" aria-hidden="true"></i></a>
								</span>
							</div>-->
						</div>
					@endif 
					<div  class="onerowskill"></div>
			    </div>
			</div>     

			<hr style="margin-top:-0.1em;margin-bottom:0.7em;border-color:blue;">
			<legend class="col-form-legend form-control bg-info text-light bold">Overall Scope</legend>   
			<div class="form-row"> 
			    <div class="form-group col-md-12"> 
					<div class="form-group ml-2 mr-1">  
						<div class="form-row"> 
						    <label class="col-sm-2 rounded col-form-label bg-dark text-light mb-1">Description</label>
						    <div class="col-sm-10"> 
								<textarea class="form-control" cols="80" rows="15" name="jobpost_desc" id="jobpost_desc">{!!isset($jposts) ?$jposts->jobpost_desc : null!!}</textarea> 
        						<span id="error-jobpost_desc" class="invalid-feedback"></span>
						    </div> 
						</div>
					</div>   
			    </div>  
		    </div>   
		</div>
		<!-- col-sm my-1 pl-4 end--> 
		<!-- col-sm my-1 pl-4 (1) start-->
		<div class="col-sm my-1 pl-4">    
			<legend class="col-form-legend form-control bg-info text-light bold">Detail Scope</legend>  
		    <div class="form-row"> 
			    <div class="form-group col-md-12">
					<label class="form-control bg-dark text-light mb-1">Education Level</label> 
				    <div class="form-row">
						<div class="col-md-6"> 
							<select class="custom-select mr-sm-2" name="jobpost_education" id="jobpost_education">
						        <option value="" selected>Choose...</option> 
				                @foreach($edulvl_array as $edulvl)  
				                	<?php
				                		echo '<option value="'.$edulvl->edu_level.'" ';
				                		if(isset($jposts)){
				                			echo $jposts->jobpost_education==$edulvl->edu_level? 'selected':'';
				                		}  
				                		echo '>'.$edulvl->edu_level.'</option>';
				                	?>
				                @endforeach 
						    </select>

    						<span id="error-jobpost_education" class="invalid-feedback"></span>
					    </div>
						<div class="col-md-6">  
		        			<input class="form-control" type="text"  name="postEduOthers" id="postEduOthers" size="30" autocomplete="off" placeholder="Other description for education level" disabled/>
					    </div>
					</div>
			    </div> 
		    </div> 
		    <div class="form-row"> 
			    <div class="form-group col-md-12">
					<label class="form-control bg-dark text-light mb-1">Job Category</label> 
				    <div class="form-row">
						<div class="col-md-6"> 
							<select class="custom-select mr-sm-2" name="jobpost_field_study" id="jobpost_field_study"> 
						        <option value="" selected>Choose...</option> 
				                @foreach($jobCats as $jobCat)  
				                	<?php
				                		echo '<option value="'.$jobCat->category_name.'" ';
				                		if(isset($jposts)){
				                			echo $jposts->jobpost_field_study==$jobCat->category_name? 'selected':'';
				                		}  
				                		echo '>'.$jobCat->category_name.'</option>';
				                	?>
				                @endforeach 
						    </select>
    						<span id="error-jobpost_field_study" class="invalid-feedback"></span>
					    </div>
						<div class="col-md-6">   
			        		<input class="form-control" type="text" name="postFieldOthers" id="postFieldOthers" size="30" placeholder="Other description for field of study" disabled/>
					    </div>
					</div> 
			    </div> 
		    </div>   
	     	<div class="form-row"> 
			    <div class="form-group col-md-12">
					<label class="form-control bg-dark text-light mb-1">Experience</label>   
					<div class="form-group ml-2 mr-1"> 
						<div class="form-row"> 
						    <label class="col-sm-2 col-form-label bg-light text-dark border border-dark">Description
						    	<div class="small text-info">Example:<br/>1. Fresh graduate are encouraged to apply<br/>2. ...</div>
						    </label>
						    <div class="col-sm-10"> 
								<textarea class="form-control" cols="10" rows="3" name="jobpost_exp" id="jobpost_exp">{!!isset($jposts) ?$jposts->jobpost_exp : null!!}</textarea> 
    							<span id="error-jobpost_exp" class="invalid-feedback"></span>
						    </div> 
						</div>
					</div>  
					<div class="form-group ml-2 mr-1" style="margin-top:-0.5em;"> 
						<div class="form-row"> 
						    <label class="col-sm-2 col-form-label bg-light text-dark border border-dark">Years</label>
						    <div class="col-sm-10">  
						        <select class="custom-select mr-sm-2" id="selectExp2" name="selectExp2">
							        <option value="" selected>Choose...</option> 
					                  <?php
					                    $years_exp = array('Less than a year', '1 to 3 years', '4 to 6 years', '7 to 9 years', '10 years and above');
					                    foreach ($years_exp as $year) {
					                      echo '<option value="'.$year.'" ';
					                      if(isset($jposts)){
					                      	echo $jposts->jobpost_years_exp==$year? 'selected':'';
					                      }
					                      echo '>';
					                      echo $year;
					                      echo '</option>';
					                    }
					                  ?>
							    </select>
    							<span id="error-selectExp2" class="invalid-feedback"></span>
						    </div> 
						</div>
					</div> 
			    </div> 
		    </div>   
		    <hr style="margin-top:-0.1em;margin-bottom:0.7em;border-color:blue;">
			<legend class="col-form-legend form-control bg-info text-light bold">Posting Duration</legend>   
		    @if(isset($jposts))
			    <div class="form-row">
	    			<div class="form-group col-md-6">
						<label class="form-control bg-dark text-light mb-1">Start Date (mm/dd/yyyy)</label>
						{{date('M d, Y', strtotime($jposts->jobpost_startDate))}}
				    </div>  
				    <div class="form-group col-md-6">
						<label class="form-control bg-dark text-light mb-1">End Date (mm/dd/yyyy)</label> 
	                 	{{date('M d, Y', strtotime($jposts->jobpost_endDate))}}
				    </div>
				    <div class="form-group col-md-12"> 
	                 	<p class="text-danger font-italic">* To changeable posting duration must be get approval from Workshire Team.</p>
				    </div>
				</div>
				<hr style="margin-top:0.7em;margin-bottom:0.7em;">    
	      		<div class="btn-group d-flex justify-content-center">  
			        <button type="reset" class="btn btn-outline-danger btn-md" id="resetform" title="Reset">
			        	<i class="fa fa-undo"></i> Reset
			        </button>  
			        <button type="submit" class="btn btn-outline-primary btn-md">
			        	<i class="fa fa-paper-plane"></i> Save Job <i class="fa_icon_postjob"></i>
			        </button> 
			    </div> 
		    @else
			    <!-- package -->  
				<input type="hidden" id="duration_package" value="{{$postDurs->duration}}">
				<input type="hidden" name="token_value" id="token_value" value="{{$EmpPosts->package_plan.'>'.$postDurs->token_value.'>'.$EmpPosts->balance}}">
	            
				<div class="form-row">
	    			<div class="form-group col-md-6">
						<label class="form-control bg-dark text-light mb-1">Start Date (mm/dd/yyyy)</label>
						<input class="form-control" type="text" id="jobpost_startDate" name="jobpost_startDate" autocomplete="off" value="{!!isset($jposts) ? date('m/d/Y', strtotime($jposts->jobpost_startDate)) : null!!}" />
						<span id="error-jobpost_startDate" class="invalid-feedback"></span>
				    </div>  
				    <div class="form-group col-md-6">
						<label class="form-control bg-dark text-light mb-1">End Date (mm/dd/yyyy)</label> 
	                 	<input class="form-control" type="text" id="jobpost_endDate" name="jobpost_endDate" readonly value="{!!isset($jposts) ?date('m/d/Y', strtotime($jposts->jobpost_endDate)) : null!!}"/>
	 					<button href="" class="btn btn-md btn-primary mt-1 getdate" >Get End date</button> 
						<span id="error-jobpost_endDate" class="invalid-feedback"></span>
				    </div>

				    <p class="text-danger font-italic">* Your job posting will be advertise after approve from Workshire Team.</p>
				</div>

				@if($EmpPosts->expired_date > date('Y-m-d'))
				<hr style="margin-top:0.7em;margin-bottom:0.7em;">    
	      		<div class="btn-group d-flex justify-content-center">  
			        <button type="reset" class="btn btn-outline-danger btn-md" id="resetform" title="Reset">
			        	<i class="fa fa-undo"></i> Reset
			        </button>  
			        <button type="submit" class="btn btn-outline-primary btn-md">
			        	<i class="fa fa-paper-plane"></i> Save Job <i class="fa_icon_postjob"></i>
			        </button> 
			    </div> 
			    @else
			    	<p class="text-danger text-center font-weight-bold">
			    		Your package is expired. Buy new one to continue your purchasing.
			    		<br/>
			    		<a href="">Add package</a>
			    	</p>
			    @endif
			@endif

			    
		</div>  
	</div>
	<!-- col-sm my-1 pl-4 (1) end-->       
	<!--</form>-->
	{!! Form::close() !!} 
</main> 
<!-- Footer -->  
@include('includes.footer')  
@section('js') 
<script src="{{ asset('public/js/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('public/js/ckeditor/adapters/jquery.js') }}"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/gijgo/1.9.10/combined/css/gijgo.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/gijgo/1.9.10/combined/js/gijgo.min.js"></script>
<script src="{{ asset('public/js/custom/post_job.js') }}"></script>
<script>  


</script>
@endsection

@endsection