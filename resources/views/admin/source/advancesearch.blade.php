@extends('layouts.master_admin')

@section('title', 'Setting | Search Data ')

@section('content') 
<div class="content-wrapper">
        <!-- Container-fluid starts -->
       <div class="container-fluid">
        <!-- Row Starts -->
        <div class="row">
            <div class="col-sm-12 p-0">
                <div class="main-header">
                    <h4>Setting | Search Data </h4>
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="icofont icofont-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="">Sourcing</a>
                        </li>
                        <li class="breadcrumb-item"><a href="">Search Data</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- Row end -->
        <!-- Row content -->
        <div class="row">
            <div class="col-md-12">  

                @if(session('success'))
                <div class="alert alert-success" role="alert">
                  {{ session('success') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                @endif

        		<!-- Col content-2 --> 
				    <div class="card">
              <div class="card-header">
              	Setting for search data list
              </div>  
              <div class="card-block"> 
                  {!! Form::open(['route'=> 'admin.postadvancesearch', 'id'=>'dd-form']) !!}  
                    <table class="table table-bordered">
                      <tr>
                        <th>Gender</th>
                        <td>
                          <select id="dd-gender" name="dd-gender" class="custom-select form-control-sm border-dark">
                            <option value="" selected>All</option>
                            <option value="M" 
                            {{isset($req) ? $req['dd-gender'] == 'M'? 'selected': '' : ''}}>Male</option>
                            <option value="F" 
                            {{isset($req) ? $req['dd-gender'] == 'F'? 'selected': '' : ''}}>Female</option>
                          </select>
                        </td>
                        <th>Age</th>
                        <td>
                          @php
                          $age = \App\Model\job_seeker::selectRaw('distinct(YEAR(CURRENT_TIMESTAMP) - YEAR(seeker_DOB)) as age')
                                                      ->orderby('age', 'ASC')->get();
                          @endphp
                          <select id="dd-agefirst" name="dd-agefirst" class="custom-select form-control-sm  col-sm-3 border-dark">
                            <option value="" selected>All</option>
                            @foreach($age as $ages)
                            <option value="{{$ages['age']}}">{{$ages['age']}}</option>
                            @endforeach
                          </select>
                          <div class="col-sm-3">between</div>
                          <select id="dd-agelast" name="dd-agelast" class="custom-select form-control-sm  col-sm-3 border-dark">
                            <option value="" selected>All</option>
                            @foreach($age as $ages)
                            <option value="{{$ages['age']}}">{{$ages['age']}}</option>
                            @endforeach
                          </select>
                        </td>
                      </tr>
                      <tr>
                        <th>State</th>
                        <td>
                          <select id="dd-state" name="dd-state" class="custom-select form-control-sm border-dark">
                            <option value="" selected>All</option>
                            @foreach($state_array as $state)
                              <option value="{{$state->state_name}}">{{$state->state_name}}</option>
                            @endforeach
                          </select>
                        </td>
                        <th rowspan="2"><br/>Year of Experience</th>
                        <td rowspan="2"><br/>
                          @php
                          $exp = \App\Model\job_seeker::selectRaw('distinct(seeker_noYrsExp) as exp')
                                                      ->orderby('exp', 'ASC')->get();
                          @endphp
                          <select id="dd-yoefirst" name="dd-yoefirst" class="custom-select form-control-sm  col-sm-3 border-dark">
                            <option value="" selected>All</option>
                            @foreach($exp as $exps)
                            <option value="{{$exps['exp']}}">{{$exps['exp']}}</option>
                            @endforeach
                          </select>
                          <div class="col-sm-3">between</div>
                          <select id="dd-yoelast" name="dd-yoelast" class="custom-select form-control-sm  col-sm-3 border-dark">
                            <option value="" selected>All</option>
                            @foreach($exp as $exps)
                            <option value="{{$exps['exp']}}">{{$exps['exp']}}</option>
                            @endforeach
                          </select>
                        </td>
                      </tr>
                      <tr>
                        <th>City</th>
                        <td>
                          <input id="dd-city" name="dd-city" type="text" placeholder="City Name" 
                          class="rounded col-lg-7 form-control form-control-sm border-dark" value="{{isset($req)? $req['dd-city'] :''}}">
                        </td> 
                      </tr>
                      <tr> 
                        <th>Education level</th>
                        <td>
                          <select id="dd-edulev" name="dd-edulev" class="custom-select form-control-sm  col-sm-7 border-dark">
                            <option value="" selected>All</option>
                            @php
                            $edulvls = array('SPM' => 'SPM', 'STPM' => 'STPM', 'Diploma' => 'Diploma', 'Degree' => 'Bachelor Degree', 'Master' => 'Master Degree', 'PHD' => 'PHD');
                            @endphp
                            @foreach($edulvls as $key => $edulvl)
                              <option value="{{$key}}">{{$edulvl}}</option>
                            @endforeach
                          </select>
                        </td>
                        <th>Institution</th>
                        <td>
                          <input id="dd-institution" name="dd-institution" type="text" placeholder="Institution Name" class="rounded input-sm form-control col-sm-7 border-dark">
                        </td> 
                      </tr>
                      <tr>
                        <th>Field of Study</th>
                        <td colspan="3">
                          <select id="dd-fos" name="dd-fos" class="custom-select form-control-sm col-sm-7 border-dark">
                            <option value="" selected>All</option>
                            @foreach($fos as $fosdtl)
                              <option value="{{$fosdtl->category_Name}}" 
                              {{isset($req)? $req['dd-fos'] == $fosdtl->category_Name? 'selected':'' :''}}>
                              {{$fosdtl->category_Name}}</option>
                            @endforeach
                          </select>

                          <br/><br/>

                          <input id="dd-fos2" name="dd-fos2" type="text" placeholder="Field of study others" class="rounded form-control form-control-sm col-sm-7 border-dark" value="{{isset($req)? $req['dd-fos2'] :''}}">
                        </td> 
                      </tr>
                      <tr>
                        <td colspan="4">
                          <button type="submit" id="dd-submit" class="rounded btn btn-sm btn-primary">Search</button>
                        </td> 
                      </tr>
                    </table>
                  </div>
                  {!! Form::close() !!}
                  
                  @if(!isset($req)) <h5 class="container">Total Seeker: {{$seeker->total()}}</h5>@endif
                  <div class="table-responsive">
                    <table class="table table-inverse table-bordered table-hover" id="table_not" style="width:100%;">
                      <thead class="bg-primary"> 
                          <th>Sign up</th>
                          <th>Name</th>
                          <th>Address</th> 
                          <th>DOB</th>
                          <th>I/C No.</th>
                          <th>Phone No.</th>
                          <th>Education</th>
                          <th>Course (Major)</th>
                          <th>Achievement</th>
                          <th>School</th>
                          <th>Resume</th>
                      </thead>
                      <tbody>
                          @foreach($seeker as $seek)
                          @php
                            $fosReq='';$institute='';
                            $institute = isset($req)? $req['dd-institution']:'';
                            if(isset($req)){
                              if($req['dd-fos']  != '' or $req['dd-fos2']  != '') 
                                $fosReq = $req['dd-fos']  != ''? $req['dd-fos']:$req['dd-fos2'];
                            } 
                            $edus = \App\Model\JobSeeker_Education::whereRaw('level = '. 1)
                                                                  ->whereRaw('field_of_study LIKE "%'.$fosReq.'%"')
                                                                  ->whereRaw('institute LIKE "%'.$institute.'%"')
                                                                  ->get();
                            $resume = \App\Model\Resume::where('seeker_id', '=', $seek->id)->first();    
                          @endphp

                          
                          @foreach($edus as $edu)
                            @if($edu->seeker_id == $seek->id)
                          <tr>
                            <td>{{ date('M d, Y - H:i a', strtotime($seek->created_at)) }}</td>
                            <td>{{ $seek->seeker_name }}</td>
                            <td>{{ $seek->seeker_state }}</td>
                            <td>{{ date('M d, Y', strtotime($seek->seeker_DOB)) }}</td>
                            <td>{{ $seek->seeker_nric }}</td>
                            <td>{{ $seek->seeker_ctc_tel1 }}</td>
                            
                            <td>{{ $edu['highest_education'] }}</td>
                            <td>{{ $edu['field_of_study'] }} {{ $edu['major_study'] != '' ? '('.$edu['major_study'].')': '' }}</td>
                            <td>{{ $edu['grade_achievement'] }}</td>
                            <td>{{ $edu['institute'] }}</td>
                            
                            <td>
                              @if($resume['resume_loc'] != '')
                                <a href="{{ asset('public/document/uploadsCV').'/'.$resume['resume_loc'] }}" target="_blank">Resume</a>
                              @endif
                            </td>
                          </tr>
                            @endif
                          @endforeach

                          @endforeach
                      </tbody>
                    </table>

                    <nav aria-label="pagination" class="mt-2 d-flex justify-content-center">
                        {{-- $seeker->links('vendor.pagination.bootstrap-4') --}}
                    </nav>  
                  </div>
              </div>  
            </div> 
  			    <!-- Col content-2 end-->
        </div>
        <!-- Row content end -->
    </div>
    <!-- Container-fluid ends -->
</div>
@section('css')
<style>

</style>
@endsection
@section('js')
<script src="{{ asset('public/js/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('public/js/ckeditor/adapters/jquery.js') }}"></script>
<script> 
$(document).ready(function() {
    @if(isset($editapproval)) $('#editjobapproval').modal('show'); @endif
    @if(isset($editjob)) $('#editjob').modal('show'); @endif

    $('#desc_job').ckeditor();
    $('#desc_scopejob').ckeditor();
});
</script>
@endsection

@endsection