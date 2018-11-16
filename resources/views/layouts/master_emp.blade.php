<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('includes.favicon') 
    <title>{{ config('app.name', 'Workshire') }} - @yield('title')</title>

    <!-- Meta | SEO -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">  

    <!-- Styles -->
    <link href="{{ asset('public/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/bootstrap-social.css') }}" rel="stylesheet"> 
    <!-- Fonts -->
    <link href="{{ asset('public/fonts/font.css') }}" rel="stylesheet">  

    <!-- Scripts -->
    <script src="{{ asset('public/js/app.js') }}" defer></script>   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.17/vue.min.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 
    <script src="{{ asset('public/js/jquery.printPage.js') }}"></script>
    <!--CUSTOM SCRIPT START-->
    <script> 
      $(window).scroll(function() {    
          var scroll = $(window).scrollTop();

          if (scroll >= 100) {
              $(".top-nav").addClass("light-header");
          } else {
              $(".top-nav").removeClass("light-header");
          }
      });

      // Year for copy content
      $(function(){
      var theYear = new Date().getFullYear();
      $('#year').html(theYear);
      });
 
      function openCart(){ 
        $('#AddCartModal').modal('show');    
      }  
    </script>
    <!--CUSTOM SCRIPT END-->
    @yield('js')
</head>

  <body class="gothic">
      <div id="app">  
        <!-- Top navigation -->
        <nav class="navbar navbar-expand-md fixed-top top-nav"> 
          <div class="container"> 
              <a class="navbar-brand" href="{{ url('/employer') }}">
                  <scan class="font-weight-bold futura titleMain">{{ config('app.name', 'Workshire') }}</scan>
              </a>  
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"><i class="fa fa-bars" aria-hidden="true"></i></span>
              </button>

              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">   
                  @include('includes.noti_system')  

                  @if(Request::path() == 'employer/home' OR Request::path() == 'employer/pricing' OR Request::path() == 'employer/cart' OR Auth::guard('employer')->check())
                  <li class="nav-item">    
                    <a class="nav-link" onClick="openCart();" style="cursor:pointer">
                      <i class="fa fa-shopping-cart text-primary fa-lg"></i> Cart 
                      <span class="badge badge-pill badge-dark">{{Cart::count()}}</span>
                    </a> 
                  </li> 
                  @endif

                  @if(Auth::guard('employer')->check() && Auth::guard('employer')->user()->role->id == 2)  
                  <li class="nav-item">    
                    <a href="{{ route('employer.dashboard') }}" class="nav-link">
                      <span class="fa fa-home text-primary fa-lg"></span>
                    </a>
                  </li> 
                  
                  <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user" style="font-size:20px;"></i>
                        <strong>{{ Auth::guard('employer')->user()->employer[0]->emp_name }}</strong>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right text-sm-left text-center" aria-labelledby="navbarDropdown">
                        <div class="navbar-login"> 
                          <a class="dropdown-item {{Request::path() == 'employer/profile' ? 'active':''}}" href="{{route('employer.profile')}}">
                            <i class="fa fa-user"></i>&nbsp;{{ __('Profile') }}
                          </a>
                          <a class="dropdown-item {{Request::path() == 'employer/paid-candidate' ? 'active':''}}" href="{{route('employer.paid')}}">
                            <i class="fa fa-money-bill "></i>&nbsp;{{ __('Paid Candidate') }}
                          </a>
                          <a class="dropdown-item" href="{{route('employer.message')}}">
                            <i class="fa fa-envelope"></i>&nbsp;{{ __('Message') }}
                          </a>
                          <a class="dropdown-item {{Request::path() == 'employer/pricing' ? 'active':''}}" href="{{route('employer.pricing')}}">
                            <i class="fa fa-cubes"></i>&nbsp;{{ __('Packages & Advertisement') }}
                          </a>
                          <div class="dropdown-divider"></div>

                          @if(Request::path() == 'employer/setting' OR Request::path() == 'employer/setting/plan' OR Request::path() == 'employer/setting/notification' OR Request::path() == 'employer/setting/password')
                          <a class="dropdown-item active" href="{{route('employer.setting')}}">
                          @else
                          <a class="dropdown-item" href="{{route('employer.setting')}}">
                          @endif
                            <i class="fa fa-cogs"></i>&nbsp;{{ __('Setting') }}
                          </a>  
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item bg-danger text-light" href="{{ route('employer.logout') }}" onclick="event.preventDefault(); document.getElementById('employer-logout-form').submit();">
                            <i class="fa fa-sign-out"></i>&nbsp;{{ __('Log Out') }} 
                            <form id="employer-logout-form" action="{{ route('employer.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                          </a> 
                        </div>
                      </div>
                  </li> 
                  @else
                  <li class="nav-item dropdown">
                      <a class="nav-link" href="#" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-th-large" style="font-size:20px;"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-left text-sm-left text-center" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="{{ route('employer.main') }}">{{__('Home')}}</a>
                          <a class="dropdown-item" href="{{ route('employer.login')}}">{{__('Login')}}</a>
                          <a class="dropdown-item" href="{{ route('about_us') }}">About Us</a>
                          <a class="dropdown-item" href="{{ route('data_policy') }}">Personal Data Protection</a>
                          <a class="dropdown-item" href="{{ route('privacy') }}">Privacy Policy</a>
                          <a class="dropdown-item" href="{{ route('term&conds') }}">Terms & Conditions</a> 
                      </div>
                  </li> 
                  <li class="nav-item">    
                    <a href="{{ route('main') }}" class="nav-link">{{__('Talent')}}</a>
                  </li>
                  @endif
                </ul>
              </div>  
          </div>   
        </nav>  

        @yield('content')
        
        <footer class="team-footer bg-dark text-center text-light">  
            © 2016 - 2018 Workshire.com.my | Recruitment Agency Talent Workshire Sdn Bhd  
        </footer>
      </div>
 
      <!-- Modal #AddCartModal Start -->
      <div class="modal fade" tabindex="-1" role="dialog" id="AddCartModal">
          <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header"> 
                  <h5 align="center" class="pull-left" style="font-weight:bold; margin:5px">
                    <i class="fa fa-shopping-cart"></i>
                    <span class="badge">{{Cart::count()}}</span>
                  </h5> 
                  <h5 align="center" class="pull-right" style="font-weight:bold; margin:5px">Total:
                    <span style="color:green">{{Cart::subtotal()}}</span>
                  </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <?php $cartData = Cart::content();?>
                  @if(count($cartData)!=0)
                    @foreach($cartData as $cartD)
                    <div class="row">
                      <div class="col text-uppercase">
                        <h4>{{$cartD->name}}</h4>
                      </div> 
                    </div>
                    <div class="row">
                      <div class="col">
                        <h5>Price: {{$cartD->price}}</h5>
                      </div> 
                      <div class="col">
                        <h5>Quantity: {{$cartD->qty}}</h5>
                      </div> 
                    </div>
                    @endforeach
                    <button class="btn btn-warning btn-md" onClick="location.href='{{route('employer.checkout')}}'">Checkout</button>
                    <button class="btn btn-info btn-md" onClick="location.href='{{route('employer.cart')}}'">View Cart</button>
                  @else
                    <div class="row">
                      <div class="col">
                        <p>You have no items in your carts</p>

                        @if(Request::path() !== 'employer/pricing')
                        <button class="btn btn-warning btn-md" onClick="location.href='{{route('employer.pricing')}}'">
                          Package List
                        </button>
                        @endif
                      </div> 
                    </div>
                  @endif  
                  <hr>
                  <div class="small font-italic">
                    Notes: All product have Sales & Service Tax (SST) which is 6 percent (%).
                  </div>
                </div> 
            </div>
          </div>
      </div>
      <!-- Modal #AddCartModal End -->
  </body> 
</html>
