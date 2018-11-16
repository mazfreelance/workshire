<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head> 
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" crossorigin="anonymous">

	<link href="{{ asset('public/css/app.css') }}" rel="stylesheet"> 
    <link href="{{ asset('public/fonts/font.css') }}" rel="stylesheet"> 
    <style type="text/css">
	.btn{
		background-color: transparent;
		border: 1px solid #000;
		color: #000; 
		font-weight:bold;
		height: 35px;  
		border-radius: 8px;
		box-shadow: 3px 3px 5px #888888;
	}
	.btn:hover{
		background-color:rgba(31, 78, 121,0.4); 
	}
    </style>
</head>
<body>
	<div class="container">
		<div class="row" style="background-color: rgba(31, 78, 121,1);"> 
			<img src="{{asset('public/images/icon/workshire_white.png')}}" width="150" height="50"/>
		</div>
		<div class="row border border-dark mt-1">
			<div class="col-12"> 
    			<h3 class="text-primary">Dear  {{$name}},</h3> 
    			<h5>
    				You might be interested in the positions below. These employers are looking for someone just like you.
    			</h5>
			</div>
			<div class="col-12">  
				<hr> 
				@foreach($jobs as $job)
				<div class="row">
					<div class="col-12">{{$job->jobpost_position}}</div>
					<div class="col-12">{{$job->jobpost_company_name}}</div>
					<div class="col-12 text-truncate">
						Description:
						<span class="font-italic small">
							{!!htmlspecialchars_decode(stripslashes($job->jobpost_desc))!!}
						</span> 
					</div>
					<div class="col-12"> 
						<a class="btn btn-md btn-warning" href="{{ url('ViewJob/'.str_replace(' ', '-', $job->jobpost_position).'/'.$job->id) }}">View Job Details</a> 
					</div>
				</div>
				<hr>
				@endforeach 
			</div>
		</div>

		<div class="row mt-1" style="background-color:#e0dee0;">  
			<div class="col-12 text-center">
				<img src="{{asset('public/images/icon/talentsuites.png')}}" width="150"/>
				<br/>
				No 45, 1st Floor Jalan Dagangan 3,<br/>Pusat Bandar Bertam Perdana, 13200 Kepala Batas, Pulau Pinang
				<hr>
				<p  class="small text-muted text-justify font-italic">
					This is a system-generated e-mail. You have received this mail because your e-mail ID is registered with Workshire.com.my. If you never sign up with this email before or you do not wish to be registered with Workshire.com.my any longer, you can contact the Workshire support team for any trouble. You can unsubcribe through our system if you don't want receive any information or news from Workshire.
					<br/>
					Hint: navigation - Setting > Notification.
				</p>
				<p class="small text-muted text-justify font-italic">
					Please do not reply to this message. We recommend that you visit our Terms & Conditions and Privacy Policy on Workshire.com.my for more information.
				</p>
			</div>
		</div>
	</div>
</body>
</html> 
