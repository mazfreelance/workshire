<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('includes.favicon') 
    <title>{{ config('app.name', 'Workshire') }} - Employer Login</title>

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


        <div class="wrap mb-4"> 
            <div class="row border border-dark">
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
                        <span class=""><i class="fa fa-map-marker"></i> Penang, My</span>
                    </div>
                </div>
                <div class="col-sm-8 w3ls-loginpanel ml-sm-3 my-auto"> 
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

                    <form class="text-center" method="POST" action="{{ route('employer.login.submit') }}" aria-label="{{ __('Login') }}">
                        @csrf 
                        <div class="form-row"> 
                            <div class="col text-left">  
                                <label><i class="fa fa-user"></i> {!! __('E-mail address')!!}</label>  

                                <input id="email" type="email" class="w-100 form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
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
                                <a class="btn btn-link btn-md" href="{{ route('employer.password.request') }}">{!! __('Forgot password?')!!}</a>
                            </div> 
                        </div>
                        <div class="form-row mt-3"> 
                            <div class="col text-sm-left small">  
                                New in <span class="futura">Workshire</span>? 
                                <a class="btn btn-link btn-sm" href="{{ route('employer.register') }}">{!! __('Sign up with us')!!}</a>
                            </div>  
                        </div>
                    </form>
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
    
});
</script>
<!-- Custom JS End-->
</html>




