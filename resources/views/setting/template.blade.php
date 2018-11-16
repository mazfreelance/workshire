@extends('layouts.master')

@section('title', 'Setting')

@section('content')     
<main class="py-0 mb-5"> 
	<div class="row my-1 mx-2">
		<div class="col-sm-12 mb-2">
			<h3>Setting</h3>
			<p style="margin-bottom:-0.2em;">You can set your account</p>
		</div>   
		<div class="col-sm-12">  
		  	<div class="row justify-content-around">
			    <div class="col-md-4 border border-dark">
			    	<h5 class="mt-2">You</h5> 
					@include('setting.includes.nav')
			    </div>
			    <div class="col-md-7 mt-sm-0 mt-2 border border-dark">
			      	<div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
						<div class="tab-pane fade show active" id="nav-account" role="tabpanel" aria-labelledby="nav-account-tab">
							<h5 class="my-2"><span class="fa fa-user float-right"></span> Account Settings</h5> 
							<form>
							  	<div class="form-group row">
								    <label for="emailUser" class="col-sm-2 col-form-label">Email</label>
								    <div class="col-sm-10">
								      	<input type="email" class="form-control" id="emailUser" placeholder="Email">
								    </div>
							  	</div>
							  <div class="form-group row">
							    <label for="usernameUser" class="col-sm-2 col-form-label">Username</label>
							    <div class="col-sm-10">
							      <input type="text" class="form-control" id="usernameUser" placeholder="Username">
							    </div>
							  </div> 
							  <div class="form-group row">
							    <div class="col-sm-10">
							      <button type="submit" class="btn btn-third">Update</button>
							    </div>
							  </div>
							</form>
						</div>
						<div class="tab-pane fade" id="nav-password" role="tabpanel" aria-labelledby="nav-password-tab">
							<h5 class="my-2"><span class="fa fa-key float-right"></span> Reset Password Settings</h5> 
							<form>
							  	<div class="form-group row">
								    <label for="passwordUser" class="col-sm-2 col-form-label">New Password</label>
								    <div class="col-sm-10">
								      	<input type="password" class="form-control" id="passwordUser" placeholder="Email">
								    </div>
							  	</div>
							  <div class="form-group row">
							    <label for="newPasswordUser" class="col-sm-2 col-form-label">Confirm New Password</label>
							    <div class="col-sm-10">
							      <input type="password" class="form-control" id="newPasswordUser" placeholder="Username">
							    </div>
							  </div> 
							  <div class="form-group row">
							    <div class="col-sm-10">
							      <button type="submit" class="btn btn-third">Change</button>
							    </div>
							  </div>
							</form>
						</div>
						<div class="tab-pane fade" id="nav-notification" role="tabpanel" aria-labelledby="nav-notification-tab">
							<h5 class="my-2"><span class="fa fa-bell float-right"></span> Notification</h5> 
							<h6 class="mb-1">Subscriptions</h6>
							<form>  
							  <div class="form-group row"> 
							    <div class="col-sm-12"> 
									<span class="small">I would like to receive Emails updates for: Important notifications on Workshire.com.my products, Job Opportunities, job seeker services & career advice</span>
							    </div>
							    <div class="col-sm-10">
							      <div class="form-check">
							        <input class="form-check-input" type="checkbox" id="gridCheck1">
							        <label class="form-check-label" for="gridCheck1">
							          Emails
							        </label>
							      </div>
							    </div>
							  </div>
							  <div class="form-group row"> 
							    <div class="col-sm-12"> 
									<span class="small">Promotions & special offers</span>
							    </div>
							    <div class="col-sm-10">
							      <div class="form-check">
							        <input class="form-check-input" type="checkbox" id="gridCheck1">
							        <label class="form-check-label" for="gridCheck1">
							          Emails
							        </label>
							      </div>
							    </div>
							  </div>
							  <div class="form-group row">
							    <div class="col-sm-10">
							      <button type="submit" class="btn btn-primary">Update</button>
							    </div>
							  </div>
							</form>
						</div> 
						<div class="tab-pane fade" id="nav-plan-billing" role="tabpanel" aria-labelledby="nav-plan-billing-tab"> 
							<h5 class="my-2"><span class="fa fa-truck float-right"></span> Plans & Billing Settings</h5> 
							<span class="d-block">Your subscriptions: <span class="font-weight-bold">FREE</span></span>
							<span class="d-block">Member since: 30th September 2018</span>
							<span class="d-block">
								<button type="submit" class="btn btn-success">Upgrade</button>
							</span>
							<span class="d-block mt-3">
								<a href="" class="">See our price</a>
							</span>
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