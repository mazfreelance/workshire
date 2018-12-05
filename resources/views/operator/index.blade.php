@extends('layouts.master')

@section('title', 'Operator Pool') 
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
				{!! Form::open(['route' => 'operator', 'role' => 'form', 'id' => 'jobfairform']) !!}
					<h2>Labour Pool Sign Up / <small class="font-italic">Daftar Tenaga Buruh.</small></h2>
					<hr class="colorgraph"> 
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
				        <label class="col-form-label form-control-label">Gender</label>
				        <div class="form-control-label">   
							<div class="custom-control custom-radio custom-control-inline">
							    <input type="radio" class="custom-control-input" id="gender1" name="gender" value="M"/>
							    <label class="custom-control-label" for="gender1">Male</label>
						  	</div>
				            <div class="custom-control custom-radio custom-control-inline">
							    <input type="radio" class="custom-control-input" id="gender2" name="gender" value="F"/>
							    <label class="custom-control-label" for="gender2">Female</label> 
						  	</div> 
				        </div>  
					</div>

					<div class="form-group">
						<input type="text" name="contact_num" id="contact_num" class="form-control input-lg" placeholder="Contact number" tabindex="3">
						<span id="error-contact_num" class="invalid-feedback"></span> 
					</div>

					<div class="form-group">
						<input type="email" name="email" id="email" class="form-control input-lg" placeholder="E-mail address (optional)" tabindex="3">
						<span id="error-email" class="invalid-feedback"></span> 
					</div>
					
					<legend>Additional Details</legend>

					<div class="row"> 
						<div class="col-xs-12 col-sm-12 col-md-12">
							<div class="form-group"> 
		                        <select name="highEdu" id="highEdu" class="form-control input-lg" tabindex="1">
		                        	<option value="" selected disabled>Select Highest Education</option>
		                        	<?php 
		                        	$highEdus = array('UPSR' => 'UPSR', 'SPM' => 'SPM', 'STPM' => 'STPM', 'CERTIFICATE' => 'Certificate', 'DIPLOMA' => 'Diploma', 'BACHELOR' => 'Bachelor Degree')
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
								<input type="text" name="seeker_zip" id="seeker_zip" class="form-control input-lg" placeholder="Postcode" tabindex="2">
								<span id="error-seeker_zip" class="invalid-feedback"></span> 
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6">
							<div class="form-group"> 
		                        <select name="seeker_state" id="seeker_state" class="form-control input-lg" tabindex="1">
		                        	<option value="" selected disabled>Select State</option> 
		                        	@foreach($state_array as $state)   
					                	<option value="{{$state->state_name}}">
					                		{{$state->state_name}}
					                	</option>
					                @endforeach
		                        </select>
								<span id="error-seeker_state" class="invalid-feedback"></span> 
							</div>
						</div>
					</div> 

					<hr class="hrspecial">
					<div class="row"> 
						<div class="col-xs-12 col-sm-6 col-md-6">
							<div class="form-group">
		                        <select name="workSTAT" id="workSTAT" class="form-control input-lg" tabindex="1">
		                        	<option value="" selected disabled>Select Working Status</option> 
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
		                        </select>
								<span id="error-workSTAT" class="invalid-feedback"></span> 
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6">
							<div class="form-group"> 
                                <select class="form-control input-lg" name="workPOS" id="workPOS" disabled>
		                        	<option value="" selected disabled>Select Current Working Position</option> 
                                    @php
                                        $workPOS = array('Operator', 'Leader', 'Machine', 'SMT', 'Store', 'Facility', 'Quality Assurance (QA)', 'Internal Quality Assurer (IQA)');
                                        sort($workPOS);
                                        foreach ($workPOS as $value) {
                                            echo '<option value="'.$value.'">';
                                            echo $value;
                                            echo '</option>';
                                        }
                                        echo '<option value="Others">Others / Lain-lain</option>';
                                    @endphp
                                </select>

                                <input class="form-control input-lg mt-1" type="text" name="other_workpos" id="other_workpos" placeholder="Others current working position" disabled/>
								<span id="error-workPOS" class="invalid-feedback"></span> 
								<span id="error-other_workpos" class="invalid-feedback"></span> 
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6">
							<div class="form-group">
		                        <select name="workEXP" id="workEXP" class="form-control input-lg" tabindex="1">
		                        	<option value="" selected disabled>Select Work Experience</option> 
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
		                        </select>
								<span id="error-workEXP" class="invalid-feedback"></span> 
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6">
							<div class="form-group"> 
		                        <select name="workAvailability" id="workAvailability" class="form-control input-lg" tabindex="1">
		                        	<option value="" selected disabled>Select Availability to work</option> 
		                        	@php
                                    $workAvailability= array('Immediately', 'One (1) week', 'Two (2) weeks', 'One (1) month');
                                    sort($workAvailability);
                                    foreach ($workAvailability as $value) {
                                        echo '<option value="'.$value.'">';
                                        echo $value;
                                        echo '</option>';
                                    }
                                    @endphp
		                        </select>

								<span id="error-workAvailability" class="invalid-feedback"></span> 
							</div>
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