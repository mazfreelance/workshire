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
    <link href="{{ asset('public/css/custom/login-signup.css') }}" rel="stylesheet"> 
</head>
<body style="background-color:#efefef" class="gothic">
    <div class="container register">
        <div class="row">
            <div class="col-md-3 register-left">
                <img src="{{asset('public/images/icon/wh-circle.png')}}" alt=""/>
                <a href="{{ route('main') }}" class="d-block" title="Back to Home"><i class="fas fa-home"></i></a>
                <h3>Welcome</h3>
                <p><span class="futura font-weight-bold">Workshire</span> help company to find the right candidates for your hiring</p>
                <button class="btnInput" onclick="location.href='{{ route('login') }}'">Login</button>
                <br/>
            </div>
            <div class="col-md-9 register-right">
                <ul class="nav nav-tabs-single nav-justified" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="" role="tab" aria-controls="home" aria-selected="true">New Seekers</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <h3 class="register-heading">Apply as a Seeker</h3>
                        {{ Form::open(array('route' => 'register', 'aria-label' => 'Register')) }}
                        <div class="row register-form">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" type="email" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" id="username" value="{{ old('username') }}" placeholder="Your Username *" autofocus/> 

                                    @if ($errors->has('username'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{!! $errors->first('username') !!}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group"> 
                                    @if(!empty($email))  
                                        <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="email" value="{{ $email }}" placeholder="Your Email *"/>
                                    @else
                                        <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="email" value="{{ old('email') }}" placeholder="Your Email *"/>
                                    @endif

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    @if(!empty($name)) 
                                        <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name" value="{{ $name }}" placeholder="Your Full Name *"/> 
                                    @else
                                        <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name" value="{{ old('name') }}" placeholder="Your Full Name *"/> 
                                    @endif

                                    @if ($errors->has('name')) 
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <select class="custom-select form-control{{ $errors->has('survey') ? ' is-invalid' : '' }}" name="survey">
                                        <option value="" selected disabled>How do you know about us?</option>
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

                                <input type="submit" class="btnRegister"  value="Register"/>
                            </div>

                            <div class="col-md-12 text-center">
                                <hr class="bg-dark">
                                <label class="d-block"><i class="fa fa-sign-in-alt"></i> {!! __('or Social Register')!!}</label>
                                <!--SOCIAL MEDIA REGISTER-->   
                                <a href="{{route('loginsocial', ['twitter'])}}" class="btn btn-social-icon btn-twitter"><i class="fab fa-twitter"></i></a>
                                <a href="{{route('loginsocial', ['facebook'])}}" class="btn btn-social-icon btn-facebook"><i class="fab fa-facebook-f"></i></a>
                                <a href="{{route('loginsocial', ['linkedin'])}}" class="btn btn-social-icon btn-linkedin"><i class="fab fa-linkedin-in"></i></a> 
                                <a href="{{route('loginsocial', ['google'])}}" class="btn btn-social-icon btn-google-plus"><i class="fab fa-google"></i></a>   
                                <!--END OF SOCIAL MEDIA REGISTER--> 


                                <div class="form-group mt-5">
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