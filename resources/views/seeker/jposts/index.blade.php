<main class="py-0">  
  <div class="row bg-third border border-bottom-primary py-2 pl-sm-4 mr-0"> 
    <div class="container">
      <div class="row mx-1">
        <!-- Filter Job Start -->
        @include('seeker.includes.filterjob') 
        <!-- Filter Job End -->
      </div><!-- end of row mx-1 -->
    </div><!-- end of container -->
  </div>  
  <div class="row mt-1 py-2 pl-sm-4 mr-0 mx-0"> 
      <div class="col-sm col-md-9">  
        <!-- Filter Job Session Start -->
        @include('seeker.includes.filterjob_session')   
        <!-- Filter Job Session End -->
        <div class="row pl-sm-5 mt-3">
          <div class="col-sm col-md">
            Total {{$posts->total()}} jobs available. 
          </div>
          <div class="col-sm col-md text-sm-right"> 
            Page {{$posts->count()}} of {{$posts->total()}}
          </div>
        </div> 
        @if($posts->total() == 0)
          <hr class="ml-sm-5">
          <div class="row ml-sm-5">
            <img src="{{asset('public/images/icon/search_not_found.png')}}" style="margin-top: -3em;pointer-events: none;"/>
          </div>
        @else     

          @if ($message = Session::get('save'))
          <div class="alert alert-success alert-block ml-sm-5 mt-1">
              <button type="button" class="close" data-dismiss="alert">×</button> 
                  <strong>{{ $message }}</strong>
          </div>
          @endif 

          @foreach ($posts as $jobpost)  
            <hr class="ml-sm-5">
            <div class="row pl-sm-5">
              <div class="col-sm col-md-3">    
                @if(file_exists(public_path().'/default_pictures/medium/'.$jobpost->emp_logo_loc) and $jobpost->emp_logo_loc != '' )
                  <img src="{{asset('public/default_pictures/medium').'/'.$jobpost->emp_logo_loc }}" class="img-fluid img-rounded border border-dark" width="150"> 
                @else
                  <img src="{{ asset('public/images/default/company.jpg') }}" class="img-fluid img-rounded border border-dark" width="150" />
                @endif
              </div>
              <div class="col-sm col-md py-1">
                <div class="col-sm col-md">
                  <!--  javascript:ajaxLoad('{{--url('jposts/show/'.$jobpost->id)--}}') -->    
                  @if(Auth::check())      
                      @if($jobpost->seeker_id == Auth::user()->seeker->id)
                        <a href="{{route('unsave_job')}}?id={{$jobpost->saved_id}}" class="float-right" data-toggle="tooltip" data-placement="top" title="Unsave this job">
                          <i class="fas fa-star"></i>
                        </a>  
                      @else 
                      <a href="{{route('save_job')}}?jobpost={{$jobpost->id}}&seeker={{Auth::user()->seeker->id}}" class="float-right" data-toggle="tooltip" data-placement="top" title="Save this job">
                        <i class="far fa-star"></i>
                      </a> 
                      @endif 
                  @endif  
                  <a href="ViewJob/{{str_replace(' ', '-', $jobpost->jobpost_position)}}/{{$jobpost->id}}" target="_blank">
                    <h4>{{$jobpost->jobpost_position}}</h4>
                  </a> 
                </div>
                <div class="col-sm col-md">
                  <h6>
                    <i class="fa fa-building"></i> {!!$jobpost->emp_name!!}
                  </h6>
                </div>
                <div class="col-sm col-md"><h6><i class="fa fa-map-marker-alt"></i>&nbsp;{{$jobpost->jobpost_loc_city}}, {{$jobpost->jobpost_loc_state}}</h6></div>
                <div class="col-sm col-md small">
                  <span><i class="fa fa-tag"></i> {!!$jobpost->jobpost_emp_type!!}</span>
                  <span class="float-right">MYR {{$jobpost->jobpost_minSalary}} - {{$jobpost->jobpost_maxSalary}}</span>
                </div>
                <div class="col-sm col-md small">
                  <span><i class="fa fa-clock"></i>&nbsp;
                     Posted on {{date('jS M Y', strtotime($jobpost->jobpost_startDate))}}  
                  </span>
                  <span class="float-right">/ month</span>
                </div>
                @if(Auth::check()) 
                  @if($jobpost->appl_seeker == Auth::user()->seeker->id)
                    <div class="col-sm col-md small">
                      <span><i class="fa fa-thumbs-o-up"></i>&nbsp;
                        <span class="text-danger">You&#39;re already applied this positon.</span>
                      </span> 
                    </div> 
                  @endif
                @endif   
              </div>
            </div>
          @endforeach
        @endif
        <!--Pagination -->
        <nav aria-label="pagination" class="mt-2 d-flex justify-content-center">
          {{ $posts->links('vendor.pagination.bootstrap-4') }}
        </nav>   
      </div>
      <div class="col-sm col-md-3 border border-right-0 border-top-0 border-bottom-0 border-secondary pl-sm-2 pl-4 mt-2">
        <span class="d-block text-center mt-2 text-primary font-weight-bold">ADVANCED SEARCH</span>
        <hr> 
        <center>
          <button type="button" class="btn btn-outline-primary btn-md d-block mb-1">Fresh Graduate</button>
          <button type="button" class="btn btn-outline-danger btn-md d-block mb-1">Experience</button>
          <button type="button" class="btn btn-outline-success btn-md d-block mb-1">Internship</button>
          <button type="button" class="btn btn-outline-info btn-md d-block">SPM Leave</button>
        </center>
        <hr> 
        <div class="row justify-content-center"> 
          <div class="form-row"> 
              <div class="form-group col-md">
                  <label class="d-block text-center">Job Level</label> 
              <select class="custom-select" name="post_level" id="post_level">
                <option value="" selected>Select One..</option> 
                @foreach($poslvl_array as $poslvl)  
                      <option value="{{$poslvl->post_level}}" {{request()->session()->get('srch_poslvl')==$poslvl->post_level? 'selected':''}}>{{$poslvl->post_level}}</option>
                @endforeach
              </select>
              </div>
            </div>
        </div>
        <hr> 
        <div class="row justify-content-center"> 
          <div class="form-row"> 
              <div class="form-group col-md">
                <label class="d-block text-center">Years of experience</label> 
                <select class="custom-select form-control-sm" name="years_exp" id="years_exp"> 
                  <option value="" selected>Select one...</option>
                  <?php
                    $years_exp = array('Less than a year', '1 to 3 years', '4 to 6 years', '7 to 9 years', '10 years and above');
                    foreach ($years_exp as $year) {
                      echo '<option value="'.$year.'" ';
                      echo request()->session()->get('srch_years')==$year? 'selected':'';
                      echo '>';
                      echo $year;
                      echo '</option>';
                    }
                  ?>
                </select>
              </div>
            </div>
        </div> 
      </div>
  </div> 
</main>
 