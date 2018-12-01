<aside class="main-sidebar hidden-print " >
    <section class="sidebar" id="sidebar-scroll"> 
        <div class="user-panel">
            <div class="f-left image"><img src="{{asset('public/admin/assets/images/avatar-1.png') }}" alt="User Image" class="img-circle"></div>
            <div class="f-left info">
                <p>{{ Auth::user()->name }}</p>
                <p class="designation"> 
                    @auth('admin')  
                        @if(Auth::user()->role->id == 3) 
                            Super Admin&nbsp;
                        @elseif(Auth::user()->role->id == 4) 
                            Posting Admin&nbsp;
                        @endif 
                    @endauth  
                    <i class="icofont icofont-caret-down m-l-5"></i>
                </p>
            </div>
        </div>
        <!-- sidebar profile Menu-->
        <ul class="nav sidebar-menu extra-profile-list">
            <li>
                <a class="waves-effect waves-dark" href="profile.html">
                    <i class="icon-user"></i>
                    <span class="menu-text">View Profile</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li>
                <a class="waves-effect waves-dark" href="javascript:void(0)">
                    <i class="icon-settings"></i>
                    <span class="menu-text">Settings</span>
                    <span class="selected"></span>
                </a>
            </li> 
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
            <li class="treeview {{ Request::path() == 'admins' ? 'active' : '' }}">
                <a class="waves-effect waves-dark" href="{{route('admin.dashboard')}}">
                    <i class="icon-speedometer"></i><span> Dashboard</span>
                </a>                
            </li>
            @if(Request::path() == 'admins/setting/search-candidate' OR Request::path() == 'admins/setting/candidate-expired' OR Request::path() == 'admins/setting/mail' OR  Request::path() == 'admins/setting/web' OR  Request::path() == 'admins/setting/package' OR  Request::path() == 'admins/setting/package/employer' OR  Request::path() == 'admins/setting/package/topup/add' OR  Request::path() == 'admins/setting/package/topup/reload')
            <li class="treeview active">
            @else
            <li class="treeview">
            @endif    
                <a class="waves-effect waves-dark" href="#!">
                    <i class="icofont icofont-ui-settings"></i><span> User Setting</span><i class="icon-arrow-down"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ Request::path() == 'admins/setting/mail' ? 'active' : '' }}">
                        <a class="waves-effect waves-dark" href="{{route('admin.mail')}}">
                            <i class="icon-arrow-right"></i> Mail
                        </a>
                    </li> 
                    <li class="{{ Request::path() == 'admins/setting/web' ? 'active' : '' }}">
                        <a class="waves-effect waves-dark" href="{{route('admin.web')}}">
                            <i class="icon-arrow-right"></i> Web
                        </a>
                    </li> 
                    <li class="{{ Request::path() == 'admins/setting/search-candidate' ? 'active' : '' }}">
                        <a class="waves-effect waves-dark" href="{{route('admin.search_candidate')}}">
                            <i class="icon-arrow-right"></i> Search candidate
                        </a>
                    </li> 
                    <li class="{{ Request::path() == 'admins/setting/candidate-expired' ? 'active' : '' }}">
                        <a class="waves-effect waves-dark" href="{{route('admin.candidate_expired')}}">
                            <i class="icon-arrow-right"></i> Search candidate duration
                        </a>
                    </li> 
                    @if(Request::path() == 'admins/setting/package' OR Request::path() == 'admins/setting/package/employer' OR Request::path() == 'admins/setting/package/topup/add' OR Request::path() == 'admins/setting/package/topup/reload')
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
                            <li class="{{ Request::path() == 'admins/setting/package' ? 'active' : '' }}">
                                <a class="waves-effect waves-dark" href="{{route('admin.package')}}">
                                    <i class="icon-arrow-right"></i>
                                    Package list
                                </a>
                            </li>  
                            <li class="{{ Request::path() == 'admins/setting/package/employer' ? 'active' : '' }}">
                                <a class="waves-effect waves-dark" href="{{route('admin.package_employer')}}">
                                    <i class="icon-arrow-right"></i>
                                    Employer list
                                </a>
                            </li>  
                        </ul>
                    </li>
                </ul>
            </li>
 

            <li class="nav-level">Components</li>
            <li class="treeview"><a class="waves-effect waves-dark" href="#!"><i class="icon-briefcase"></i><span> UI Elements</span><i class="icon-arrow-down"></i></a>
                <ul class="treeview-menu">
                    <li><a class="waves-effect waves-dark" href="accordion.html"><i class="icon-arrow-right"></i> Accordion</a></li>
                    <li><a class="waves-effect waves-dark" href="button.html"><i class="icon-arrow-right"></i> Button</a></li>
                    <li><a class="waves-effect waves-dark" href="label-badge.html"><i class="icon-arrow-right"></i> Label Badge</a></li>
                    <li><a class="waves-effect waves-dark" href="bootstrap-ui.html"><i class="icon-arrow-right"></i> Grid system</a></li>
                    <li><a class="waves-effect waves-dark" href="box-shadow.html"><i class="icon-arrow-right"></i> Box Shadow</a></li>
                    <li><a class="waves-effect waves-dark" href="color.html"><i class="icon-arrow-right"></i> Color</a></li>
                    <li><a class="waves-effect waves-dark" href="light-box.html"><i class="icon-arrow-right"></i> Light Box</a></li>
                    <li><a class="waves-effect waves-dark" href="notification.html"><i class="icon-arrow-right"></i> Notification</a></li>
                    <li><a class="waves-effect waves-dark" href="panels-wells.html"><i class="icon-arrow-right"></i> Panels-Wells</a></li>
                    <li><a class="waves-effect waves-dark" href="tabs.html"><i class="icon-arrow-right"></i> Tabs</a></li>
                    <li><a class="waves-effect waves-dark" href="tooltips.html"><i class="icon-arrow-right"></i> Tooltips</a></li>
                    <li><a class="waves-effect waves-dark" href="typography.html"><i class="icon-arrow-right"></i> Typography</a></li>
                </ul>
            </li>

            <li class="treeview"><a class="waves-effect waves-dark" href="#!"><i class="icon-chart"></i><span> Charts &amp; Maps</span><span class="label label-success menu-caption">New</span><i class="icon-arrow-down"></i></a>
                <ul class="treeview-menu">
                    <li><a class="waves-effect waves-dark" href="float-chart.html"><i class="icon-arrow-right"></i> Float Charts</a></li>
                    <li><a class="waves-effect waves-dark" href="morris-chart.html"><i class="icon-arrow-right"></i> Morris Charts</a></li>
                </ul>
            </li>

            <li class="treeview"><a class="waves-effect waves-dark" href="#!"><i class="icon-book-open"></i><span> Forms</span><i class="icon-arrow-down"></i></a>
                <ul class="treeview-menu">
                    <li><a class="waves-effect waves-dark" href="form-elements-bootstrap.html"><i class="icon-arrow-right"></i> Form Elements Bootstrap</a></li>
                    <li><a class="waves-effect waves-dark" href="form-elements-materialize.html"><i class="icon-arrow-right"></i> Form Elements Material</a></li>
                    <li><a class="waves-effect waves-dark" href="form-elements-advance.html"><i class="icon-arrow-right"></i> Form Elements Advance</a></li>
                </ul>
            </li>
            
            <li class="treeview">
                <a class="waves-effect waves-dark" href="basic-table.html">
                    <i class="icon-list"></i><span> Table</span>
                </a>                
            </li>


            <li class="nav-level">More</li>

            <li class="treeview"><a class="waves-effect waves-dark" href="#!"><i class="icon-docs"></i><span>Pages</span><i class="icon-arrow-down"></i></a>
                <ul class="treeview-menu">
                    <li class="treeview"><a href="#!"><i class="icon-arrow-right"></i><span> Authentication</span><i class="icon-arrow-down"></i></a>
                        <ul class="treeview-menu">
                            <li><a class="waves-effect waves-dark" href="register1.html" target="_blank"><i class="icon-arrow-right"></i> Register 1</a></li>
                            
                            <li><a class="waves-effect waves-dark" href="login1.html" target="_blank"><i class="icon-arrow-right"></i><span> Login 1</span></a></li>
                            <li><a class="waves-effect waves-dark" href="forgot-password.html" target="_blank"><i class="icon-arrow-right"></i><span> Forgot Password</span></a></li>
                            <li><a class="waves-effect waves-dark" href="profile.html"><i class="icon-arrow-right"></i> Profile</a></li>
                        </ul>
                    </li>
                    <li><a class="waves-effect waves-dark" href="lock-screen.html" target="_blank"><i class="icon-arrow-right"></i> Lock Screen</a></li>
                    <li><a class="waves-effect waves-dark" href="404.html" target="_blank"><i class="icon-arrow-right"></i> Error 404</a></li>
                    <li><a class="waves-effect waves-dark" href="sample-page.html"><i class="icon-arrow-right"></i> Sample Page</a></li>
                    <li><a class="waves-effect waves-dark" href="search-result.html"><i class="icon-arrow-right"></i> Search Result</a></li>
                </ul>
            </li>


            <li class="nav-level">Menu Level</li>

            <li class="treeview"><a class="waves-effect waves-dark" href="#!"><i class="icofont icofont-company"></i><span>Menu Level 1</span><i class="icon-arrow-down"></i></a>
                <ul class="treeview-menu">
                    <li>
                        <a class="waves-effect waves-dark" href="#!">
                            <i class="icon-arrow-right"></i>
                            Level Two
                        </a>
                    </li>
                    <li class="treeview">
                        <a class="waves-effect waves-dark" href="#!">
                            <i class="icon-arrow-right"></i>
                            <span>Level Two</span>
                            <i class="icon-arrow-down"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a class="waves-effect waves-dark" href="#!">
                                    <i class="icon-arrow-right"></i>
                                    Level Three
                                </a>
                            </li>
                            <li>
                                <a class="waves-effect waves-dark" href="#!">
                                    <i class="icon-arrow-right"></i>
                                    <span>Level Three</span>
                                    <i class="icon-arrow-down"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li>
                                        <a class="waves-effect waves-dark" href="#!">
                                            <i class="icon-arrow-right"></i>
                                            Level Four
                                        </a>
                                    </li>
                                    <li>
                                        <a class="waves-effect waves-dark" href="#!">
                                            <i class="icon-arrow-right"></i>
                                            Level Four
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
    </section>
</aside>