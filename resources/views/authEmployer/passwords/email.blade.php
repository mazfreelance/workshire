<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('includes.favicon') 
    <title>{{ config('app.name', 'Workshire') }} - Employer Forget Password</title>

    <!-- Meta | SEO -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <meta name="keywords" content="job, vacancy, vacancies, jawatan kosong, cari kerja, kerja kosong, jawatan yang diperlukan, post job, post vacancies, jobs hiring ">
    <meta name="author" content="WorksHire by Talent Suites">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}"> 
  
    <!-- Fonts -->
    <link href="{{ asset('public/fonts/font.css') }}" rel="stylesheet"> 
    <!-- Styles -->
    <link href="{{ asset('public/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet"> 
    <link href="{{ asset('public/css/bootstrap-social.css') }}" rel="stylesheet">  

    <!-- Custom Styles --> 
    <link href="{{ asset('public/css/custom/login-signup.css') }}" rel="stylesheet"> 
</head>
<body style="background-color:#efefef" class="gothic">
    <div class="container register">
        <div class="row">
            <div class="col-md-3 register-left">
                
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <img src="{{asset('public/images/icon/wh-circle.png')}}" alt=""/>
                <a href="{{ route('employer.main') }}" class="d-block" title="Back to Home"><i class="fas fa-home"></i></a>
                <h3>Welcome</h3>
                <p><span class="futura font-weight-bold">Workshire</span> help company to find the right candidates for your hiring</p>
                <p style="margin-top:-7em">
                    <h5>Forgot password?</h5>
                    <ol class="text-left small ml-3">
                        <li>Place your registered email</li>
                        <li>Click &#39;<span class="font-italic">Send Password Reset Link</span>&#39; to get link to reset your password</li>
                        <li>Check your e-mail inbox, if not found check on spam messages.</li> 
                    </ol> 
                </p> 
                <br/>
            </div>
            <div class="col-md-9 register-right">
                <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#login" role="tab" aria-controls="home" aria-selected="true">Forgot ?</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" href="{{ route('employer.login') }}" role="tab" aria-controls="profile" aria-selected="false">Login</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="home-tab">
                        <h3 class="register-heading">Forgot password</h3>

                        {{ Form::open(array('route' => 'employer.password.email', 'aria-label' => 'Forgot Password')) }}
                        <div class="row register-form">  
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><i class="fa fa-user"></i> {!! __('E-mail address')!!}</label>  

                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" autofocus>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <hr class="d-lg-none">
                                </div>

                                <input type="submit" class="btnRegister"  value="Send Password Reset Link"/>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div> 
    </div>
</body>  
<!-- Scripts -->  
<script src="{{ asset('public/js/app.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>  
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script> 
<!-- Custom JS Start-->   
<script>
$(document).ready(function(){  
    
});
</script>
<!-- Custom JS End-->
</html>
