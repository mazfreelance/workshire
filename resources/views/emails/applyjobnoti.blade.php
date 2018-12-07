<!DOCTYPE html>
<html>
<head>
    <!-- Fonts -->
    <link href="{{ asset('public/fonts/font.css') }}" rel="stylesheet"> 
    <!-- Styles -->
    <link href="{{ asset('public/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet"> 
    <link href="{{ asset('public/css/bootstrap-social.css') }}" rel="stylesheet">  
</head>
<body class="gothic">
    <div style="font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;">
    <table style="width: 100%;">
        <tr>
            <td></td>
            <td bgcolor="#FFFFFF ">
                <div style="padding: 15px; max-width: 600px;margin: 0 auto;display: block; border-radius: 0px;padding: 0px; border: 1px solid lightseagreen;">
                    <table style="width: 100%;background: rgba(31, 78, 121,1) ;">
                        <tr>
                            <td></td> 
                            <td>
                                <div>
                                    <table width="100%">
                                        <tr>
                                            <td rowspan="2" style="text-align:center;padding:10px;">
                                            <img style="float:left; " width="200"  src="{{asset('public/images/icon/workshire_white.png')}}" /> 
                                            
                                            <span style="color:white;float:right;font-size: 13px;font-style: italic;margin-top: 20px; padding:10px; font-size: 14px; font-weight:normal;">
                                            "Online jobspace where employers meet talents"<span></span></span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </td>
                            <td></td>
                        </tr>
                    </table>
                    <table style="padding: 10px;font-size:14px; width:100%;">
                        <!-- CONTENT START -->  
                        <tr>
                            <td style="padding:10px;font-size:14px; width:100%;">
                                <!-- HERE START -->
                                <p>Hi {{ ucwords(strtolower($fname)) }},</p>

                                <p class="text-justify">
                                    We have received your application and we could like to thank you for your interest submit your application to our site. Your application has successfully sent to the company.
                                </p>
                                <p class="text-justify">
                                    The company that you applied will contact you should your credentials match the position. If we are unable to find you the right fit, we will keep your interest in view and contact you should our needs change.
                                </p>
                                <p class="text-justify">
                                   We wish you all the best in your career search. 
                                </p>

                                <!-- HERE END -->
                                <p>Thank you regard <br>
                                Workshire,<br></p>
                                <!--[ALL_FOLLOW]</p>
                                 /Callout Panel -->
                                <!-- FOOTER -->
                            </td>
                        </tr> 
                        <!-- CONTENT END -->
                        <tr>
                            <td>
                                <small>
                                    This is a system-generated e-mail. You have received this mail because your e-mail ID is registered with Workshire.com.my. If you never sign up with this email before or you do not wish to be registered with Workshire.com.my any longer, you can contact the Workshire support team for any trouble. You can unsubcribe through our system if you don't want receive any information or news from Workshire.
                                    <br/>
                                    Hint: navigation - Setting > Notification.
                                    <br/><br/>

                                    Please do not reply to this message. We recommend that you visit our Terms & Conditions and Privacy Policy on Workshire.com.my for more information.
                                </small>
                            </td>
                        </tr>
                        <!--
                        <tr>
                            <td>
                                <small>
                                    Unsubscribe:- This message was intended to be sent to: [TO] from [SITE]. If you would like to unsubscribe , please click <a href="[UNSUBSCRIBE]">here </a> to UNSUBSCRIBE 
                                </small>
                            </td>
                        </tr>
                        -->
                        <tr> 
                            <td>
                                <div align="center" style="font-size:12px; margin-top:20px; padding:5px; width:100%; background:#eee;">
                                © 2018 <a href="{{route('main')}}" target="_blank" style="color:#333; text-decoration: none;">Workshire</a>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>
</body>
</html>





















<!--
	<div class="dbdeml">
      	<div class="content">
        	<div class="bckgrnd"><img src="{{--asset('public/images/icon/workshire_white.png')--}}" width="150" height="50"/></div>
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
			<img src="{{--asset('public/images/icon/talentsuites.png')--}}" width="150"/>
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