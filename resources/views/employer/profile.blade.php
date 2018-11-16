@extends('layouts.master')

@section('title', 'Profile')

@section('content')
<main class="py-0 mb-2"> 
	<div class="row my-1 mx-2">
		<div class="col-sm-12 mb-2">
			<h3>Profile</h3>
			<p style="margin-bottom:-0.2em;" class="text-danger">Your profile not update, please update your profile.</p> 
			<hr style="height:1px;border-width:0;background-color:#6066c4">
		</div>
 
		<div class="col-sm ml-sm-2"> 
			<div class="emp-profile">
	            <form method="post">
	                <div class="row">
	                    <div class="col-md-4">
	                        <div class="profile-img">  
								@if(file_exists(public_path().'/default_pictures/medium/'.$employer->emp_logo_loc))
	                            <img src="{{asset('public/default_pictures/medium/').'/'.$employer->emp_logo_loc}}" style="width: 275px;height: 183px;" class="img-thumbnail img-fluid" />
	                            @else 
	                            <img src="{{asset('public/images/default/company.jpg')}}" alt="" style="width: 275px;height: 183px;"/>
	                            @endif
	                            <div class="file btn btn-lg btn-primary">
	                                Change Photo
	                                <input type="file" name="file"/>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="col-md-6">
	                        <div class="profile-head">
                                <h5 class="text-uppercase">{!!$employer->emp_name!!}</h5>
                                <h6 class="text-uppercase">{!!$employer->emp_regno!!}</h6>
                                <p class="proile-rating">RANKINGS : <span>8/10</span></p>
	                            <ul class="nav nav-tabs" id="myTab" role="tablist">
	                                <li class="nav-item">
	                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
	                                </li>
	                                <li class="nav-item">
	                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Location</a>
	                                </li>
	                            </ul>
	                        </div>
	                    </div>
	                    <div class="col-md-2">
	                        <input type="submit" class="profile-edit-btn" name="btnAddMore" value="Edit Profile"/>
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
	                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="row">
                                        <div class="col-md-12"> 

                                        </div>
                                    </div> 
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </form>           
	        </div>
		</div>   
	</div>
</main>
<!-- Footer -->  
@include('includes.footer') 

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