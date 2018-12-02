@extends('layouts.master_admin')

@section('title', 'Admin Forgot Password')

@section('content')
<body>
 
    <section class="login p-fixed d-flex text-center bg-primary common-img-bg">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <div class="login-card card-block">
                        
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        
                        <form class="md-float-material" method="POST" action="{{ route('admin.password.email') }}" aria-label="{{ __('Reset Password') }}">
                        @csrf 
                            <div class="text-center">
                                <h1 class="display-1 futura">Workshire Admin</h1>
                            </div>
                            <h3 class="text-primary text-center m-b-25">Recover your password</h3> 

                            <div class="md-group">
                                <div class="md-input-wrapper">
                                    <input type="email" class="md-form-control form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="email" value="{{ old('email') }}" required/> 
                                    <label>Email</label>

                                    @if ($errors->has('email'))
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="btn-forgot">
                                <button type="submit" class="btn btn-primary btn-md waves-effect waves-light text-center">SEND RESET LINK
                                </button> 
                            </div>
                            <div class="row">
                                <div class="col-xs-12 text-center m-t-25"> 
                                    <a href="{{route('admin.login')}}" class="f-w-600 p-l-5"> Sign In Here</a> 
                                </div>
                            </div>
                        <!-- end of btn-forgot class-->
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
</body> 
@endsection
