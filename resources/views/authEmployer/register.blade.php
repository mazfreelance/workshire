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
</head>
<body style="background-color:#efefef" class="gothic">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('employer.register.submit') }}" aria-label="{{ __('Register') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" autofocus>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" >

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div> 


                            <div class="form-group row">
                                <label for="ssm_no" class="col-md-4 col-form-label text-md-right">{{ __('Company Register Number (SSM Number)') }}</label>

                                <div class="col-md-6">
                                    <input id="ssm_no" type="text" class="form-control{{ $errors->has('ssm_no') ? ' is-invalid' : '' }}" name="ssm_no" value="{{ old('ssm_no') }}">

                                    @if ($errors->has('ssm_no'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('ssm_no') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div> 

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Subscriptions') }}</label>

                                <div class="col-md-6"> 
                                    <label for="" class="small">
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
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
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
