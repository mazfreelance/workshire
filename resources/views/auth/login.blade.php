<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('includes.favicon') 
    <title>{{ config('app.name', 'Workshire') }} - Talent Login</title>

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
    <div class=" register">
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
                @if (session('warning'))
                    <div class="alert alert-warning">
                        {{ session('warning') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <img src="{{asset('public/images/icon/wh-circle.png')}}" alt=""/>
                <a href="{{ route('main') }}" class="d-block" title="Back to Home"><i class="fas fa-home"></i></a>
                <h3>Welcome</h3>
                <p><span class="futura font-weight-bold">Workshire</span> help company to find the right candidates for your hiring</p>
                <p style="margin-top:-7em">
                    <h5>Short Description</h5>
                    <p>
                        Based in Penang, Malaysia and supported by team of professionals with over 20 years Human Resource Management Experiences
                    </p>
                </p> 
                <br/>
            </div>
            <div class="col-md-9 register-right">
                <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#login" role="tab" aria-controls="home" aria-selected="true">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" href="{{ route('password.request') }}" role="tab" aria-controls="profile" aria-selected="false">Forgot?</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="home-tab">
                        <h3 class="register-heading">Login as a Seeker&nbsp;&nbsp;</h3>

                        {{ Form::open(array('route' => 'login.submit', 'aria-label' => 'Login')) }}
                        <div class="row register-form">  
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><i class="fa fa-user"></i> {!! __('Username or e-mail')!!}</label>  

                                    <input id="username" type="text" class="w-100 form-control{{ $errors->has('email') || $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif

                                    @if ($errors->has('username'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('username') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label><i class="fa fa-key"></i> {!! __('Password')!!}</label> 
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group ml-3">
                                    <input class="form-check-input" type="checkbox" value="remember" id="remember" 
                                    {{ old('remember') ? 'checked' : '' }}/>
                                    <label class="form-check-label" for="remember">
                                        {!! __('Remember me')!!}
                                    </label>
                                </div>
                                <div class="form-group">
                                    New in <span class="futura">Workshire</span>? 
                                    <a class="btn btn-link btn-sm" href="{{ route('register') }}">{!! __('Sign up with us')!!}</a>
                                </div>

                                <input type="submit" class="btnRegister"  value="Login"/>
                            </div>
                            <div class="col-md-6"> 
                                <div class="form-group d-lg-none">
                                    <hr>
                                </div> 
                                <div class="form-group">
                                    <label><i class="fa fa-sign-in-alt"></i> {!! __('or Social Login')!!}</label> 
                                    <div class="col-md-12 col-md-offset-2">
                                        <a href="{{route('loginsocial', ['twitter'])}}" class="btn btn-social-icon btn-twitter"><i class="fab fa-twitter"></i></a>
                                        <a href="{{route('loginsocial', ['facebook'])}}" class="btn btn-social-icon btn-facebook"><i class="fab fa-facebook-f"></i></a>
                                        <a href="{{route('loginsocial', ['linkedin'])}}" class="btn btn-social-icon btn-linkedin"><i class="fab fa-linkedin-in"></i></a> 
                                        <a href="{{route('loginsocial', ['google'])}}" class="btn btn-social-icon btn-google-plus"><i class="fab fa-google"></i></a> 
                                    </div>
                                </div>
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
    if(navigator.geolocation){
        navigator.geolocation.getCurrentPosition(showLocation);
    }else{ 
        $('#location').html('Geolocation is not supported by this browser.');
    }
});

function showLocation(position){
    var latitude = position.coords.latitude;
    var longitude = position.coords.longitude; 
}
</script>
<!-- Custom JS End-->
</html>




