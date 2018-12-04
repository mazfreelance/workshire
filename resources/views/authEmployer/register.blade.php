<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('includes.favicon') 
    <title>{{ config('app.name', 'Workshire') }} - Employer Register</title>

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
                <img src="{{asset('public/images/icon/wh-circle.png')}}" alt=""/>
                <a href="{{ route('employer.main') }}" class="d-block" title="Back to Home"><i class="fas fa-home"></i></a>
                <h3>Welcome</h3>
                <p><span class="futura font-weight-bold">Workshire</span> help company to find the right candidates for your hiring</p>
                <button class="btnInput" onclick="location.href='{{ route('employer.login') }}'">Login</button>
                <br/>
            </div>
            <div class="col-md-9 register-right">
                <ul class="nav nav-tabs-single nav-justified" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="" role="tab" aria-controls="home" aria-selected="true">New Employer</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <h3 class="register-heading">Apply as a Employer</h3>
                        {{ Form::open(array('route' => 'employer.register.submit', 'aria-label' => 'Register')) }}
                        <div class="row register-form">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="email" value="{{ old('email') }}" placeholder="Your Email *" autofocus/> 

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name" value="{{ old('name') }}" placeholder="Your Company Name *"/>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control{{ $errors->has('ssm_no') ? ' is-invalid' : '' }}" name="ssm_no" id="ssm_no" value="{{ old('ssm_no') }}" placeholder="Your Company SSM Number *"/> 

                                    @if ($errors->has('ssm_no'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('ssm_no') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="form-group">
                                    <hr class="d-lg-none">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="password" placeholder="Password *"/>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control"  placeholder="Confirm Password *" name="password_confirmation" id="password_confirmation"/>
                                </div>
                                <div class="form-group">
                                    <label for="" class="small">
                                        <h6>Subscriptions</h6>
                                        I would like to receive notifications on Workshire.com.my products,Job Opportunities, job seeker services & career advice
                                    </label> 
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="subsyes" name="subs" class="custom-control-input {{ $errors->has('subs') ? ' is-invalid' : '' }}" Value="Y" {{old('subs') == 'Y'? 'checked':''}}>
                                        <label class="custom-control-label" for="subsyes">Yes</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="subsno" name="subs" class="custom-control-input {{ $errors->has('subs') ? ' is-invalid' : '' }}" value="N" {{old('subs') == 'N'? 'checked':''}}>
                                        <label class="custom-control-label" for="subsno">No</label>
                                    </div>  
                                    
                                    @if ($errors->has('subs'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('subs') }}</strong>
                                        </span>
                                    @endif
                                    <input type="hidden" name="job_alert" value="N" />
                                    <input type="hidden" name="profile_remind" value="N" />
                                    <input type="hidden" name="promo_alert" value="N" /> 
                                </div>

                                <input type="submit" class="btnRegister"  value="Register"/>
                            </div>
                            <div class="col-md-12 text-center">
                                <div class="form-group mt-3">
                                    By signing up you agree to our <a href="{{route('term&conds')}}" target="_blank">Terms of Use</a> and <a href="{{route('privacy')}}" target="_blank">Privacy Policy</a>.
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
    $( "input[name='subs'], input[name='schedule']" ).on( "click", function() {
        if($( "input[name='subs']:checked" ).val() =='Y'){ 
            $("input[name='job_alert']").val( $("input[name='subs']:checked" ).val());
            $("input[name='profile_remind']").val( $("input[name='subs']:checked" ).val());
            $("input[name='promo_alert']").val( $("input[name='subs']:checked" ).val()); 
        }
        else if($( "input[name='subs']:checked" ).val() =='N'){ 
            $("input[name='job_alert']").val( $("input[name='subs']:checked" ).val());
            $("input[name='profile_remind']").val( $("input[name='subs']:checked" ).val());
            $("input[name='promo_alert']").val( $("input[name='subs']:checked" ).val()); 
        }
    });
    if($( "input[name='subs']:checked" ).val() =='Y'){ 
        $("input[name='job_alert']").val( $("input[name='subs']:checked" ).val());
        $("input[name='profile_remind']").val( $("input[name='subs']:checked" ).val());
        $("input[name='promo_alert']").val( $("input[name='subs']:checked" ).val()); 
    }
    else if($( "input[name='subs']:checked" ).val() =='N'){ 
        $("input[name='job_alert']").val( $("input[name='subs']:checked" ).val());
        $("input[name='profile_remind']").val( $("input[name='subs']:checked" ).val());
        $("input[name='promo_alert']").val( $("input[name='subs']:checked" ).val()); 
    }
});
</script>
<!-- Custom JS End-->
</html>
