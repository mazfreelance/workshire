<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ config('app.name', 'Workshire') }} - @yield('title')</title>
    @include('includes.favicon') 
    <!-- HTML5 Shim and Respond.js IE9 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
     <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js') }}"></script>
     <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js') }}"></script>
     <![endif]-->

     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"> 

     <link href="{{ asset('public/css/main.css') }}" rel="stylesheet">
     <!-- Google font-->
     <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">

     <!-- iconfont -->
     <link rel="stylesheet" type="text/css" href="{{ asset('public/admin/assets/icon/icofont/css/icofont.css') }}">

     <!-- simple line icon -->
     <link rel="stylesheet" type="text/css" href="{{ asset('public/admin/assets/icon/simple-line-icons/css/simple-line-icons.css') }}">

     <!-- Required Fremwork -->
     <link rel="stylesheet" type="text/css" href="{{ asset('public/admin/assets/plugins/bootstrap/css/bootstrap.min.css') }}">

     <!-- Weather css -->
     <link href="{{ asset('public/admin/assets/css/svg-weather.css') }}" rel="stylesheet">

     <!-- Echart js -->
     <script src="{{asset('public/admin/assets/plugins/charts/echarts/js/echarts-all.js') }}"></script>

     <!-- Style.css -->
     <link rel="stylesheet" type="text/css" href="{{ asset('public/admin/assets/css/main.css') }}">

     <!-- Responsive.css-->
     <link rel="stylesheet" type="text/css" href="{{ asset('public/admin/assets/css/responsive.css') }}">

     <!--color css-->
     <link rel="stylesheet" type="text/css" href="{{ asset('public/admin/assets/css/color/color-1.min.css') }}" id="color"/>

     @yield('css')
 </head>

@if(Request::path() == 'admins/login' or Request::path() == 'password/reset') 
    @yield('content') 
@else
    
    <body class="sidebar-mini fixed">
        <div class="loader-bg">
            <div class="loader-bar">
            </div>
        </div>
        <div class="wrapper">
            <!--   
            <div class="loader-bg">
                <div class="loader-bar"></div>
            </div> 
            -->
            <!-- Navbar-->
            @include('admin.includes.header')
            <!-- Side-Nav-->
            @include('admin.includes.sideNav')

            @yield('content')
        </div>
    </body>
@endif

<!-- Required Jqurey -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{{asset('public/admin/assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{asset('public/admin/assets/plugins/tether/dist/js/tether.min.js') }}"></script>

<!-- Required Fremwork -->
<script src="{{asset('public/admin/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

<!-- waves effects.js -->
<script src="{{asset('public/admin/assets/plugins/Waves/waves.min.js') }}"></script>

<!-- Scrollbar JS-->
<script src="{{asset('public/admin/assets/plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>
<script src="{{asset('public/admin/assets/plugins/jquery.nicescroll/jquery.nicescroll.min.js') }}"></script>

<!--classic JS-->
<script src="{{asset('public/admin/assets/plugins/classie/classie.js') }}"></script>

<!-- notification -->
<script src="{{asset('public/admin/assets/plugins/notification/js/bootstrap-growl.min.js') }}"></script>

<!-- Rickshaw Chart js -->
<script src="{{asset('public/admin/assets/plugins/d3/d3.js') }}"></script>
<script src="{{asset('public/admin/assets/plugins/rickshaw/rickshaw.js') }}"></script>

<!-- Sparkline charts -->
<script src="{{asset('public/admin/assets/plugins/jquery-sparkline/dist/jquery.sparkline.js') }}"></script>

<!-- Counter js  -->
<script src="{{asset('public/admin/assets/plugins/waypoints/jquery.waypoints.min.js') }}"></script>
<script src="{{asset('public/admin/assets/plugins/countdown/js/jquery.counterup.js') }}"></script>

<!-- custom js -->
<script type="text/javascript" src="{{asset('public/admin/assets/js/main.min.js') }}"></script>
<script type="text/javascript" src="{{asset('public/admin/assets/pages/dashboard.js') }}"></script>
<script type="text/javascript" src="{{asset('public/admin/assets/pages/elements.js') }}"></script>
<script src="{{asset('public/admin/assets/js/menu.min.js') }}"></script>
@yield('js')
<script>
var $window = $(window);
var nav = $('.fixed-button');
$window.scroll(function(){
    if ($window.scrollTop() >= 200) {
     nav.addClass('active');
 }
 else {
     nav.removeClass('active');
 }
});
</script>

</html>
