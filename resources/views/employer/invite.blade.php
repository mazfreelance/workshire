@extends('layouts.master_emp')

@section('title', 'Applicant Invitation')

@section('content')  
<main class="py-0">    
	@include('employer.menu')
	<div class="row border border border-dark border-top-0 mr-0">
		<div class="col-sm-12 pl-sm-5 pt-sm-1 pt-0 pl-4">
			<h3>Applicant Invitation</h3> 
			<hr style="margin-bottom:0.1em">
		</div>
		<div class="col-sm my-1 pl-sm-5 pl-4">   
		    <h5>Application Reference Number : A00000</h5>
		    <h5>Talent : Nama</h5>
	        <sub class="mb-1">Note <font color="red">*</font> should not be blank</sub> 
	        <hr>
	        <form class="invite-form" id="form1" name="form1" method="post">  
		       <input type="hidden" name="employer" id="employer" value="" />
			   <input type="hidden" name="candidate" id="candidate" value="" />   
			   <input type="hidden" name="jobpostRef" id="jobpostRef" value="" />

			  	<div class="form-row">
				    <div class="form-group col-md-6">
						<label for="inputEmail4">Date for Interview</label>
						<input type="text" class="form-control interviewDate" name="interviewDate" id="interviewDate" placeholder="eg: 24/4/2018" value="" />
				    </div>
				    <div class="form-group col-md-6">
						<label for="inputPassword4">Time for Interview</label>
						<input type="text" class="form-control timeofInterview" name="timeofInterview" id="timeofInterview" placeholder="eg: 10:30 AM" value="" />
				    </div>
			  	</div>
				<div class="form-group">
					<label for="inputAddress">Document Needed</label>
					<input type="text" class="form-control" name="bringdocument" placeholder="eg: Resume, IC photostate, etc" value=""/>
				</div>
				<div class="form-group">
					<label for="inputAddress2">Position Vacation</label>
					<input type="text" class="form-control" name="positionTitle" value=""/>
				</div>
				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="inputCity">Interview Address</label>
						<textarea class="form-control" name="interviewLocationAddress" placeholder="e.g. No 45,1st Floor,Jalan Dagangan 3, 13200 Pusat Bandar Bertam Perdana, Kepala Batas" rows="4"></textarea>
					</div>
					<div class="form-group col-md-6">
						<label for="inputState">Interview Location</label>
						<input class="form-control" type="text" name="interviewLocation" placeholder="e.g. Meeting Room" value=""/> 
					</div> 
			  	</div> 
			  	<div class="col-md-12 text-center mb-1">
		        	<div class="btn-group">
		        		<a class="btn btn-outline-dark backbtn" href="{{url('/employer/applicant')}}"><i class="fa fa-reply"></i> Back</a>
		        		<a class="btn btn-outline-primary sendinvite"><i class="fa fa-send"></i> Invite</a> 
		        	</div>
		        </div> 
			</form>
		</div> 
	</div>
</main> 
<!-- Footer -->  
@include('includes.footer') 

@endsection