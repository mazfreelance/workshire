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
        	<h3 style="color:rgba(51, 51, 255, 0.8);">Welcome back !</h3> 
        	You have 1 applicant applied that your job posting.<br/><br/> 
        	Check it out now and keep continue to support us !
        	<hr>
	        <h4>Search Candidate</h4>
	        <div class="desc">
				<div class="img1">
				<i class="fa fa-globe" aria-hidden="true" style="font-size:4.5em;color:#1f4e79;"></i>
				</div>
				Search your potential candidate through our various listings from more than 10, 000 candidates in Workshire.<br/> 
				<button class="btn"><a href="http://www.workshire.com.my/login/" style="text-decoration:none;color:#000;">EXPLORE OUR SITES NOW</a></button> 
	        </div> 
	        <br/>
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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; background-color: #f5f8fa; color: #74787E; height: 100%; hyphens: auto; line-height: 1.4; margin: 0; -moz-hyphens: auto; -ms-word-break: break-all; width: 100% !important; -webkit-hyphens: auto; -webkit-text-size-adjust: none; word-break: break-word;">
    <style>
        @media  only screen and (max-width: 600px) {
            .inner-body {
                width: 100% !important;
            }

            .footer {
                width: 100% !important;
            }
        }

        @media  only screen and (max-width: 500px) {
            .button {
                width: 100% !important;
            }
        }

        .word{
        	font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787E; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;
        }

        .tablestyle{
        	font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;
        }

        .tablemaster{
        	font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;background-color: #f5f8fa; margin: 0; padding: 0; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;
        } 

        .style2{
        	font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; background-color: #FFFFFF; border-bottom: 1px solid #EDEFF2; border-top: 1px solid #EDEFF2; margin: 0; padding: 0; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;
        }
    </style>

    <table class="wrapper" width="100%" cellpadding="0" cellspacing="0" class="tablemaster">
        <tr>
            <td align="center" class="tablestyle">
                <table class="content" width="100%" cellpadding="0" cellspacing="0" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; margin: 0; padding: 0; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;">
                    <tr>
					    <td class="header" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; padding: 25px 0; text-align: center;">
					        <a href="{{route('main')}}" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #bbbfc3; font-size: 19px; font-weight: bold; text-decoration: none; text-shadow: 0 1px 0 white;">
					            Workshire
					        </a>
					    </td>
					</tr>

                    <!-- Email Body -->
                    <tr>
                        <td class="body" width="100%" cellpadding="0" cellspacing="0" class="style2">
                            <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; background-color: #FFFFFF; margin: 0 auto; padding: 0; width: 570px; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 570px;">
                                <!-- Body content -->
                                <tr>
                                    <td class="content-cell" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; padding: 35px;">
                                        <h1 style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #2F3133; font-size: 19px; font-weight: bold; margin-top: 0; text-align: left;"></h1>
										<p class="word">
											You have 1 applicant applied that your job posting.
										</p>
										<table class="action" align="center" width="100%" cellpadding="0" cellspacing="0" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; margin: 30px auto; padding: 0; text-align: center; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;">
										    <tr>
				                                <td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">
				                                    <a href="{{route('employer.dashboard')}}" class="button button-blue" target="_blank" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; border-radius: 3px; box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16); color: #FFF; display: inline-block; text-decoration: none; -webkit-text-size-adjust: none; background-color: #3097D1; border-top: 10px solid #3097D1; border-right: 18px solid #3097D1; border-bottom: 10px solid #3097D1; border-left: 18px solid #3097D1;">Click Here</a>
				                                </td>
				                            </tr>
										</table>
										<p class="word">Regards,<br>Workshire</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
					    <td class="tablestyle">
					        <table class="footer" align="center" width="570" cellpadding="0" cellspacing="0" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; margin: 0 auto; padding: 0; text-align: center; width: 570px; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 570px;">
					            <tr>
					                <td class="content-cell" align="center" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; padding: 35px;">
					                    <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; line-height: 1.5em; margin-top: 0; color: #AEAEAE; font-size: 12px; text-align: center;">© 2018 Workshire. All rights reserved.</p>
					                </td>
					            </tr>
					        </table>
					    </td>
					</tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>