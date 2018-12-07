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
                                <p>Hi Workshire staff,</p>



                                <p>
                                    You have 1 notification for job posting and need to approve, Please take action
                                </p>
                                <table class="table table-bordered">
                                    <tr>
                                        <th class="bg-dark text-light w-25">
                                            Employer / Company: 
                                        </th>
                                        <td>
                                            {{ $companyname }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="bg-dark text-light w-25">
                                            Position: 
                                        </th>
                                        <td>
                                           {{ $jobposition }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="bg-dark text-light w-25">
                                            Posted on: 
                                        </th>
                                        <td>
                                           {{ $jobdate }}
                                        </td>
                                    </tr>
                                </table>

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