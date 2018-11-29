<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('includes.favicon') 
    <title>{{ config('app.name', 'Workshire') }} - @yield('title')</title>

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
    @yield('css') 
</head>
<body style="background-color:#efefef" class="gothic">
    <div id="app"> 
      <nav class="navbar navbar-expand-md navbar-light bg-third mb-0" role="navigation">
        <!--GLOBAL NAV-->
        @if(Auth::guard('employer')->check() AND Auth::guard('employer')->user()->role->id ==  2)
          <a class="navbar-brand" href="{{ route('employer.main')}}">
        @else
          <a class="navbar-brand" href="{{ route('main')}}">
        @endif    
            <scan class="font-weight-bold futura futuraCOLOR titleMain">{{ config('app.name', 'Workshire') }}</scan>
          </a>

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent"> 
            <ul class="navbar-nav mr-auto"></ul>  
            <ul class="nav navbar-nav navbar-right">  
                @include('includes.noti_system')
        <!--END OF GLOBAL NAV-->
        <!--AUTH NAV-->        
        @if((Auth::guard('employer')->check() AND Auth::guard('employer')->user()->role->id ==  2) OR (Auth::guard('web')->check() AND Auth::guard('web')->user()->role->id ==  1)) 
          @include('includes.menu') 
        @else  
                <li class="mx-2 nav-item"><a class="nav-link" href="{{ route('login') }}">{{__('Login')}}</a></li>
                <li class="mx-2 mr-3 nav-item"><a class="nav-link" href="{{ route('register') }}">{{__('Register')}}</a></li> 
            </ul>
            <button class="btn btn-border-radius btn-outline-success  mt-2 mt-md-0" onclick="location.href='{{ route('employer.main') }}'">
              {{__('POST FREE JOB')}}
            </button> 
          </div>
        @endif 
        <!--END OF AUTH NAV-->     
      </nav>    
      <div class="loading"><i class="fas fa-spin fa-spinner fa-2x fa-tw"></i><br><span>Loading</span></div> 
      @yield('content')
    </div>  
</body> 

  <!-- Scripts -->  
  <script src="{{ asset('public/js/app.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
  <!-- 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.17/vue.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script> 
  -->
  <!-- Custom JS Start-->   
  @yield('js') 
  <!-- Custom JS End-->
</html>
