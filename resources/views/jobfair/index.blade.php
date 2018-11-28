@extends('layouts.master')

@section('title', 'Job Fair') 
@section('content')  
@section('css')
<style>
.colorgraph {
	height: 5px;
	border-top: 0;
	background: #c4e17f;
	border-radius: 5px;
	background-image: -webkit-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
	background-image: -moz-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
	background-image: -o-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
	background-image: linear-gradient(to right, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
}	 
.hrspecial{
	height: 2px;
	border-top: 0;
	background: #c4e17f;
}
</style>
@endsection
<main class="py-2">   
	<div class="loading">
		<i class="fas fa-spinner fa-spin fa-2x fa-tw"></i>
		<br>
		<span>Loading</span>
	</div>
	<div class="card pt-3">
		<div class="mx-1 d-flex justify-content-center row">
		    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3"> 
				{!! Form::open(['route' => 'jobfair', 'role' => 'form', 'id' => 'jobfairform']) !!}
					<h2>Please Sign Up <small>It's free, always will be and be part of Workshire.</small></h2>
					<hr class="colorgraph">
					<legend>Account Details</legend>
					<div class="row">
						<div class="col-xs-12 col-sm-6 col-md-6">
							<div class="form-group">
		                        <input type="text" name="username" id="username" class="form-control input-lg" placeholder="Username" tabindex="1">
    							<span id="error-username" class="invalid-feedback"></span>
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6">
							<div class="form-group">
		                        <input type="text" name="email" id="email" class="form-control input-lg" placeholder="Email" tabindex="1">
    							<span id="error-email" class="invalid-feedback"></span>
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6">
							<div class="form-group">
								<input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="2">
    							<span id="error-password" class="invalid-feedback"></span>
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6">
							<div class="form-group">
								<input type="password" name="confirm_password" id="confirm_password" class="form-control input-lg" placeholder="Confirm Password" tabindex="2">
    							<span id="error-confirm_password" class="invalid-feedback"></span>
							</div>
						</div>
					</div>
					
					<legend>Personal Details</legend>
					<div class="form-group">
						<input type="text" name="name" id="name" class="form-control input-lg" placeholder="Full Name" tabindex="3">
						<span id="error-name" class="invalid-feedback"></span> 
					</div>
					<div class="form-group">  
				        <label class="col-form-label form-control-label">National Registration Identity Card / Passport Number</label>
				        <div class="form-control-label">   
							<div class="custom-control custom-radio custom-control-inline">
							    <input type="radio" class="custom-control-input" id="ic_type1" name="ic_type" value="malay" checked/>
							    <label class="custom-control-label" for="ic_type1">Malaysian</label>
						  	</div>
				            <div class="custom-control custom-radio custom-control-inline">
							    <input type="radio" class="custom-control-input" id="ic_type2" name="ic_type" value="non malay"/>
							    <label class="custom-control-label" for="ic_type2">Non Malaysian</label> 
						  	</div> 
						  	<!--nric_field-->
				            <div class="input-group mb-3" id="nric_field" style="display:none;"> 
							  	<input type="text" class="form-control" name="nric_date" id="nric_date" 
							  	aria-describedby="basic-addon1" maxlength="6" placeholder="XXXXXXX"/>
							  	<div class="input-group-prepend">
						    		<span class="input-group-text" id="basic-addon1">-</span>
							  	</div>
							  	<input type="text" class="form-control" name="nric_state" id="nric_state" 
							  	aria-describedby="basic-addon1" maxlength="2" placeholder="XX"/>
							  	<div class="input-group-prepend">
						    		<span class="input-group-text" id="basic-addon1">-</span>
							  	</div>
							  	<input type="text" class="form-control" name="nric_ic" id="nric_ic" 
							  	aria-describedby="basic-addon1" maxlength="4" placeholder="XXXX"/> 

							  	<span id="error-nric_date" class="invalid-feedback"></span>
    							<span id="error-nric_state" class="invalid-feedback"></span>
    							<span id="error-nric_ic" class="invalid-feedback"></span> 
							</div> 

							<input type="hidden" class="form-control" name="nric_full" id="nric_full"/>
							<span id="error-nric_full" class="invalid-feedback"></span>
						  	<!--passport_field-->
				            <div class="mb-3" id="passport_field" style="display:none;"> 
							  	<input type="text" class="form-control" name="passport" id="passport" placeholder="Passport number" />
								<span id="error-passport" class="invalid-feedback"></span> 
							</div> 
				        </div>  
					</div>
					<div class="form-group">
						<input type="text" name="contact_num" id="contact_num" class="form-control input-lg" placeholder="Contact number" tabindex="3">
						<span id="error-contact_num" class="invalid-feedback"></span> 
					</div>

					
					<legend>Additional Details</legend>

					<div class="row"> 
						<div class="col-xs-12 col-sm-6 col-md-6">
							<div class="form-group"> 
		                        <select name="highEdu" id="highEdu" class="form-control input-lg" tabindex="1">
		                        	<option value="" selected disabled>Select Highest Education</option>
		                        	<?php 
		                        	$highEdus = array('SPM' => 'SPM', 'STPM' => 'STPM', 'Certificate' => 'Certificate', 'Diploma' => 'Diploma', 'Degree' => 'Bachelor Degree', 'Master' => 'Master Degree', 'PHD' => 'Doctor of Philosophy Degree')
		                        	?>
		                        	@foreach($highEdus as $key => $highEdu)
		                        	<option value="{{$key}}">{{$highEdu}}</option>
		                        	@endforeach
		                        </select>
								<span id="error-highEdu" class="invalid-feedback"></span> 
							</div>
						</div> 
						<div class="col-xs-12 col-sm-6 col-md-6">
							<div class="form-group"> 
		                        <select name="fos" id="fos" class="form-control input-lg" tabindex="1">
		                        	<option value="" selected disabled>Select Field of Study</option> 
		                        	@foreach($fos as $val)
		                        	<option value="{{$val->category_Name}}">{{$val->category_Name}}</option>
		                        	@endforeach
		                        </select>
								<span id="error-fos" class="invalid-feedback"></span> 
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12">
							<div class="form-group">
								<input type="text" name="major" id="major" class="form-control input-lg" placeholder="Major" tabindex="2" disabled>
								<span class="text-success small">
									Hint:<br/>
									- Example: Diploma in Computer Science;<br/>
									- If SPM level, leave in blank for this section;<br/>
								</span>

								<span id="error-major" class="invalid-feedback"></span> 
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12">
							<div class="form-group"> 
		                        <select name="institute" id="institute" class="form-control input-lg" tabindex="1">
		                        	<option value="" selected disabled>Select Institute/School</option> 
		                        	@foreach($institutes as $inst)
		                        	<option value="{{$inst->uni_name}}">{{$inst->uni_name}}</option>
		                        	@endforeach
		                        </select>
								<span id="error-institute" class="invalid-feedback"></span> 
							</div>
						</div>
					</div> 
					<div class="form-group"> 
						<div class="row"> 
							<div class="col-xs-12 col-sm-6 col-md-6"> 
								<label class="col-form-label form-control-label d-block">Achievement</label> 
								<div class="custom-control custom-radio custom-control-inline">
								    <input type="radio" class="custom-control-input" id="grade" name="achieve" value="Grade" checked/>
								    <label class="custom-control-label" for="grade">Grade</label>
							  	</div>
					            <div class="custom-control custom-radio custom-control-inline">
								    <input type="radio" class="custom-control-input" id="cgpa" name="achieve" value="CGPA"/>
								    <label class="custom-control-label" for="cgpa">CGPA</label>
							  	</div> 
					            <div class="custom-control custom-radio custom-control-inline">
								    <input type="radio" class="custom-control-input" id="class" name="achieve" value="Class"/>
								    <label class="custom-control-label" for="class">Class</label>
							  	</div> 
							  	
								<input type="text" name="achievement_grade" id="achievement_grade" class="form-control input-lg" tabindex="3" placeholder="Grade"> 
								<input type="text" name="achievement_cgpa" id="achievement_cgpa" class="form-control input-lg" tabindex="3" placeholder="CGPA"> 
								<input type="text" name="achievement_class" id="achievement_class" class="form-control input-lg" tabindex="3" placeholder="Class">

								<span id="error-achievement_grade" class="invalid-feedback"></span>  
								<span id="error-achievement_cgpa" class="invalid-feedback"></span> 
								<span id="error-achievement_class" class="invalid-feedback"></span> 
						    </div>
							<div class="col-xs-12 col-sm-6 col-md-6">  
								<label class="col-form-label form-control-label">Working Experience Year(s)</label> 
								<input type="number" name="working" id="working" class="form-control input-lg" tabindex="3"> 
								<span id="error-working" class="invalid-feedback"></span> 
							</div>
						</div>
					</div>

					<hr class="hrspecial">
					<div class="row">
						<div class="col-xs-5 col-sm-4 col-md-4">
							<label class="col-form-label form-control-label">How do you know about Workshire.com.my</label>
						</div>
						<div class="col-xs-7 col-sm-8 col-md-8"> 
	                        <select name="survey" id="survey" class="form-control input-lg" tabindex="1">
	                        	<option value="" selected disabled>Select Survey</option>
	                        	<?php 
                                $surveys = array('Facebook', 'Instagram', 'LinkedIn', 'Job Fair', 'WhatsApp Group', 'Recruitement Drive', 'Printed Advert');
                                sort($surveys);
                                ?>
                                @foreach($surveys as $survey)
                                <option value="{{$survey}}">{{$survey}}</option>
                                @endforeach
	                        	<option value="Other">Other</option>
	                        </select>
	                        <input type="text" name="other_survey" id="other_survey" class="form-control input-lg mt-1" placeholder="Other survey" tabindex="3" disabled> 

							<span id="error-survey" class="invalid-feedback"></span>  
							<span id="error-other_survey" class="invalid-feedback"></span> 
						</div>
					</div>

					<div class="form-group text-center mt-2">
						By signing up, you agree <a href="{{ route('term&conds') }}" target="_blank">Terms and Conditions</a> and <a href="{{ route('privacy') }}" target="_blank">Privacy Policy</a>
					</div>
					
					<hr class="colorgraph">
					<div class="row">
						<div class="col-xs-12 col-md-12">
							<input type="submit" value="Register" class="btn btn-primary btn-block btn-lg" tabindex="7">
						</div>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</main>
<!-- Footer -->  
@include('includes.footer')  
@endsection
@include('seeker.profile.includes.script')