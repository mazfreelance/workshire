@if(Auth::guard('employer')->check() AND Auth::guard('employer')->user()->role->id ==  2) 
      <li class="mx-2 nav-item"> 
        <a class="nav-link" href="{{ route('employer.dashboard') }}"> 
          <span class="fa fa-home mt-sm-1 text-primary" style="font-size:20px;"></span>
        </a>
      </li> 
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">   
          @if(file_exists(public_path().'/default_pictures/small/'.Auth::guard('employer')->user()->employer[0]->emp_logo_loc) AND Auth::guard('employer')->user()->employer[0]->emp_logo_loc != '') 
            <img src="{{asset('public/default_pictures/small').'/'.Auth::guard('employer')->user()->employer[0]->emp_logo_loc}}" class="img-fluid rounded-circle" width="25" /> 
          @else
            <span class="fa fa-user fa-lg"></span> 
          @endif
          <strong>{{ Auth::guard('employer')->user()->employer[0]->emp_name }}</strong> 
        </a>

        <div class="dropdown-menu dropdown-menu-right text-sm-left text-center" aria-labelledby="navbarDropdown">
          <div class="navbar-login"> 
            <a class="dropdown-item {{Request::path() == 'employer/profile' ? 'active':''}}" href="{{route('employer.profile')}}">
              <i class="fa fa-user"></i>&nbsp;{{ __('Profile') }}
            </a>
            <a class="dropdown-item {{Request::path() == 'employer/paid-candidate' ? 'active':''}}" href="{{route('employer.paid')}}">
              <i class="fa fa-money-bill-alt "></i>&nbsp;{{ __('Paid Candidate') }}
            </a>
            <a class="dropdown-item" href="{{route('employer.message')}}">
              <i class="fa fa-envelope"></i>&nbsp;{{ __('Message') }}
            </a>
            <a class="dropdown-item" href="{{route('employer.pricing')}}">
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
              <i class="fa fa-sign-out-alt"></i>&nbsp;{{ __('Log Out') }} 
              <form id="employer-logout-form" action="{{ route('employer.logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
            </a> 
          </div>
        </div>
      </li> 
  </ul> 
</div> 

@elseif(Auth::guard('web')->check() AND Auth::guard('web')->user()->role->id ==  1)  
      <li class="mx-2 nav-item"> 
        <a class="nav-link" href="{{ route('seeker.dashboard') }}"> 
          <span class="fa fa-home mt-sm-1 text-primary" style="font-size:20px;"></span>
        </a>
      </li>

      <li class="nav-item dropdown"> 
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">     
          @if(file_exists(public_path().'/default_pictures/small/'.Auth::guard('web')->user()->seeker->seeker_profile_photo_loc) AND Auth::guard('web')->user()->seeker->seeker_profile_photo_loc != '') 
            <img src="{{asset('public/default_pictures/small').'/'.Auth::guard('web')->user()->seeker->seeker_profile_photo_loc}}" class="img-fluid rounded-circle" width="25" />  
          @else
            <span class="fa fa-user fa-lg"></span> 
          @endif
          <strong>{{ Auth::user()->username }}</strong> 
        </a>

        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item {{Request::path() == 'seeker/profile' ? 'active':''}}" 
             href="{{ route('seeker.profile') }}"><i class="fa fa-user"></i>&nbsp;{{ __('Profile') }}
          </a>
          <a class="dropdown-item {{Request::path() == 'seeker/message' ? 'active':''}}" 
             href="{{ route('seeker.message') }}"><i class="fa fa-envelope"></i>&nbsp;{{ __('Message') }}
           </a>
          <a class="dropdown-item {{Request::path() == 'seeker/save-job' ? 'active':''}}" 
             href="{{route('seeker.savejob')}}"><i class="fa fa-star"></i>&nbsp;{{ __('Saved Job') }}
           </a>
          <div class="dropdown-divider"></div>
          @if(Request::path() == 'seeker/setting' OR Request::path() == 'seeker/setting/notification' OR Request::path() == 'seeker/setting/password')
          <a class="dropdown-item active" href="{{ route('seeker.setting') }}">
          @else
          <a class="dropdown-item" href="{{ route('seeker.setting') }}">
          @endif
            <i class="fa fa-cogs"></i>&nbsp;{{ __('Setting') }}
          </a> 
          <div class="dropdown-divider"></div>
          <a class="dropdown-item bg-danger text-light" href="{{ route('user.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fa fa-sign-out"></i>&nbsp;{{ __('Log Out') }} 
            <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
          </a> 
        </div>
      </li>
  </ul> 
</div> 

@endif