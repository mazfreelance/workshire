@extends('layouts.master')

@section('title', 'Talent Log in')

@section('content') 
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
                            <a class="btn btn-link btn-sm" href="{{ route('register') }}">{!! __('Sign up with us')!!}</a>
                        </div>  
                    </div>
                </form>
            </div> 



            
        </div>
    </div> 
<!--
    
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Admin Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('employer.login.submit') }}" aria-label="{{ __('Login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                <a class="btn btn-link" href="{{ route('employer.password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
-->

</main>

@endsection




