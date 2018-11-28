<footer class="page-footer font-small bg-dark text-light pt-4 footer-section"> 
  <!-- Footer Links -->
  <div class="container-fluid text-center text-md-left">

    <!-- Grid row -->
    <div class="row">

      <!-- Grid column -->
      <div class="col-md-4 mt-md-0 mt-3">

        <!-- Content -->
        <h3 class="text-uppercase futura futuraCOLOR font-weight-bold">Workshire</h3>
        <p> 
          <h6 class="text-secondary">Contact us</h6>
          <span class="d-block">E-Mail us at enquiry@workshire.com.my</span>
          <span class="d-block">Call us at (+6)04 - 576 6829 (10am - 5pm daily, except weekdays and public holidays)</span>    
        </p>

      </div>
      <!-- Grid column -->

      <hr class="clearfix w-100 d-md-none pb-3">

      <!-- Grid column -->
      <div class="col-md-2 mb-md-0 mb-2">

          <!-- Links -->
          <h5 class="text-uppercase">Our Portal</h5>

          <ul class="list-unstyled">
            <li>
              <a href="{{ route('about_us') }}">About Us</a>
            </li>
            <li>
              <a href="{{ route('data_policy') }}">Personal Data Protection</a>
            </li>
            <li>
              <a href="{{ route('privacy') }}">Privacy Policy</a>
            </li>
            <li>
              <a href="{{ route('term&conds') }}">Terms & Conditions</a>
            </li>
          </ul>

        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-2 mb-md-0 mb-2">

          <!-- Links -->
          <h5 class="text-uppercase">Opportunities</h5>

          <ul class="list-unstyled">
            @if(Auth::guard('web')->check() OR Auth::guest())
            <li> 
              <a href="{{route('main')}}">Job Search</a>
            </li>
            @endif
            @guest
            <li>
              <a href="{{route('jobfairForm')}}">Begin with us!</a>
            </li>
            <li>
              <a href="#!">Operator Pool</a>
            </li>
            @endguest
            @if(Auth::guard('employer')->check() OR Auth::guest())
            <li>
              <a href="{{route('employer.main')}}">Post Free Jobs</a>
            </li>
            @endif
          </ul> 
        </div>
        <!-- Grid column -->


        <!-- Grid column -->
        <div class="col-md-4 mb-md-0 mb-4">

          <!-- Links -->
          <h5 class="text-uppercase">Stay connect with us</h5>

          <ul class="social-network social-circle">
            <li>
              <a href="#" class="icoRss" title="Rss"><i class="fa fa-rss"></i></a>
            </li>
            <li>
              <a href="#" class="icoFacebook" title="Facebook"><i class="fab fa-facebook-f"></i></a>
            </li>
            <li>
              <a href="#" class="icoTwitter" title="Twitter"><i class="fab fa-twitter"></i></a>
            </li>
            <li>
              <a href="#" class="icoGoogle" title="Google +"><i class="fab fa-google-plus"></i></a>
            </li>
            <li>
              <a href="#" class="icoLinkedin" title="Linkedin"><i class="fab fa-linkedin"></i></a>
            </li>
          </ul>
        </div>
        <!-- Grid column -->

    </div>
    <!-- Grid row -->

  </div>
  <!-- Footer Links -->

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3 bg-secondary text-light">
      © 2016 - 2018 Workshire.com.my | Recruitment Agency Talent Workshire Sdn Bhd 
  </div>
  <!-- Copyright -->

</footer> 