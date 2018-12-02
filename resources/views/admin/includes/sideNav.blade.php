<aside class="main-sidebar hidden-print " >
    <section class="sidebar" id="sidebar-scroll"> 
        <div class="user-panel">
            <div class="f-left image"><img src="{{asset('public/admin/assets/images/avatar-1.png') }}" alt="User Image" class="img-circle"></div>
            <div class="f-left info">
                <p>{{ Auth::user()->name }}</p>
                <p class="designation"> 
                    @auth('admin')  
                        @if(Auth::user()->role->id == 3) 
                            <label class="label bg-success">Owner</label>
                        @elseif(Auth::user()->role->id == 4) 
                            <label class="label bg-warning">Administrator</label> 
                        @endif 
                    @endauth  
                    <i class="icofont icofont-caret-down m-l-5"></i>
                </p>
            </div>
        </div>
        <!-- sidebar profile Menu-->
        <ul class="nav sidebar-menu extra-profile-list">
            <!--
            <li>
                <a class="waves-effect waves-dark" href="profile.html">
                    <i class="icon-user"></i>
                    <span class="menu-text">View Profile</span>
                    <span class="selected"></span>
                </a>
            </li>
            -->
            @if(Auth::user()->role->id == 3) 
            @if(Request::path() == 'admin/setting/user')
            <li class="active">
            @else
            <li>
            @endif
                <a class="waves-effect waves-dark" href="{{route('admin.user')}}">
                    <i class="icon-settings"></i>
                    <span class="menu-text">Settings</span>
                    <span class="selected"></span>
                </a>
            </li> 
            @endif
            <!-- LOGOUT START -->
            <li>
                <a class="waves-effect waves-dark" href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('admin-logout-form').submit();">
                    <i class="icon-logout"></i>
                    <span class="menu-text">Logout</span>
                    <span class="selected"></span>

                    <form id="admin.logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                      @csrf
                    </form>
                </a> 
            </li>
            <!-- LOGOUT END -->
        </ul>
        <!-- Sidebar Menu-->
        <ul class="sidebar-menu">
            <li class="nav-level">Navigation</li>
            <li class="treeview {{ Request::path() == 'admin' ? 'active' : '' }}">
                <a class="waves-effect waves-dark" href="{{route('admin.dashboard')}}">
                    <i class="icon-speedometer"></i><span> Dashboard</span>
                </a>                
            </li>
            @if(Request::path() == 'admin/setting/search-candidate' OR Request::path() == 'admin/setting/candidate-expired' OR Request::path() == 'admin/setting/mail' OR  Request::path() == 'admin/setting/web' OR  Request::path() == 'admin/setting/package' OR  Request::path() == 'admin/setting/package/employer' OR  Request::path() == 'admin/setting/package/topup/add' OR  Request::path() == 'admin/setting/package/topup/reload')
            <li class="treeview active">
            @else
            <li class="treeview">
            @endif    
                <a class="waves-effect waves-dark" href="#!">
                    <i class="icofont icofont-ui-settings"></i><span> User Setting</span><i class="icon-arrow-down"></i>
                </a>
                <ul class="treeview-menu">
                    @if(Auth::user()->role->id == 3) 
                    <li class="{{ Request::path() == 'admin/setting/mail' ? 'active' : '' }}">
                        <a class="waves-effect waves-dark" href="{{route('admin.mail')}}">
                            <i class="icon-arrow-right"></i> Mail
                        </a>
                    </li> 
                    <li class="{{ Request::path() == 'admin/setting/web' ? 'active' : '' }}">
                        <a class="waves-effect waves-dark" href="{{route('admin.web')}}">
                            <i class="icon-arrow-right"></i> Web
                        </a>
                    </li>
                    @endif
                    <li class="{{ Request::path() == 'admin/setting/search-candidate' ? 'active' : '' }}">
                        <a class="waves-effect waves-dark" href="{{route('admin.search_candidate')}}">
                            <i class="icon-arrow-right"></i> Search candidate
                        </a>
                    </li> 
                    <li class="{{ Request::path() == 'admin/setting/candidate-expired' ? 'active' : '' }}">
                        <a class="waves-effect waves-dark" href="{{route('admin.candidate_expired')}}">
                            <i class="icon-arrow-right"></i> Search candidate duration
                        </a>
                    </li> 
                    @if(Request::path() == 'admin/setting/package' OR Request::path() == 'admin/setting/package/employer' OR Request::path() == 'admin/setting/package/topup/add' OR Request::path() == 'admin/setting/package/topup/reload')
                    <li class="treeview active">
                    @else
                    <li class="treeview">
                    @endif    
                        <a class="waves-effect waves-dark" href="">
                            <i class="icon-arrow-right"></i>
                            <span>Package candidate</span>
                            <i class="icon-arrow-down"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ Request::path() == 'admin/setting/package' ? 'active' : '' }}">
                                <a class="waves-effect waves-dark" href="{{route('admin.package')}}">
                                    <i class="icon-arrow-right"></i>
                                    Package list
                                </a>
                            </li>  
                            <li class="{{ Request::path() == 'admin/setting/package/employer' ? 'active' : '' }}">
                                <a class="waves-effect waves-dark" href="{{route('admin.package_employer')}}">
                                    <i class="icon-arrow-right"></i>
                                    Employer list
                                </a>
                            </li>  
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="treeview">
                <a class="waves-effect waves-dark" href="#!">
                    <i class="icofont icofont-ui-settings"></i><span> Sourcing</span><i class="icon-arrow-down"></i>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a class="waves-effect waves-dark" href="">
                            <i class="icon-arrow-right"></i>
                            <span>Sourcing Numbers</span>
                            <i class="icon-arrow-down"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ Request::path() == 'admin/seeker' ? 'active' : '' }}">
                                <a class="waves-effect waves-dark" href="{{route('admin.seeker')}}">
                                    <i class="icon-arrow-right"></i>
                                    Seeker
                                </a>
                            </li>  
                            <li class="{{ Request::path() == 'admin/employer' ? 'active' : '' }}">
                                <a class="waves-effect waves-dark" href="{{route('admin.employer')}}">
                                    <i class="icon-arrow-right"></i>
                                    Employer
                                </a>
                            </li>  
                            <li class="{{ Request::path() == 'admin/other' ? 'active' : '' }}">
                                <a class="waves-effect waves-dark" href="{{route('admin.other')}}">
                                    <i class="icon-arrow-right"></i>
                                    RA, JP, etc
                                </a>
                            </li>  
                        </ul>
                    </li> 
                    <li class="{{ Request::path() == 'admin/setting/web' ? 'active' : '' }}">
                        <a class="waves-effect waves-dark" href="{{route('admin.web')}}">
                            <i class="icon-arrow-right"></i> Web
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </section>
</aside>