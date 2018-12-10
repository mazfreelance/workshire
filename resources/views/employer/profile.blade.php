@extends('layouts.master')

@section('title', 'Profile')

@section('content')
<main class="py-0 mb-2"> 
	<div class="row my-1 mx-2">
		<div class="col-sm-12 mb-2">
			<h3>Profile</h3>
			<hr style="height:1px;border-width:0;background-color:#6066c4">
		</div>
 
		<div class="col-sm ml-sm-2"> 
			<div class="emp-profile">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">  
							@if(file_exists(public_path().'/default_pictures/medium/'.$employer->emp_logo_loc))
                            <img src="{{asset('public/default_pictures/medium/').'/'.$employer->emp_logo_loc}}" style="width: 275px;height: 183px;" class="img-thumbnail img-fluid" />
                            @else 
                            <img src="{{asset('public/images/default/company.jpg')}}" alt="" style="width: 275px;height: 183px;"/>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
                            <h5 class="text-uppercase">{!!$employer->emp_name!!}</h5>
                            <h6 class="text-uppercase">{!!$employer->emp_regno!!}</h6>
                            <!--<p class="proile-rating">RANKINGS : <span>8/10</span></p>-->
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#location" role="tab" aria-controls="profile" aria-selected="false">Location</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Edit</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="" id="addphoto">Update new photo</a>
                                    @include('employer.profile.includes.modalphoto')
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-work"> 
                            <p>WORK BENEFIT</p> 
                            <ul>
                            	@if(isset($employer->emp_benefit))
	                            	<?php $arrBenefit = explode(',', $employer->emp_benefit); ?>
	                            	@foreach($arrBenefit as $benefit)
	                            	@if($benefit == 'Others')
                            			<li>{{$employer->emp_benefit_other}}</li>
                            		@else 
	                            		<li>{{$benefit}}</li>
	                            	@endif
	                            	@endforeach
                            	@else
                            		<li>{{__('No results found.')}}</li>
                            	@endif 
                            </ul>

                            <p>WORK LANGUAGE</p> 
                            <ul>
                            	@if(isset($employer->emp_spoken_language))
	                            	<?php $arrBenefit = explode(',', $employer->emp_spoken_language); ?>
	                            	@foreach($arrBenefit as $benefit)
	                            	<li>{{$benefit}}</li>
	                            	@endforeach
                            	@else
                            		<li>{{__('No results found.')}}</li>
                            	@endif
                            </ul>

                            <p>WORKING HOUR</p> 
                            <ul>
                            	@if(isset($employer->emp_workhour))
                            	<li>{!!$employer->emp_workhour!!}</li> 
                            	@else
                            		<li>{{__('No results found.')}}</li>
                            	@endif
                            </ul>

                            <p>WORK LINK</p>
                            @if(isset($employer->emp_website))
                        		<a href="http://{{$employer->emp_website}}" target="_blank" class="d-block">
                        			<i class="fas fa-globe"></i>&nbsp;Our Site
                        		</a> 
                        	@else
                        		<a>{{__('No results found.')}}</a>
                        	@endif

                        	@if(isset($employer->emp_facebook))
                        		<a href="http://{{$employer->emp_facebook}}" target="_blank" class="d-block">
                        			<i class="fab fa-facebook-f"></i>&nbsp;&nbsp;Our Facebook
                        		</a>
                        	@else
                        		<a>{{__('No results found.')}}</a>
                        	@endif
                            	
                            	 
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Company Address</label>
                                    </div>
                                    <div class="col-md-9 text-justify"> 
                                        	{!!$employer->emp_aboutus!!} 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>About Us</label>
                                    </div>
                                    <div class="col-md-9 text-justify">
                                    	@if(isset($employer->emp_address))
                                        {!! 
                                        	$employer->emp_address.', '.$employer->emp_address
                                        	.', '.$employer->emp_town
                                        	.' '.$employer->emp_zipcode
                                        	.' '.$employer->emp_city
                                        	.', '.$employer->emp_state 
                                        !!}
                                        @else 
                                        {!! 
                                        	$employer->emp_city.', '.$employer->emp_state 
                                        !!}
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Employment Type</label>
                                    </div>
                                    <div class="col-md-9">
                                        <p>{!!$employer->emp_type!!}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Industry</label>
                                    </div>
                                    <div class="col-md-9">
                                        <p>{!!$employer->emp_industry!!}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Company Size</label>
                                    </div>
                                    <div class="col-md-9">
                                        <p>
                                        	{!!isset($employer->emp_size) ? $employer->emp_size.' people' : ''!!}
                                        </p>
                                    </div>
                                </div> 
                            </div>
                            <div class="tab-pane fade" id="location" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="row">
                                    <div class="col-md-12"> 

                                    </div>
                                </div> 
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="row">
                                    <div class="col-md-12"> 
                                        {!! Form::open(['id' => 'editprofile', 'route' => 'employer.profile_post']) !!}
                                            <input type="hidden" name="id" value="{{$employer->id}}"/> 
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label">Company name</label>
                                                <div class="col-lg-9">
                                                    <input class="form-control" type="text" value="{{old('company_name') !== null ? old('company_name'):$employer->emp_name}}" name="company_name" id="company_name"/> 
                                                    <span id="error-company_name" class="invalid-feedback"></span> 
                                                </div>
                                            </div> 
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label">Company Register Number / SSM No.</label>
                                                <div class="col-lg-9">
                                                    @if($employer->emp_regno !== '') 
                                                    <input class="form-control" type="text" value="{{ $employer->emp_regno }}" name="ssm_no" id="ssm_no" readonly/> 
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
                                                            {{ $type == $employer->emp_type ? 'selected':null }}>{{$type}}</option>
                                                        @endforeach
                                                    </select>

                                                    <input type="text" name="company_other_type" id="company_other_type" class="mt-1 form-control" placeholder="Other type" value="{{ $employer->emp_type =='Others'? $employer->emp_type_other:null}}" disabled>
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
                                                            {{ $key == $employer->emp_size ? 'selected':null }}>{{$size}}</option>
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
                                                            {{ $indstry->industry == $employer->emp_industry ? 'selected':null }}>{{$indstry->industry}}</option>
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
                                                            $langDB = explode(',', $employer->emp_spoken_language);
                                                            $arrayLang = array('Malay', 'English', 'Mandarin', 'Tamil');
                                                            sort($arrayLang);
                                                        @endphp
                                                        @foreach($arrayLang as $lang)
                                                        <option value="{{$lang}}" {{in_array($lang, $langDB) ? 'selected':''}}>{{$lang}}</option>
                                                        @endforeach
                                                        <option value="Other" {{in_array('Other', $langDB) ? 'selected':''}}>Other</option>
                                                    </select>

                                                    <input class="form-control mt-1" type="text" name="other_language" id="other_language" placeholder="Other language eg: France,Arabic,English US,...,etc" value="{{$employer->emp_spoken_language_other}}" disabled/>

                                                    <span id="error-lang" class="invalid-feedback"></span> 
                                                    <span id="error-other_language" class="invalid-feedback"></span> 
                                                </div>
                                            </div> 
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label">Company Benefit</label>
                                                <div class="col-lg-9">     
                                                    <div class="row">
                                                        @php
                                                            $benefit = explode(',', $employer->emp_benefit); 
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

                                                                <input type="text" class="form-control" name="other_benefit" id="other_benefit" placeholder="Others" disabled value="{{ in_array('Others', $benefit) ? $employer->emp_benefit_other:null }}"> 
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
                                                    <input class="form-control" type="text" value="{{$employer->emp_address}}" name="address" id="address" 
                                                    value="{{$employer->emp_address}}">

                                                    <span id="error-address" class="invalid-feedback"></span>
                                                </div>
                                            </div>
                                            <div class="form-group row"> 
                                                <label class="col-lg-3 col-form-label form-control-label"></label>
                                                <div class="col-lg-2">
                                                    <input class="form-control" type="text" value="{{$employer->emp_zipcode}}" name="zip" id="zip" placeholder="Postcode" 
                                                    value="{{$employer->emp_zip}}">

                                                    <span id="error-zip" class="invalid-feedback"></span>
                                                </div>
                                                <div class="col-lg-2">
                                                    <input class="form-control" type="text" value="{{$employer->emp_town}}" name="district" id="district" placeholder="District">

                                                    <span id="error-district" class="invalid-feedback"></span>
                                                </div>
                                                <div class="col-lg-2">
                                                    <input class="form-control" type="text" value="{{$employer->emp_city}}" name="city" id="city" placeholder="City">

                                                    <span id="error-city" class="invalid-feedback"></span>
                                                </div>
                                                <div class="col-lg-3"> 
                                                    <select class="custom-select mr-sm-2" name="state" id="state">
                                                        <option value="" selected disabled>Choose State...</option> 
                                                        @foreach($state_array as $state)   
                                                            <option value="{{$state->state_name}}" {{$state->state_name == $employer->emp_state ? ' selected':''}}>
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
                                                    <textarea class="form-control" name="about_us" id="about_us">{!! $employer->emp_aboutus !!}</textarea>
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
                                                        <input type="text" class="form-control" name="website" id="website" value="{{$employer->emp_website}}">
                                                        <span id="error-website" class="invalid-feedback"></span>
                                                    </div>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <i class="fab fa-facebook"></i>
                                                            </div>
                                                        </div>
                                                        <input type="text" class="form-control" name="facebook" id="facebook" value="{{$employer->emp_facebook}}">
                                                        <span id="error-facebook" class="invalid-feedback"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <legend>Person in charge</legend>
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label">Person Name</label>
                                                <div class="col-lg-9">
                                                    <input type="text" class="form-control" name="person_name" id="person_name" value="{{$employer->emp_ctc_person}}"> 
                                                    <span id="error-person_name" class="invalid-feedback"></span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label">Person Contact Number</label>
                                                <div class="col-lg-9">
                                                    <input type="text" class="form-control" name="person_ctc" id="person_ctc" value="{{$employer->emp_ctc_tel}}"> 
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
                        </div>
                    </div>
                </div>        
	        </div>
		</div>   
	</div>
</main>
<!-- Footer -->  
@include('includes.footer') 

@include('employer.profile.includes.script') 

@endsection 
@section('css')
<style>
.emp-profile{
    padding: 3%;
    margin-top: 0;
    margin-bottom: 0;
    border-radius: 0.5rem;
    background: #fff;
}
.profile-img{
    text-align: center;
}
.profile-img img{
    width: 70%;
    height: 100%;
}
.profile-img .file {
    position: relative;
    overflow: hidden;
    margin-top: -20%;
    width: 70%;
    border: none;
    border-radius: 0;
    font-size: 15px;
    background: #212529b8;
}
.profile-img .file input {
    position: absolute;
    opacity: 0;
    right: 0;
    top: 0;
}
.profile-head h5{
    color: #333;
}
.profile-head h6{
    color: #0062cc;
}
.profile-edit-btn{
    border: none;
    border-radius: 1.5rem;
    width: 70%;
    padding: 2%;
    font-weight: 600;
    color: #6c757d;
    cursor: pointer;
}
.proile-rating{
    font-size: 12px;
    color: #818182;
    margin-top: 5%;
}
.proile-rating span{
    color: #495057;
    font-size: 15px;
    font-weight: 600;
}
.profile-head .nav-tabs{
    margin-bottom:5%;
}
.profile-head .nav-tabs .nav-link{
    font-weight:600;
    border: none;
}
.profile-head .nav-tabs .nav-link.active{
    border: none;
    border-bottom:2px solid #0062cc;
}
.profile-work{
    padding: 14%;
    margin-top: -15%;
}
.profile-work p{
    font-size: 12px;
    color: #818182;
    font-weight: 600;
    margin-top: 10%;
}
.profile-work a{
    text-decoration: none;
    color: #495057;
    font-weight: 600;
    font-size: 14px;
}
.profile-work ul{
    list-style: none;
}
.profile-tab label{
    font-weight: 600;
}
.profile-tab p{
    font-weight: 600;
    color: #0062cc;
}
</style>
@endsection