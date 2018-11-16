<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('includes.favicon') 
    <title>{{ config('app.name', 'Workshire') }} - Talent Register</title>

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
                        <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="username" class="col-md-5 col-form-label text-md-right">{{ __('Username') }}</label>

                                <div class="col-md-6"> 
                                    <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" autofocus> 

                                    @if ($errors->has('username'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{!! $errors->first('username') !!}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-5 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    @if(!empty($email)) 
                                        <input id="email" type="text" class="form-control" name="email" value="{{ $email }}"/>
                                    @else
                                        <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}">
                                    @endif

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-5 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">  
                                    @if(!empty($name))
                                        <input id="name" type="text" class="form-control" name="name" value="{{ $name }}"/>
                                    @else
                                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}"/>
                                    @endif

                                    @if ($errors->has('name')) 
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div> 

                            <div class="form-group row">
                                <label for="password" class="col-md-5 col-form-label text-md-right">{{ __('Password') }}</label>

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
                                <label for="password-confirm" class="col-md-5 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-5 col-form-label text-md-right">{{ __('How you know about us ?') }}</label>

                                <div class="col-md-6">
                                    <select class="custom-select form-control{{ $errors->has('survey') ? ' is-invalid' : '' }}" name="survey">
                                        <option value="" selected>Select one ...</option>
                                        <?php 
                                        $surveys = array('Facebook', 'Instagram', 'LinkedIn', 'Job Fair', 'WhatsApp Group', 'Recruitement Drive', 'Printed Advert');
                                        sort($surveys);
                                        ?>
                                        @foreach($surveys as $survey)
                                        <option value="{{$survey}}" {{old('survey') == $survey? 'selected':''}}>{{$survey}}</option>
                                        @endforeach
                                        <option value="Others" {{old('survey') == 'Others'? 'selected':''}}>Others</option>
                                    </select>

                                    @if ($errors->has('survey'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('survey') }}</strong>
                                        </span>
                                    @endif

                                    <input type="text" name="other_survey" class="form-control{{ $errors->has('other_survey') ? ' is-invalid' : '' }} mt-1" placeholder="Other of survey" value="{{old('other_survey')}}" />

                                    @if ($errors->has('other_survey'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('other_survey') }}</strong>
                                        </span>
                                    @endif
                                </div> 
                            </div> 

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-5 col-form-label text-md-right">{{ __('Subscriptions') }}</label>

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


                                    <div class="small {{ $errors->has('schedule') ? ' is-invalid' : '' }}" id="subsyes_schedule">
                                        <label class="col-form-label d-block">{{ __('Email Schedule') }}</label>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="scheduledaily" name="schedule" class="custom-control-input {{ $errors->has('schedule') ? ' is-invalid' : '' }}" Value="Daily">
                                            <label class="custom-control-label" for="scheduledaily">Daily</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="scheduleweekly" name="schedule" class="custom-control-input {{ $errors->has('schedule') ? ' is-invalid' : '' }}" value="Weekly">
                                            <label class="custom-control-label" for="scheduleweekly">Weekly</label>
                                        </div> 
                                        @if ($errors->has('schedule'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('schedule') }}</strong>
                                            </span>
                                        @endif
                                    </div> 
                                    <input type="hidden" name="job_alert" value="N" />
                                    <input type="hidden" name="profile_remind" value="N" />
                                    <input type="hidden" name="promo_alert" value="N" />
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-5">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>

                            <hr class="bg-dark">

                            <!--SOCIAL MEDIA REGISTER-->  
                            <div class="form-group row mt-3">
                                <label for="password-confirm" class="col-md-6 col-form-label text-center">Or Register with</label> 
                                <div class="col-md-6 col-md-offset-2">
                                    <a href="{{route('loginsocial', ['twitter'])}}" class="btn btn-social-icon btn-twitter"><i class="fab fa-twitter"></i></a>
                                    <a href="{{route('loginsocial', ['facebook'])}}" class="btn btn-social-icon btn-facebook"><i class="fab fa-facebook-f"></i></a>
                                    <a href="{{route('loginsocial', ['linkedin'])}}" class="btn btn-social-icon btn-linkedin"><i class="fab fa-linkedin-in"></i></a> 
                                    <a href="{{route('loginsocial', ['google'])}}" class="btn btn-social-icon btn-google-plus"><i class="fab fa-google"></i></a>  
                                </div>
                            </div> 
                            <!--END OF SOCIAL MEDIA REGISTER--> 

                            <div class="form-group text-center">
                                By signing up you agree to our <a href="{{route('term&conds')}}" target="_blank">Terms of Use</a> and <a href="{{route('privacy')}}" target="_blank">Privacy Policy</a>.
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
    if(navigator.geolocation){
        navigator.geolocation.getCurrentPosition(showLocation);
    }else{ 
        $('#location').html('Geolocation is not supported by this browser.');
    }
    $("input[name='other_survey']").hide();
    $("select[name='survey']").on('change', function(){
        var val = $(this).val();
        if(val == 'Others'){
            $("input[name='other_survey']").show();
        }else{
            $("input[name='other_survey']").hide();
        }
    });

    $("#subsyes_schedule").hide(); 
    $( "input[name='subs'], input[name='schedule']" ).on( "click", function() {
        if($( "input[name='subs']:checked" ).val() =='Y'){
            $("#subsyes_schedule").show(); 
            if($( "input[name='schedule']:checked" ).val() =='Daily'){
                $("input[name='job_alert']").val( $("input[name='subs']:checked" ).val() +'|Daily');
            }else if($( "input[name='schedule']:checked" ).val() =='Weekly'){
                $("input[name='job_alert']").val( $("input[name='subs']:checked" ).val() +'|Weekly'); 
            }


            $("input[name='profile_remind']").val( $("input[name='subs']:checked" ).val());
            $("input[name='promo_alert']").val( $("input[name='subs']:checked" ).val()); 
        }
        else if($( "input[name='subs']:checked" ).val() =='N'){
            $("#subsyes_schedule").hide(); 
            $("input[name='job_alert']").val( $("input[name='subs']:checked" ).val());
            $("input[name='profile_remind']").val( $("input[name='subs']:checked" ).val());
            $("input[name='promo_alert']").val( $("input[name='subs']:checked" ).val()); 
        }
    });
    if($( "input[name='subs']:checked" ).val() =='Y'){
        $("#subsyes_schedule").show(); 
        if($( "input[name='schedule']:checked" ).val() =='Daily'){
            $("input[name='job_alert']").val( $("input[name='subs']:checked" ).val() +'|Daily');
        }else if($( "input[name='schedule']:checked" ).val() =='Weekly'){
            $("input[name='job_alert']").val( $("input[name='subs']:checked" ).val() +'|Weekly'); 
        } 
        $("input[name='profile_remind']").val( $("input[name='subs']:checked" ).val());
        $("input[name='promo_alert']").val( $("input[name='subs']:checked" ).val()); 
    }
    else if($( "input[name='subs']:checked" ).val() =='N'){
        $("#subsyes_schedule").hide(); 
        $("input[name='job_alert']").val( $("input[name='subs']:checked" ).val());
        $("input[name='profile_remind']").val( $("input[name='subs']:checked" ).val());
        $("input[name='promo_alert']").val( $("input[name='subs']:checked" ).val()); 
    }
});

function showLocation(position){
    var latitude = position.coords.latitude;
    var longitude = position.coords.longitude; 
}
</script>
<!-- Custom JS End-->
</html>