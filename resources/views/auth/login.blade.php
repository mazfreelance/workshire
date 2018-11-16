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
</head>
<body style="background-color:#efefef" class="gothic">
    <main class="py-0"> 
        <div class="wrap"> 
            <div class="row border border-dark">
                <div class="col-sm-8 w3ls-loginpanel ml-sm-3"> 
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="btn-group d-flex justify-content-center" role="group" aria-label="Button group with nested dropdown"> 
                                <span class="py-2 px-3 bg-primary text-light border border-dark border-left-0 border-top-0 border-bottom-0">
                                    <i class="fa fa-backspace"></i>
                                </span> 
                                <a class="btn btn-primary text-light btn-md w-75" href="{{route('main')}}">Back to Home</a>
                            </div>
                        </div> 
                    </div> 
                    <hr>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('warning'))
                        <div class="alert alert-warning">
                            {{ session('warning') }}
                        </div>
                    @endif
                    <form class="text-center" method="POST" action="{{ route('login.submit') }}" aria-label="{{ __('Login') }}">
                        @csrf 
                        <div class="form-row"> 
                            <div class="col text-left">  
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
                        </div>
                        <div class="form-row mt-2"> 
                            <div class="col text-left">  
                                <label><i class="fa fa-key"></i> {!! __('Password')!!}</label> 
                                <input id="password" type="password" class="w-100 form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div> 
                        </div>
                        <div class="form-row mt-2"> 
                            <div class="col text-sm-left">   
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="remember" id="remember" {{ old('remember') ? 'checked' : '' }}/>
                                    <label class="form-check-label" for="remember">
                                        {!! __('Remember me')!!}
                                    </label>
                                </div>
                            </div>  
                        </div>
                        <div class="form-row mt-3"> 
                            <div class="col-sm-1">  
                                <button class="btn btn-success btn-md" type="submit">{!! __('Log in')!!}</button>
                            </div> 
                            <div class="col-sm-5">  
                                <a class="btn btn-link btn-md" href="{{ route('password.request') }}">{!! __('Forgot password?')!!}</a>
                            </div> 
                        </div>
                        <div class="form-row mt-3"> 
                            <div class="col text-sm-left small">  
                                New in <span class="futura">Workshire</span>? 
                                <a class="btn btn-link btn-sm" href="{{ route('register') }}">{!! __('Sign up with us')!!}</a>
                            </div>  
                        </div> 
                        <div class="form-row mt-3"> 
                            <label for="password-confirm" class="col-md-12 col-form-label text-center">
                                <hr class="hr-text" data-content="Or Login with">
                            </label> 
                            <div class="col-md-12 col-md-offset-2">
                                <a href="{{route('loginsocial', ['twitter'])}}" class="btn btn-social-icon btn-twitter"><i class="fab fa-twitter"></i></a>
                                <a href="{{route('loginsocial', ['facebook'])}}" class="btn btn-social-icon btn-facebook"><i class="fab fa-facebook-f"></i></a>
                                <a href="{{route('loginsocial', ['linkedin'])}}" class="btn btn-social-icon btn-linkedin"><i class="fab fa-linkedin-in"></i></a> 
                                <a href="{{route('loginsocial', ['google'])}}" class="btn btn-social-icon btn-google-plus"><i class="fab fa-google"></i></a> 
                            </div>
                        </div>  
                    </form>


                </div>  
                <div class="col-sm w3ls-subscribe">
                    <h5 class="futura font-weight-bold text-light">Workshire</h5>
                    <h6>Aug 6th, 18 - Wednesday</h6>  

                    <blockquote class="quote-card blue-card">
                        <p class="text-dark">
                            Your opportunities to achieve the best career in Malaysia
                        </p> 
                        <cite>
                            <span class="futura">Workshire</span> Team
                        </cite>
                    </blockquote>

                    <div class="align-text-bottom text-dark mt-5" style="margin-bottom:-2em;">
                        <span class=""><i class="fa fa-map-marker-alt"></i> </span>
                    </div>
                </div>
            </div>
        </div>  
    </main> 
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




