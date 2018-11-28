<div class="container card completeprof">
	<div class="row">
		<div class="col"> 
			<h4>Complete Profile</h4>
			<form role="form" method="post" action="{{route('seeker.profile.update')}}" id="editprofile">
				@csrf  
				<input type="hidden" name="id" value="{{$seek->id}}"/>
			    <div class="form-group row">
			        <label class="col-lg-3 col-form-label form-control-label">Type</label>
			        <div class="col-lg-9">
			            <div class="custom-control custom-radio custom-control-inline">
						    <input type="radio" class="custom-control-input" id="seektype1" name="seektype" value="FRESH" 
						    {{$seek->seeker_type == 'FRESH'? ' checked':''}}/>
						    <label class="custom-control-label" for="seektype1">Fresh Graduate</label>
					  	</div>
			            <div class="custom-control custom-radio custom-control-inline">
						    <input type="radio" class="custom-control-input" id="seektype2" name="seektype" value="EXPERIENCE" 
						    {{$seek->seeker_type == 'EXPERIENCE'? ' checked':''}}/>
						    <label class="custom-control-label" for="seektype2">Experience</label>
					  	</div>
						<span id="error-seektype" class="invalid-feedback"></span>
			        </div>
			    </div> 
			    <div class="form-group row">
			        <label class="col-lg-3 col-form-label form-control-label">Full name</label>
			        <div class="col-lg-9">
			            <input class="form-control" type="text" value="{{old('name') !== null ? old('name'):$seek->seeker_name}}" name="name" id="name" placeholder="" /> 
						<span id="error-name" class="invalid-feedback"></span> 
			        </div>
			    </div> 
			    <div class="form-group row">
			        <label class="col-lg-3 col-form-label form-control-label">Gender</label>
			        <div class="col-lg-9">
			            <div class="custom-control custom-radio custom-control-inline">
						    <input type="radio" class="custom-control-input" id="genderM" name="gender" value="M"
						    {{$seek->seeker_gender=='M' ? ' checked':''}}/>
						    <label class="custom-control-label" for="genderM"><i class="fas fa-male fa-lg"></i></label>
					  	</div>
			            <div class="custom-control custom-radio custom-control-inline">
						    <input type="radio" class="custom-control-input" id="genderF" name="gender" value="F"
						    {{$seek->seeker_gender=='F' ? ' checked':''}}/>
						    <label class="custom-control-label" for="genderF"><i class="fas fa-female fa-lg"></i></label>
					  	</div>
						<span id="error-gender" class="invalid-feedback"></span>
			        </div>
			    </div>
			    <div class="form-group row">
			        <label class="col-lg-3 col-form-label form-control-label">National Registration Identity Card / Passport Number</label>
			        <div class="col-lg-9">  
			            <?php 	$raw_nric = $seek->seeker_nric; 
			            		$len = strlen($raw_nric);
							  	if( $len == 12 )
							  	{
									$nric_date = str_split($raw_nric,6); 
									$nric_state = str_split($raw_nric,2);  
									$nric_ic = str_split($raw_nric,4);    
								}
						?> 
						<div class="custom-control custom-radio custom-control-inline">
						    <input type="radio" class="custom-control-input" id="ic_type1" name="ic_type" value="malay" 
						    {{$len == 12? ' checked':''}}/>
						    <label class="custom-control-label" for="ic_type1">Malaysian</label>
					  	</div>
			            <div class="custom-control custom-radio custom-control-inline">
						    <input type="radio" class="custom-control-input" id="ic_type2" name="ic_type" value="non malay" 
						    {{$len != 12? ' checked':''}}/>
						    <label class="custom-control-label" for="ic_type2">Non Malaysian</label>
					  	</div> 
					  	<!--nric_field-->
			            <div class="input-group mb-3" id="nric_field" style="display:none;"> 
						  	<input type="text" class="form-control" name="nric_date" id="nric_date" 
						  	aria-describedby="basic-addon1" value="{{$len == 12 ? $nric_date[0]:''}}" maxlength="6" />
						  	<div class="input-group-prepend">
					    		<span class="input-group-text" id="basic-addon1">-</span>
						  	</div>
						  	<input type="text" class="form-control" name="nric_state" id="nric_state" 
						  	aria-describedby="basic-addon1" value="{{$len == 12 ? $nric_state[1]:''}}" maxlength="2"/>
						  	<div class="input-group-prepend">
					    		<span class="input-group-text" id="basic-addon1">-</span>
						  	</div>
						  	<input type="text" class="form-control" name="nric_ic" id="nric_ic" 
						  	aria-describedby="basic-addon1" value="{{$len == 12 ? $nric_ic[2]:''}}" maxlength="4"/> 

							<input type="hidden" name="nric_full" id="nric_full" value="{{$seek->seeker_nric}}"/>
							<span id="error-nric_full" class="text-danger"></span>
						  	<span id="error-nric_date" class="invalid-feedback"></span>
							<span id="error-nric_state" class="invalid-feedback"></span>
							<span id="error-nric_ic" class="invalid-feedback"></span> 
						</div> 
					  	<!--passport_field-->
			            <div class="mb-3" id="passport_field" style="display:none;"> 
						  	<input type="text" class="form-control" name="nric" id="nric" 
						  	value="{{$len != 12 ? $seek->seeker_nric:''}}" placeholder="Passport number" />
							<span id="error-nric" class="invalid-feedback"></span> 
						</div> 
			        </div>
			    </div> 
			    <div class="form-group row">
			        <label class="col-lg-3 col-form-label form-control-label">Date of Birth</label>
			        <div class="col-lg-9">     
			            <div class="input-group mb-3">  
						  	<select class="custom-select" name="day" id="day" aria-describedby="basic-addon2">
						    	<option value="" selected>Select day</option> 
					    		@foreach(range(01, 31) as $x)
					    		<option value="{{$x}}" {{$x == date('d', strtotime($seek->seeker_DOB)) ? ' selected':''}}>
					    			{{$x}}
					    		</option>
					    		@endforeach
						    </select>
						  	<div class="input-group-prepend">
					    		<span class="input-group-text" id="basic-addon2">-</span>
						  	</div>
						  	<select class="custom-select" name="month" id="month" aria-describedby="basic-addon2">
						    	<option value="" selected>Select month</option> 
					    		@foreach(range(01, 12) as $x)
					    		<option value="{{$x}}" {{$x == date('m', strtotime($seek->seeker_DOB)) ? ' selected':''}}>
					    			{{$x}}
					    		</option>
					    		@endforeach
						    </select>
						  	<div class="input-group-prepend">
					    		<span class="input-group-text" id="basic-addon2">-</span>
						  	</div> 
						  	<select class="custom-select" name="year" id="year" aria-describedby="basic-addon2">
						    	<option value="" selected>Select year</option> 
					    		@foreach(range(1950, date('Y')) as $x)
					    		<option value="{{$x}}" {{$x == date('Y', strtotime($seek->seeker_DOB)) ? ' selected':''}}>
					    			{{$x}}
					    		</option>
					    		@endforeach
						    </select>

							<span id="error-day" class="invalid-feedback"></span>
							<span id="error-month" class="invalid-feedback"></span>
							<span id="error-year" class="invalid-feedback"></span>
						</div>
			        </div>
			    </div>  
						    
			    <div class="form-group row">
			        <label class="col-lg-3 col-form-label form-control-label">Address</label>
			        <div class="col-lg-9">
			            <input class="form-control" type="text" value="{{$seek->seeker_address}}" name="seeker_address" id="seeker_address">

						<span id="error-seeker_address" class="invalid-feedback"></span>
			        </div>
			    </div>
			    <div class="form-group row"> 
			        <label class="col-lg-3 col-form-label form-control-label"></label>
			        <div class="col-lg-2">
			            <input class="form-control" type="text" value="{{$seek->seeker_zip}}" name="seeker_zip" id="seeker_zip">

			            <span id="error-seeker_zip" class="invalid-feedback"></span>
			        </div>
			        <div class="col-lg-4">
			            <input class="form-control" type="text" value="{{$seek->seeker_city}}" name="seeker_city" id="seeker_city">

			            <span id="error-seeker_city" class="invalid-feedback"></span>
			        </div>
			        <div class="col-lg-3"> 
			        	<select class="custom-select mr-sm-2" name="seeker_state" id="seeker_state">
					        <option value="" selected>Choose State...</option> 
			                @foreach($state_array as $state)   
			                	<option value="{{$state->state_name}}" {{$state->state_name == $seek->seeker_state ? ' selected':''}}>
			                		{{$state->state_name}}
			                	</option>
			                @endforeach
					    </select>

					    <span id="error-seeker_state" class="invalid-feedback"></span>
			        </div> 
			    </div> 
			    <div class="form-group row">
			        <label class="col-lg-3 col-form-label form-control-label">Telephone Number</label>
			        <div class="col-lg-9">
			            <input class="form-control" type="text" value="{{$seek->seeker_ctc_tel1}}" name="seeker_ctc_tel1" id="seeker_ctc_tel1">

			            <span id="error-seeker_ctc_tel1" class="invalid-feedback"></span>
			        </div>
			    </div> 
			    <div class="form-group row">
			        <label class="col-lg-3 col-form-label form-control-label">Expected Salary</label>
			        <div class="col-lg-9">
			        	<select class="custom-select mr-sm-2" name="seeker_expect_salary" id="seeker_expect_salary">
					        <option value="" selected>Choose State...</option> 
			                @foreach($salarys as $salary)   
			                	<option value="{{$salary->rangeValue}}"
			                		{{$salary->rangeValue == $seek->seeker_expect_salary ? ' selected':''}}>
			                		MYR {{$salary->rangeFrom}} - {{$salary->rangeTo}}
			                	</option>
			                @endforeach
					    </select>
					    <span id="error-seeker_expect_salary" class="invalid-feedback"></span>
					</div>
			    </div>
			    <div class="form-group row">
			        <label class="col-lg-3 col-form-label form-control-label">Travel / Relocate</label>
			        <div class="col-lg-9">
			            <div class="custom-control custom-radio custom-control-inline">
						    <input type="radio" class="custom-control-input" id="travel1" name="travel" value="willing" 
						    {{$seek->seeker_will_travel == 'willing'? ' checked':''}}/>
						    <label class="custom-control-label" for="travel1">Willing</label>
					  	</div>
			            <div class="custom-control custom-radio custom-control-inline">
						    <input type="radio" class="custom-control-input" id="travel2" name="travel" value="no willing" 
						    {{$seek->seeker_will_travel == 'no willing'? ' checked':''}}/>
						    <label class="custom-control-label" for="travel2">No willing</label>
					  	</div>

					  	<span id="error-travel" class="invalid-feedback"></span>
			        </div>
			    </div>
			    <div class="form-group row">
			        <label class="col-lg-3 col-form-label form-control-label">Language</label>
			        <div class="col-lg-9">     

						<select class="form-control custom-control" name="lang[]" id="lang" multiple>
							<option value="" disabled>Select one...</option>
							<?php 
							$langDB = explode(',', $seek->seeker_language);
							$arrayLang = array('Malay', 'English', 'Mandarin', 'Tamil');
							sort($arrayLang);
							?> 
							@foreach($arrayLang as $lang)
							<option value="{{$lang}}" {{in_array($lang, $langDB) ? 'selected':''}}>{{$lang}}</option>
							@endforeach
							<option value="Other" {{in_array('Other', $langDB) ? 'selected':''}}>Other</option>
						</select>

						<input class="form-control mt-1" type="text" name="other_language" id="other_language" placeholder="Other language eg: France,Arabic,English US" value="{{$seek->seeker_language_other}}" disabled/>

			        	<span id="error-lang" class="invalid-feedback"></span> 
			        	<span id="error-other_language" class="invalid-feedback"></span> 
			        </div>
			    </div>
			    <div class="form-group row">
			        <label class="col-lg-3 col-form-label form-control-label">Skill</label>
			        <div class="col-lg-9"> 
		                <a class="btn btn-sm btn-info btn-add-more-skill text-light">Add more skill</a> 
		                   
		            	<?php $array_skill = explode(',', $seek->seeker_skillSets); ?>
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
						<div  class="onerowskill"></div> 
			        </div>
			    </div>
			    <div class="form-group row">
			        <label class="col-lg-3 col-form-label form-control-label"></label>
			        <div class="col-lg-9">
			            <input type="reset" class="btn btn-secondary" value="Cancel">
			            <input type="submit" class="btn btn-primary" value="Save Changes">
			        </div>
			    </div>
			</form> 
		</div>
	</div>
</div>