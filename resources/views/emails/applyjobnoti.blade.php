<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>  
    <!-- Fonts -->
    <link href="{{ asset('public/fonts/font.css') }}" rel="stylesheet"> 
	<style type="text/css">
	.dbdeml{
	max-width: 90%;
	background-color:#f9f7f9;  /*e0dee0*/
	margin: 0 auto;
	}
	.ftremail{
	text-align: center;
	background-color:#e0dee0; 
	font-size: 13px;
	}
	.content{
	background-color: #fff; 
	border: 1px solid #c4c4c4;
	text-align: justify; 
	margin-left: 5px;
	margin-right: 5px;
	margin-bottom: 5px;
	}
	.content > .bckgrnd{
	background-color: rgba(31, 78, 121,1);
	}
	.contentemail{
	background-color: #fff; 
	border: 1px solid #c4c4c4;
	text-align: justify;
	padding-left: 15px;
	margin-left: 5px;
	margin-right: 5px;
	margin-bottom: 10px;
	}
	.contentemail > .desc{ 
	padding-left: 5px;
	margin-right: 15px;
	margin-bottom: 25px;
	}
	.desc > .img{
	float: right;  
	}
	.desc > .img1{ 
	float: left;  
	}
	h4.title{
	text-align: right;
	margin-right: 15px;
	}
	.btnactive{
	background-color: rgba(31, 78, 121,0.4); 
	height: 25px;
	box-shadow: 3px 3px 5px #888888;
	border: 1px solid #000;
	border-radius: 8px;
	font-weight:bold;
	}
	.btnactive:hover{
	background-color: transparent;
	border: 1px solid #000;
	color: #000;
	}
	.btn{
	background-color: transparent;
	border: 1px solid #000;
	color: #000; 
	font-weight:bold;
	height: 25px;  
	border-radius: 8px;
	box-shadow: 3px 3px 5px #888888;
	}
	.btn:hover{
	background-color:rgba(31, 78, 121,0.4); 
	}
	</style>  
                    
</head>
<body> 
	<div class="dbdeml">
      	<div class="content">
        	<div class="bckgrnd"><img src="{{asset('public/images/icon/workshire_white.png')}}" width="150" height="50"/></div>
      	</div>
      	<div class="contentemail">
        	<h3 style="color:rgba(51, 51, 255, 0.8);">Dear '.ucwords(strtolower($fname)).',</h3> 
        	<p>
				We have received your application and we could like to thank you for your interest in our company. Your application has been sent to the respective selection committee. <br />
				<br />
				We will contact you should your credentials match the position. If we are unableto find you the right fit, we will keep your interest in view and contact you should our needs change.<br />
				<br /> 
				We wish you all the best in your career search.

				<br/><br/>
				Sincerely,<br /> 
				<strong>'.ucwords(strtolower($companyName)).'</strong>
			</p>
      	</div> 
		<div class="ftremail">
			<img src="{{asset('public/images/icon/talentsuites.png')}}" width="150"/>
			<br/>
			No 45, 1st Floor Jalan Dagangan 3,<br/>Pusat Bandar Bertam Perdana, 13200 Kepala Batas, Pulau Pinang<br/> 
		</div> 
      	<hr>
		<p style="font-style:italic;text-align:justify;">
			This is a system-generated e-mail. You have received this mail because your e-mail ID is registered with Workshire.com.my. If you never sign up with this email before or you do not wish to be registered with Workshire.com.my any longer, you can contact the Workshire support team for any trouble. 
		</p>
		<p style="font-style:italic;text-align:justify;">
			Please do not reply to this message. We recommend that you visit our Terms & Conditions and Privacy Policy on Workshire.com.my for more information.
		</p>
    </div>
</body>  
</html>

<!--
	<div class="dbdeml">
      	<div class="content">
        	<div class="bckgrnd"><img src="{{asset('public/images/icon/workshire_white.png')}}" width="150" height="50"/></div>
      	</div>
      	<div class="contentemail">
        	<h3 style="color:rgba(51, 51, 255, 0.8);">Welcome, '.ucwords(strtolower($name)).'</h3> 
        	Find your next ideal career with Workshire !<br/><br/> 
        	Let&apos;s try a few steps below to get started.<br/>
		 	<hr style="padding-left: 0;margin-left: 5px;margin-right: 5px;margin-bottom: 0;max-width: 100%;" />
        	<h4>Verify Your Account</h4>
	        <div class="desc">
				<div class="img1">
					<i class="fa fa-unlock-alt" aria-hidden="true" style="font-size:4.5em;color:#1f4e79;"></i>
				</div> 
	          	<br/>
				<a style="list-style:none;padding-left: 10px;">
					Please follow the link to activate your account: <br/>&nbsp;&nbsp;
					<button class="btn">
						<a href="http://www.workshire.com.my/action/confirm_sign_up.php?key='.$encConfirmation.'" style="text-decoration:none;color:#000;">ACTIVATE YOUR ACCOUNT</a>
					</button> 
	          	</a>
	        </div>
        	<hr style="padding-left: 0;margin-left: 5px;margin-right: 5px;margin-bottom: 0;max-width: 100%;" />
        	<h4 class="title">Complete Your Profile</h4>
	        <div class="desc">
				<div class="img">
					<i class="fa fa-users" aria-hidden="true" style="font-size:4.5em;color:#1f4e79;"></i>
				</div>
				Let employers know and find you on Workshire !<br/>Complete your profile and upload your resume now you can start applying your dream jobs.
				<br/> 
				<button class="btnactive">
					<a href="http://www.workshire.com.my/login/" style="text-decoration:none;color:#000;">COMPLETE YOUR PROFILE</a>
				</button> 
	        </div>
	        <hr style="padding-left: 0;margin-left: 5px;margin-right: 5px;margin-bottom: 0;max-width: 100%;" />
	        <h4>Search Job</h4>
	        <div class="desc">
				<div class="img1">
				<i class="fa fa-search" aria-hidden="true" style="font-size:4.5em;color:#1f4e79;"></i>
				</div>
				Search your dream job through our various postings from more than 10, 000 jobs in Workshire.<br/> 
				<button class="btn"><a href="http://www.workshire.com.my/login/" style="text-decoration:none;color:#000;">EXPLORE DREAM JOBS NOW</a></button> 
	        </div> 
      	</div> 
		<div class="ftremail">
			<img src="{{asset('public/images/icon/talentsuites.png')}}" width="150"/>
			<br/>
			No 45, 1st Floor Jalan Dagangan 3,<br/>Pusat Bandar Bertam Perdana, 13200 Kepala Batas, Pulau Pinang<br/> 
		</div> 
      	<hr>
		<p style="font-style:italic;text-align:justify;">
			This is a system-generated e-mail. You have received this mail because your e-mail ID is registered with Workshire.com.my. If you never sign up with this email before or you do not wish to be registered with Workshire.com.my any longer, you can contact the Workshire support team for any trouble. 
		</p>
		<p style="font-style:italic;text-align:justify;">
			Please do not reply to this message. We recommend that you visit our Terms & Conditions and Privacy Policy on Workshire.com.my for more information.
		</p>
    </div>
-->