@extends('layouts.master')

@section('title', 'About Us')     

@section('content')     
<main class="py-0"> 
	<div class="container"> 
	    <h2 class="mt-3">About Us</h2>
	    <div class="row mb-4">
	        <div class="col">
	          <div class="card">
	            <div class="card-body"> 
	              <p class="card-text text-justify text-dark">
	              	<scan class="futura futuraCOLOR">Workshire</scan> is an online jobspace and recruiting website operated by Talent Suites Sdn Bhd. Our team based in Penang, Malaysia and supported by team of professionals with over 20 years Human Resource Management Experiences ranging from Talent Acquistion, on boarding, talent development, and change management transition out/outplacement. 
	              </p> 
	              <p class="card-text text-justify text-dark">
	              	Talent Suites Sdn Bhd decided to developed <scan class="futura futuraCOLOR">Workshire</scan> because we believe in making the hiring process easy. 
	              </p> 
	              <p class="card-text text-justify text-dark">
	              	At <scan class="futura futuraCOLOR">Workshire</scan>, we value the connections between the people and their potential employers or companies. We take pride in ensuring that our clients meet their desired goals - for employers to fond the perfect candidates and for people to find the jobs they want.
	              </p> 
	            </div>
	          </div>
	        </div>
	    </div>
	    <h4 class="mt-1">Why <scan class="futura futuraCOLOR">Workshire</scan>?</h4>
		<div class="row">
			<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
				<div class="our-services-wrapper mb-60">
					<div class="services-inner">
						<div class="our-services-img">
						<img src="https://www.orioninfosolutions.com/assets/img/icon/Agricultural-activities.png" width="68px" alt="">
						</div>
						<div class="our-services-text">
							<h4>vision and mission</h4>
							<p>To make sure your hiring interview happens in the next 2 days.</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
				<div class="our-services-wrapper mb-60">
					<div class="services-inner">
						<div class="our-services-img">
						<img src="https://www.orioninfosolutions.com/assets/img/icon/Agricultural-activities.png" width="68px" alt="">
						</div>
						<div class="our-services-text">
							<h4>Easy Hire</h4>
							<p>We want to make hiring easy</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
				<div class="our-services-wrapper mb-60">
					<div class="services-inner">
						<div class="our-services-img">
						<img src="https://www.orioninfosolutions.com/assets/img/icon/Agricultural-activities.png" width="68px" alt="">
						</div>
						<div class="our-services-text">
							<h4>3 Simple Step easy to Follow</h4>
							<p>
								<ol style="margin-left:-1.1em;">
									<li>Sign up with us.</li>
									<li>Explore oppurtunities.</li>
									<li>Get the job done.</li>
								</ol>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> 
</main>
<!-- Footer -->  
@include('includes.footer') 

@endsection