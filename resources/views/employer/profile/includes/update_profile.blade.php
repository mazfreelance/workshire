<div class="container card pt-4">
	<div class="row">
		<div class="col"> 
			<h4>Complete Profile</h4>
			{!! Form::open(['id' => 'editprofile', 'route' => 'employer.profile_post']) !!}
				<input type="hidden" name="id" value="{{$emp->id}}"/> 
			    <div class="form-group row">
			        <label class="col-lg-3 col-form-label form-control-label">Company name</label>
			        <div class="col-lg-9">
			            <input class="form-control" type="text" value="{{old('company_name') !== null ? old('company_name'):$emp->emp_name}}" name="company_name" id="company_name"/> 
						<span id="error-company_name" class="invalid-feedback"></span> 
			        </div>
			    </div> 
			    <div class="form-group row">
			        <label class="col-lg-3 col-form-label form-control-label">Company Register Number / SSM No.</label>
			        <div class="col-lg-9">
			        	@if($emp->emp_regno !== '') 
			            <input class="form-control" type="text" value="{{ $emp->emp_regno }}" name="ssm_no" id="ssm_no" readonly/> 
						@else
			            <input class="form-control" type="text" value="{{old('ssm_no') !== null ? old('ssm_no'):null}}" name="ssm_no" id="ssm_no"/> 
						<span id="error-ssm_no" class="invalid-feedback"></span> 
						@endif
			        </div>
			    </div> 
			    <div class="form-group row">
			        <label class="col-lg-3 col-form-label form-control-label">Company Type</label>
			        <div class="col-lg-9">
			            <select class="form-control" name="company_type" id="company_type">
			            	<option value="" disabled selected>Select ...</option>
			            	@php 
			            		$types = array('Recruitment Agency', 'Small-Medium Enterprise', 'Multinational', 'Non-Profit Organization', 'Government', 'Others');
			            	@endphp
			            	@foreach($types as $type)
			            		<option value="{{$type}}" 
			            		{{ $type == $emp->emp_type ? 'selected':null }}>{{$type}}</option>
			            	@endforeach
			            </select>

			            <input type="text" name="company_other_type" id="company_other_type" class="mt-1 form-control" placeholder="Other type" value="{{ $emp->emp_type =='Others'? $emp->emp_type_other:null}}" disabled>
						<span id="error-company_type" class="invalid-feedback"></span>
						<span id="error-company_other_type" class="invalid-feedback"></span>
			        </div>
			    </div>
			    <div class="form-group row">
			        <label class="col-lg-3 col-form-label form-control-label">Company Size</label>
			        <div class="col-lg-9">
			            <select class="form-control" name="company_size" id="company_size">
			            	<option value="" disabled selected>Select ...</option>
			            	@php 
			            		$sizes = array('< 30' => 'Less than 30 employees', '30 - 100' => 'Between 30 and 100 employees', '> 100' => 'More than 100 employees');
			            	@endphp
			            	@foreach($sizes as $key => $size)
			            		<option value="{{$key}}" 
			            		{{ $key == $emp->emp_size ? 'selected':null }}>{{$size}}</option>
			            	@endforeach
			            </select>
 
						<span id="error-company_size" class="invalid-feedback"></span>
			        </div>
			    </div>
			    <div class="form-group row">
			        <label class="col-lg-3 col-form-label form-control-label">Company Industry</label>
			        <div class="col-lg-9">
			            <select class="form-control" name="industry" id="industry">
			            	<option value="" disabled selected>Select ...</option>
			            	@php 
			            		$indstrys = \DB::table('industry_company')->get();
			            	@endphp
			            	@foreach($indstrys as $indstry)
			            		<option value="{{$indstry->industry}}" 
			            		{{ $indstry->industry == $emp->emp_industry ? 'selected':null }}>{{$indstry->industry}}</option>
			            	@endforeach
			            </select> 
						<span id="error-industry" class="invalid-feedback"></span> 
			        </div>
			    </div>
			    <div class="form-group row">
			        <label class="col-lg-3 col-form-label form-control-label">Company Preferred Language</label>
			        <div class="col-lg-9">     

						<select class="form-control custom-control" name="lang[]" id="lang" multiple>
							<option value="" disabled disabled>Select one...</option>
							@php
								$langDB = explode(',', $emp->emp_spoken_language);
								$arrayLang = array('Malay', 'English', 'Mandarin', 'Tamil');
								sort($arrayLang);
							@endphp
							@foreach($arrayLang as $lang)
							<option value="{{$lang}}" {{in_array($lang, $langDB) ? 'selected':''}}>{{$lang}}</option>
							@endforeach
							<option value="Other" {{in_array('Other', $langDB) ? 'selected':''}}>Other</option>
						</select>

						<input class="form-control mt-1" type="text" name="other_language" id="other_language" placeholder="Other language eg: France,Arabic,English US,...,etc" value="{{$emp->emp_spoken_language_other}}" disabled/>

			        	<span id="error-lang" class="invalid-feedback"></span> 
			        	<span id="error-other_language" class="invalid-feedback"></span> 
			        </div>
			    </div> 
			    <div class="form-group row">
			        <label class="col-lg-3 col-form-label form-control-label">Company Benefit</label>
			        <div class="col-lg-9">     
			        	<div class="row">
			        		@php
								$benefit = explode(',', $emp->emp_benefit); 
							@endphp
			        		<div class="col-6">
					        	<div class="custom-control custom-checkbox">
								  	<input type="checkbox" class="custom-control-input" id="benefit1" name="benefit[]" value="Company trips" 
								  	{{ in_array('Company trips', $benefit) ? 'checked':'' }}>
								  	<label class="custom-control-label" for="benefit1">Company trips</label>
								</div>
					        	<div class="custom-control custom-checkbox">
								  	<input type="checkbox" class="custom-control-input" id="benefit2" name="benefit[]" value="Gym/fitness memberships" {{ in_array('Gym/fitness memberships', $benefit) ? 'checked':'' }}>
							 	 	<label class="custom-control-label" for="benefit2">Gym/fitness memberships</label>
								</div>
					        	<div class="custom-control custom-checkbox">
								  	<input type="checkbox" class="custom-control-input" id="benefit3" name="benefit[]" value="Medical insurance" {{ in_array('Medical insurance', $benefit) ? 'checked':'' }}>
								  	<label class="custom-control-label" for="benefit3">Medical insurance</label>
								</div>
					        	<div class="custom-control custom-checkbox">
								  	<input type="checkbox" class="custom-control-input" id="benefit4" name="benefit[]" value="Parking allowance" {{ in_array('Parking allowance', $benefit) ? 'checked':'' }}>
								  	<label class="custom-control-label" for="benefit4">Parking allowance</label>
								</div>
							</div> 
			        		<div class="col-6">
					        	<div class="custom-control custom-checkbox">
								  	<input type="checkbox" class="custom-control-input" id="benefit5" name="benefit[]" value="Pension scheme" {{ in_array('Pension scheme', $benefit) ? 'checked':'' }}>
								  	<label class="custom-control-label" for="benefit5">Pension scheme</label>
								</div>
					        	<div class="custom-control custom-checkbox">
								  	<input type="checkbox" class="custom-control-input" id="benefit6" name="benefit[]" value="Team building activities" {{ in_array('Team building activities', $benefit) ? 'checked':'' }}>
								  	<label class="custom-control-label" for="benefit6">Team building activities</label>
								</div>
					        	<div class="custom-control custom-checkbox">
								  	<input type="checkbox" class="custom-control-input" id="benefit7" name="benefit[]" value="Training" {{ in_array('Training', $benefit) ? 'checked':'' }}>
								  	<label class="custom-control-label" for="benefit7">Training</label>
								</div>
					        	<div class="custom-control custom-checkbox">
								  	<input type="checkbox" class="custom-control-input" id="benefit8" name="benefit[]" value="Others" {{ in_array('Others', $benefit) ? 'checked':'' }}>
								  	<label class="custom-control-label" for="benefit8">Others</label>

                            		<input type="text" class="form-control" name="other_benefit" id="other_benefit" placeholder="Others" disabled value="{{ in_array('Others', $benefit) ? $emp->emp_benefit_other:null }}"> 
						        	<span id="error-benefit" class="invalid-feedback"></span> 
						        	<span id="error-other_benefit" class="invalid-feedback"></span> 
								</div>
							</div>
						</div>  

			        </div>
			    </div> 
						    
			    <div class="form-group row">
			        <label class="col-lg-3 col-form-label form-control-label">Address</label>
			        <div class="col-lg-9">
			            <input class="form-control" type="text" value="{{$emp->emp_address}}" name="address" id="address" 
			            value="{{$emp->emp_address}}">

						<span id="error-address" class="invalid-feedback"></span>
			        </div>
			    </div>
			    <div class="form-group row"> 
			        <label class="col-lg-3 col-form-label form-control-label"></label>
			        <div class="col-lg-2">
			            <input class="form-control" type="text" value="{{$emp->emp_zipcode}}" name="zip" id="zip" placeholder="Postcode" 
			            value="{{$emp->emp_zip}}">

			            <span id="error-zip" class="invalid-feedback"></span>
			        </div>
			        <div class="col-lg-2">
			            <input class="form-control" type="text" value="{{$emp->emp_town}}" name="district" id="district" placeholder="District">

			            <span id="error-district" class="invalid-feedback"></span>
			        </div>
			        <div class="col-lg-2">
			            <input class="form-control" type="text" value="{{$emp->emp_city}}" name="city" id="city" placeholder="City">

			            <span id="error-city" class="invalid-feedback"></span>
			        </div>
			        <div class="col-lg-3"> 
			        	<select class="custom-select mr-sm-2" name="state" id="state">
					        <option value="" selected disabled>Choose State...</option> 
			                @foreach($state_array as $state)   
			                	<option value="{{$state->state_name}}" {{$state->state_name == $emp->emp_state ? ' selected':''}}>
			                		{{$state->state_name}}
			                	</option>
			                @endforeach
					    </select>

					    <span id="error-state" class="invalid-feedback"></span>
			        </div> 
			    </div> 
			    <div class="form-group row">
			        <label class="col-lg-3 col-form-label form-control-label">About The Company</label>
			        <div class="col-lg-9">
			            <textarea class="form-control" name="about_us" id="about_us">{!! $emp->emp_aboutus !!}</textarea>
			            <span id="error-about_us" class="invalid-feedback"></span>
			        </div>
			    </div> 
			    <div class="form-group row">
			        <label class="col-lg-3 col-form-label form-control-label">Link 
			        	<span class="small text-danger">(optional)</span>
			        </label>
			        <div class="col-lg-9">
			        	<div class="input-group mb-1">
						  	<div class="input-group-prepend">
							    <div class="input-group-text">
							      	<i class="fas fa-globe-asia"></i>
							    </div>
						  	</div>
						  	<input type="text" class="form-control" name="website" id="website" value="{{$emp->emp_website}}">
					    	<span id="error-website" class="invalid-feedback"></span>
						</div>
			        	<div class="input-group">
						  	<div class="input-group-prepend">
							    <div class="input-group-text">
							      	<i class="fab fa-facebook"></i>
							    </div>
						  	</div>
						  	<input type="text" class="form-control" name="facebook" id="facebook" value="{{$emp->emp_facebook}}">
					    	<span id="error-facebook" class="invalid-feedback"></span>
						</div>
					</div>
			    </div>
			    <legend>Person in charge</legend>
			    <div class="form-group row">
			        <label class="col-lg-3 col-form-label form-control-label">Person Name</label>
			        <div class="col-lg-9">
			            <input type="text" class="form-control" name="person_name" id="person_name" value="{{$emp->emp_ctc_person}}"> 
					  	<span id="error-person_name" class="invalid-feedback"></span>
			        </div>
			    </div>
			    <div class="form-group row">
			        <label class="col-lg-3 col-form-label form-control-label">Person Contact Number</label>
			        <div class="col-lg-9">
			            <input type="text" class="form-control" name="person_ctc" id="person_ctc" value="{{$emp->emp_ctc_tel}}"> 
					  	<span id="error-person_ctc" class="invalid-feedback"></span>
			        </div>
			    </div>
			    
			    <div class="form-group row">
			        <label class="col-lg-3 col-form-label form-control-label"></label>
			        <div class="col-lg-9">
			            <input type="reset" class="btn btn-secondary" value="Cancel">
			            <input type="submit" class="btn btn-primary" value="Save Changes">
			        </div>
			    </div>
			{!! Form::close() !!}
		</div>
	</div>
</div>