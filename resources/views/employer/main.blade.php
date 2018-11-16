@extends('layouts.master_emp')

@section('title', 'Employer')

@section('content') 
<!-- Intro Seven -->
<section class="intro carousel slide bg-overlay-light h-auto" id="carouselExampleCaptions">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="1" class=""></li>
    </ol>
    <div class="carousel-inner" role="listbox">
      <div class="carousel-item active">
        <img class="d-block img-fluid" alt="First slide" src="{{asset('public/images/slider/background_first.jpg')}}">
        <div class="carousel-caption ">
          	<h2 class="display-4 text-white mb-2 mt-4">Free unlimited job posting</h2>
			<p class="text-white mb-3 px-5 lead">View our resumes on Workshire</p>
			<a href="" class="btn btn-primary btn-capsul px-4 py-2">Explore More</a>
        </div>
      </div> 
    </div>
    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
</section> 

<!-- Info block 1 -->
<section class="info-section">
	<div class="container">
		<div class="head-box text-center mb-5">
			<h2>Who We Are</h2>
			<h6 class="text-underline-primary">Online job space where employers meet talents</h6>
		</div>
		<div class="three-panel-block mt-5">
			<div class="row">
				<div class="col-lg-4 col-md-6 col-sm-6">
					<div class="service-block-overlay text-center mb-5 p-lg-3">
						<i class="fa fa-laptop box-circle-solid mt-3 mb-3" aria-hidden="true"></i>
						<h3>Recruiter</h3>
						<p class="px-4">An online jobspace and recruiting website operated by Talent Workshire Sdn Bhd</p>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-6">
					<div class="service-block-overlay text-center mb-5 p-lg-3">
						<i class="fa fa-user box-circle-solid mt-3 mb-3" aria-hidden="true"></i>
						<h3>Support by</h3>
						<p class="px-4">Team of professionals with over 20 years Human Resource Management Experiences ranging from Talent Acquistion 
                        </p>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-6">
					<div class="service-block-overlay text-center mb-5 p-lg-3">
						<i class="fa fa-map-marker box-circle-solid mt-3 mb-3" aria-hidden="true"></i>
						<h3>Locate</h3>
						<p class="px-4">Penang, Malaysia</p>
					</div>
				</div> 
			</div>
		</div>
	</div>
</section>


<!-- Info block 1 -->
<section class="info-section bg-primary py-0">
	<div class="container-fluid">
		<div class="row">
            <div class="col-md-6 col-lg-6 content-half mt-md-0 pl-5 pt-4">
                <div class="head-box mb-2 pl-5 mt-2">
					<h2 class="text-white">Your Benefit</h2>
					<h6 class="text-white text-underline-rb-white">
						<span class="futura">Workshire</span> help company to find the right candidates for your hiring
					</h6>
				</div>
                <ul class="pl-5">
                    <li>
                    	<i class="fa fa-briefcase  box-round-outline" aria-hidden="true"></i>
                    	<span class="list-content">
                    		<strong>Free job posting</strong> 
                    	</span>
                	</li>
                    <li>
                    	<i class="fa fa-file-pdf-o box-round-outline" aria-hidden="true"></i>
                    	<span class="list-content">
                    		<strong>Free resume tokens where term & conditions applied</strong> 
                    	</span>
                    </li> 
                    <li>
                    	<i class="fa fa-fighter-jet box-round-outline" aria-hidden="true"></i>
                    	<span class="list-content">
                    		<strong>Faster and simple steps</strong> 
                    	</span>
                    </li> 
                    <li>
                    	<i class="fa fa-users box-round-outline" aria-hidden="true"></i>
                    	<span class="list-content">
                    		<strong>Reliable team to support your unique requirement</strong> 
                    	</span>
                    </li>  
                </ul>
            </div>
            <div class="col-md-6 p-0 m-0">
            	<img src="{{asset('public/images/slider/background_second.jpg')}}" class="img-fluid">
            </div>
        </div>
</section> 
@endsection