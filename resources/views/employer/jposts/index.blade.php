<main class="py-0">    
  @include('employer.includes.menu')
  <div class="row border border border-dark  mr-0 mx-1">
    <div class="col-sm-12 pl-sm-5 pt-sm-1 pt-0 pl-4">
        
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

      <h3 class="font-weight-bold">Jobs Posted</h3> 
      <hr style="margin-bottom:0.1em">
    </div>
    <div class="col-sm-3 pl-sm-5 pl-4"> 
        <h5>Finalist Candidate</h5>
        <table class="table table-bordered">
          <tr>
            <td>Job Position</td>
            <td>Status</td>
          </tr>
          <tr>
            <td colspan="2"><span class="badge badge-info fa-lg">KIV</span></td>
          </tr>
          @if(isset($applsKIV))
            @foreach($applsKIV as $applKIV)
            <tr>
              <td>{{$applKIV->jobpost_position}}</td>
              <td>{{$applKIV->total}}</td>
            </tr>
            @endforeach
          @else
            <tr>
              <td colspan="2">No result KIV found.</td>
            </tr>
          @endif
          <tr>
            <td colspan="2"><span class="badge badge-primary fa-lg">Processing</span></td>
          </tr> 
          @if(isset($applsProcess))
            @foreach($applsProcess as $applProcess)
            <tr>
              <td>{{$applProcess->jobpost_position}}</td>
              <td>{{$applProcess->total}}</td>
            </tr>
            @endforeach
          @else
            <tr>
              <td colspan="2">No result Processing found.</td>
            </tr>
          @endif
        </table>
        <hr class="d-lg-none">
    </div>
    <div class="col-sm pl-sm-5 pl-4">   

      @if($jposts->total() > 0)  
      @foreach($jposts as $jpost)
         <?php $pos=1; $total_Appl=0; ?>
        @foreach($appls as $appl)
          @if($jpost->id == $appl->appl_jobpostid)
          <?php $total_Appl += $pos ?>
          @endif
        @endforeach  
        <div class="row"> 
        <div class="col-sm">
          <div class="row"> 
            <div class="col-sm col-md py-1">
              <div class="col-sm col-md"> 
                <span class="float-sm-right">
                   <div class="d-block text-center">
                    <a class="text-primary editposttool" href="{{url('employer/update/'.$jpost->id)}}" data-toggle="tooltip" data-placement="top" title="Edit Post">
                      <i class="fa fa-edit"></i> Post
                    </a>
                    &nbsp;/&nbsp;
                    <a class="text-danger delposttool" id="{{url('employer/delete/'.$jpost->id)}},{{csrf_token()}}" href="" data-toggle="tooltip" data-placement="top" title="Delete Post">
                      <i class="fa fa-trash"></i> Post
                    </a>
                    @if(date('Y-m-d') < $jpost->jobpost_endDate)
                      &nbsp;/&nbsp; 
                      @if($jpost->jobpost_statusPosting == 'SHOW')
                        <a class="text-dark opencloseposttool" id="HIDE|{!! $jpost->jobpost_position !!}|{{url('employer/show/'.$jpost->id)}},{{csrf_token()}}" href="" data-toggle="tooltip" data-placement="top" title="Close Post">
                          <i class="fa fa-eye-slash"></i> Post
                        </a> 
                      @elseif($jpost->jobpost_statusPosting == 'HIDE')
                        <a class="text-dark opencloseposttool" id="SHOW|{!! $jpost->jobpost_position !!}|{{url('employer/show/'.$jpost->id)}},{{csrf_token()}}" href="" data-toggle="tooltip" data-placement="top" title="Open Post">
                          <i class="fa fa-eye"></i> Post
                        </a> 
                      @endif 
                    @endif
                  </div>  
                  <a class="applBTN btn-group float-right mt-sm-3" href="{{url('employer/applicant/'.$jpost->jobpost_position.'/'.encrypt($jpost->id))}}"> 
                      <span class="btn btn-outline-primary btn-sm disabled">
                          Applicants
                      </span> 
                      <span class="btn btn-primary btn-sm">
                        {{$total_Appl}}
                      </span> 
                  </a>
                </span>
                <h4 class="d-inline text-uppercase">{!! $jpost->jobpost_position !!}</h4>
                <div class="d-inline">   
                  <a href="" class="text-dark" data-toggle="tooltip" data-placement="top" title="Copy URL">
                    <i class="fa fa-copy"></i>
                  </a>   
                </div>
              </div>
              <div class="col-sm col-md">
                <h6><i class="fa fa-map-marker-alt"></i>&nbsp;
                {!! $jpost->jobpost_loc_city !!}, {!! $jpost->jobpost_loc_state !!}
                </h6>
              </div> 
              <div class="col-sm col-md">
                <h6>
                  <i class="fa fa-tag"></i>&nbsp;
                  {!!$jpost->jobpost_field_study!!} - {!!$jpost->jobpost_emp_type!!}
                </h6>
              </div>
              <div class="col-sm col-md small"> 
                <div class="row">
                  <span class="col-sm-2"><i class="fa fa-calendar-alt"></i>&nbsp;
                    Start date on {{date('M d, Y', strtotime($jpost->jobpost_startDate))}}
                  </span> 
                  <span class="col-sm-8"><i class="fa fa-calendar-alt"></i>&nbsp;
                    End date on {{date('M d, Y', strtotime($jpost->jobpost_endDate))}}
                  </span>  
                  <span class="col-sm-2 text-sm-right">Job status:&nbsp;
                    @if($jpost->jobpost_status == 'R')
                      <font color="orange">Pending</font>
                    @elseif($jpost->jobpost_status == 'A')
                      <font color="green">Approved</font>
                    @elseif($jpost->jobpost_status == 'E')
                      <font color="red">Expired</font>
                    @endif 
                    
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> 
      <hr> 
      @endforeach 
      <nav aria-label="pagination" class="mt-2 d-flex justify-content-center">
          {{ $jposts->links('vendor.pagination.bootstrap-4') }}
      </nav>  
      @else 
      <div class="row justify-content-center vertical-center mb-5"> 
        <div class="col-sm mb-5">
          <p>No job found.</p>
        </div>
      </div>
      @endif 
    </div> 
  </div>
</main> 
<!-- Footer -->  
@include('includes.footer')   
 