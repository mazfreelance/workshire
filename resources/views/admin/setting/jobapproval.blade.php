@extends('layouts.master_admin')

@section('title', 'Setting | Job Approval')

@section('content') 
<div class="content-wrapper">
        <!-- Container-fluid starts -->
       <div class="container-fluid">
        <!-- Row Starts -->
        <div class="row">
            <div class="col-sm-12 p-0">
                <div class="main-header">
                    <h4>Setting | Employer Job Approval</h4>
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="icofont icofont-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="">Customers</a>
                        </li>
                        <li class="breadcrumb-item"><a href="">Job Approval</a>
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
                    	Setting for employer job approval list
                    </div>  
                    <div class="card-block">
                        <div class="row">
                            <div class="col-sm-12 table-responsive"> 

                                 
                                 <div class="modal" tabindex="-1" role="dialog" id="editjobapproval">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Job Approval</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            
                                            @if(isset($editapproval))
                                            {!! Form::model($editapproval,['method'=>'put','id'=>'frm']) !!}
                                            @endif 

                                            <div class="modal-body">  
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1" class="form-control-label">Status</label>
                                                    <select class="form-control" name="status">
                                                        <option value="" selected disabled>Select status..</option>
                                                        <option value="R" 
                                                        {{ isset($editapproval) ? $editapproval->jobpost_status == 'R'? 'selected':'' :''}}>
                                                        Pending</option>
                                                        <option value="X" 
                                                        {{ isset($editapproval) ? $editapproval->jobpost_status == 'A'? 'selected':'' :''}}>
                                                        Action Require / Reject</option>
                                                        <option value="E" 
                                                        {{ isset($editapproval) ? $editapproval->jobpost_status == 'A'? 'selected':'' :''}}>
                                                        Expired</option>
                                                        <option value="A" 
                                                        {{ isset($editapproval) ? $editapproval->jobpost_status == 'A'? 'selected':'' :''}}>
                                                        Approve</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="modal" tabindex="-1" role="dialog" id="editjob">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Job Editable</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            
                                            @if(isset($editjob))
                                            {!! Form::model($editjob,['method'=>'put','id'=>'frm']) !!}
                                            @endif 

                                            <div class="modal-body">  
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1" class="form-control-label">Description</label>
                                                    <textarea class="form-control" name="job_description" id="desc_job">{!!isset($editjob)? $editjob->jobpost_desc:''!!}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1" class="form-control-label">Detail scope</label>
                                                    <textarea class="form-control" name="job_scope" id="desc_scopejob">{!!isset($editjob)? $editjob->jobpost_exp:''!!}</textarea> 
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>


                                <table class="table table-hover table-bordered table-striped"> 
                                    <thead class="table-inverse">
                                        <tr> 
                                            <th>#</th> 
                                            <th>Employer / Company</th> 
                                            <th>Job Detail</th> 
                                            <th>Job Description</th> 
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>   @php $i=1; @endphp
                                        @foreach($jobPost as $jp)
                                        @php 

                                        $employer = \App\Model\employer::find($jp->jobpost_employer);
                                        $jpost = \App\Model\EmployerTokenPost::where('employer_id', '=', $jp->jobpost_employer)->first();
                                        $rview = \App\Model\EmployerTokenResume::where('employer_id', '=', $jp->jobpost_employer)->first(); 
                                        @endphp
                                        <tr> 
                                            <td class="w-25">#{{ $jp->id }}</td>
                                            <td class="w-25">{{ $employer->emp_name }}</td> 
                                            <td class="w-25"> 
                                                <table>
                                                    <tr>
                                                        <th>Job Status</th>
                                                        <td>
                                                            @if($jp->jobpost_status == 'R')
                                                                <label class="badge badge-inverse-warning">Pending</label>
                                                            @elseif($jp->jobpost_status == 'X')
                                                                <label class="badge badge-inverse-info">Action Require / Reject</label>
                                                            @elseif($jp->jobpost_status == 'E')
                                                                <label class="badge badge-inverse-danger">Expired</label>
                                                            @elseif($jp->jobpost_status == 'A')
                                                                <label class="badge badge-inverse-success">Approved</label>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Position</th>
                                                        <td>
                                                            {{ $jp->jobpost_position }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Level</th>
                                                        <td>
                                                            {{ $jp->jobpost_position_level }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Vacancy</th>
                                                        <td>
                                                            {{ $jp->job_noofvacancy }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Employment type</th>
                                                        <td>
                                                            {{ $jp->jobpost_emp_type }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Category</th>
                                                        <td>
                                                            {{ $jp->jobpost_field_study }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Location</th>
                                                        <td>
                                                            {{ $jp->jobpost_loc_city.', '.$jp->jobpost_loc_state }}
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>  
                                            <td class="w-25">
                                                <table>
                                                    <tr>
                                                        <th>Start / Expired</th>
                                                        <td>
                                                            Start : {{ date('M d, Y', strtotime($jp->jobpost_startDate)) }}

                                                            <br/>

                                                            Expired : {{ date('M d, Y', strtotime($jp->jobpost_endDate)) }}
                                                        </td>
                                                    </tr>
                                                </table> 
                                                <h5>Description</h5>
                                                {!!htmlspecialchars_decode(stripslashes($jp->jobpost_desc))!!}
                                                <br/> 
                                                <h6>Detail scope</h6>
                                                <ul style="list-style:none;"> 
                                                    @if($jp->jobpost_exp != '')
                                                    <li class="ml-3 text-justify">
                                                        {!!htmlspecialchars_decode(stripslashes($jp->jobpost_exp))!!}   
                                                    </li>  
                                                    @endif
                                                    @if($jp->jobpost_allowance != '')
                                                    <li class="ml-3">
                                                        Allowances: {!!htmlspecialchars_decode(stripslashes($jp->jobpost_allowance))!!} 
                                                    </li>  
                                                    @endif
                                                    @if($jp->jobpost_skill != '')
                                                    <li class="ml-3">
                                                        Skills: {!!htmlspecialchars_decode(stripslashes($jp->jobpost_skill))!!} 
                                                    </li>  
                                                    @endif
                                                    @if($jp->jobpost_education != '')
                                                    <li class="ml-3">
                                                        Education level: {!!htmlspecialchars_decode(stripslashes($jp->jobpost_education))!!} 
                                                    </li> 
                                                    @endif
                                                    @if($jp->jobpost_field_study != '')
                                                    <li class="ml-3">
                                                        Field of study: {!!htmlspecialchars_decode(stripslashes($jp->jobpost_field_study))!!} 
                                                    </li>
                                                    @endif
                                                    @if($jp->jobpost_years_exp != '')
                                                    <li class="ml-3">
                                                        No. of years: {!!htmlspecialchars_decode(stripslashes($jp->jobpost_years_exp))!!} 
                                                    </li>
                                                    @endif 
                                                </ul> 
                                            </td>  
                                            <td class="w-25 text-center"> 
                                            	@php
                                            		//$rpp = explode ('|', $rview->package_plan);
                                            		//$jpp = explode ('|', $jpost->package_plan);
                                            	@endphp
                                                <button class="btn btn-flat flat-success txt-success waves-effect waves-light" 
                                                onClick="location.href='{{ route('admin.update_jobposting', ['id' => $jp->id]) }}'">
                                                Edit Jobpost
                                                </button> 
                                                <br/><br/>
                                                <button class="btn btn-flat flat-primary txt-primary waves-effect waves-light" onClick="location.href='{{ route('admin.update_jobapproval', ['id' => $jp->id]) }}'">
                                                Job Approval
                                                </button> 
                                            </td>
                                        </tr> 
                                        @endforeach
                                    </tbody>
                                </table> 
                                <nav class="table-responsive" aria-label="pagination" style="margin-bottom:-1em">
                                    {{ $jobPost->links('vendor.pagination.bootstrap-4') }}
                                </nav> 
                            </div> 
                        </div>

                    </div>
                </div> 
    			<!-- Col content-2 end-->
            </div>
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