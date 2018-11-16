@extends('layouts.master_admin')

@section('title', 'Admin Log in')

@section('content')  
<body>
<section class="login p-fixed d-flex text-center bg-primary common-img-bg">
    <!-- Container-fluid starts -->
    <div class="container-fluid">
        <div class="row">

            <div class="col-sm-12">
                <div class="login-card card-block">
                    <form class="md-float-material" method="POST" action="{{ route('admin.login.submit') }}" aria-label="{{ __('Login') }}">
                    @csrf  
                        <div class="text-center">
                            <h1 class="display-1 futura">Workshire Admin</h1>
                        </div>
                        <h3 class="text-center txt-primary">
                            Sign In to your account
                        </h3>
                        <div class="md-input-wrapper">
                            <input type="email" class="md-form-control form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="email" value="{{ old('email') }}" required autofocus/> 
                            <label>Email</label>

                            @if ($errors->has('email'))
                                <span class="text-danger" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="md-input-wrapper">
                            <input type="password" class="md-form-control form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="password" required/> 
                            <label>Password</label>

                            @if ($errors->has('password'))
                                <span class="text-danger" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-xs-12">
                            <div class="rkmd-checkbox checkbox-rotate checkbox-ripple m-b-25">
                                <label class="input-checkbox checkbox-primary">
                                    <input type="checkbox" id="remember" value="remember" {{ old('remember') ? 'checked' : '' }}/> 
                                    <span class="checkbox"></span>
                                </label>
                                <div class="captions">Remember Me</div>

                            </div>
                                </div>
                            <div class="col-sm-6 col-xs-12 forgot-phone text-right">
                                <a href="{{route('admin.password.request')}}" class="text-right f-w-600"> Forget Password?</a>
                                </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-10 offset-xs-1">
                                <button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">
                                {!! __('LOG IN')!!}
                                </button>
                            </div>
                        </div> 

                        <div class="row">
                            <div class="col-xs-12 text-center m-t-25">  
                                <a href="{{route('main')}}" class="btn btn-primary btn-icon waves-effect waves-light">
                                   <i class="icofont icofont-home"></i>
                                 </a> 
                            </div>
                        </div>
                        <!-- </div> -->
                    </form>
                    <!-- end of form -->
                </div>
                <!-- end of login-card -->
            </div>
            <!-- end of col-sm-12 -->
        </div>
        <!-- end of row -->
    </div>
    <!-- end of container-fluid -->
</section>

<!-- Warning Section Starts -->
<!-- Older IE warning message -->
<!--[if lt IE 9]>
<div class="ie-warning">
    <h1>Warning!!</h1>
    <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers to access this website.</p>
    <div class="iew-container">
        <ul class="iew-download">
            <li>
                <a href="http://www.google.com/chrome/">
                    <img src="assets/images/browser/chrome.png" alt="Chrome">
                    <div>Chrome</div>
                </a>
            </li>
            <li>
                <a href="https://www.mozilla.org/en-US/firefox/new/">
                    <img src="assets/images/browser/firefox.png" alt="Firefox">
                    <div>Firefox</div>
                </a>
            </li>
            <li>
                <a href="http://www.opera.com">
                    <img src="assets/images/browser/opera.png" alt="Opera">
                    <div>Opera</div>
                </a>
            </li>
            <li>
                <a href="https://www.apple.com/safari/">
                    <img src="assets/images/browser/safari.png" alt="Safari">
                    <div>Safari</div>
                </a>
            </li>
            <li>
                <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                    <img src="assets/images/browser/ie.png" alt="">
                    <div>IE (9 & above)</div>
                </a>
            </li>
        </ul>
    </div>
    <p>Sorry for the inconvenience!</p>
</div>
<![endif]-->
<!-- Warning Section Ends --> 
</body>
@endsection




