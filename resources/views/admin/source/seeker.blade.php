@extends('layouts.master_admin')

@section('title', 'Seeker')

@section('content')  
<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
<div class="content-wrapper">
        <!-- Container-fluid starts -->
       <div class="container-fluid">
        <!-- Row Starts -->
        <div class="row">
            <div class="col-sm-12 p-0">
                <div class="main-header">
                    <h4>No. of Seeker</h4>
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="icofont icofont-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="">Seeker</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- Row end -->
        <!-- Row content -->
        <div class="row">
            <div class="col-md-12">  
        		<!-- Col content-2 --> 
				<div class="card">
                    <div class="card-header">
                    	Seeker
                    </div>  
                    <div class="card-block">
                        <div class="row">
                            <div class="col-sm-12 table-responsive">
                                @if (session('Success'))
                                    <div class="alert alert-success">
                                        {{ session('Success') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif


                                @if (session('Error'))
                                    <div class="alert alert-danger">
                                        {{ session('Error') }} 
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif


                                <h5>Admin User</h5>
                                <button type="button" class="btn btn-primary waves-effect waves-light" style="margin-bottom:1em" 
                                id="addEmail">
                                   <i class="icofont icofont-plus"></i>
                                     <span class="m-l-10">
                                        {{isset($editEmail) ? 'Edit ': 'Add'}}
                                        User
                                    </span>
                                </button>

                                <div class="modal fade" id="addEmailModal" tabindex="-1" role="dialog" 
                                aria-labelledby="addEmailModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">{{isset($editEmail) ? 'Update existing ': 'Add new'}} user</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body"> 
                                            @if(isset($editEmail))
                                                {!! Form::model($editEmail,['method'=>'put','id'=>'frm']) !!}
                                            @else
                                                {{ Form::open(array('route' => 'admin.create_user')) }}  
                                            @endif   
                                                <div class="form-group row">
                                                    <label for="h-name" class="col-md-2 col-form-label form-control-label">Name</label>
                                                    <div class="col-md-10">
                                                        <input type="text" id="name" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name" value="{{isset($editEmail) ?$editEmail->name : old('name') }}">

                                                        @if ($errors->has('name'))
                                                            <span class="invalid-feedback text-danger" role="alert">
                                                                <strong>{!! $errors->first('name') !!}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div> 

                                                <div class="form-group row">
                                                    <label for="h-email" class="col-md-2 col-form-label form-control-label">Email</label>
                                                    <div class="col-md-10">
                                                        <input type="text" id="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email" value="{{isset($editEmail) ?$editEmail->email : old('email') }}">

                                                        @if ($errors->has('email'))
                                                            <span class="invalid-feedback text-danger" role="alert">
                                                                <strong>{!! $errors->first('email') !!}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div> 
                                                 
                                                <div class="form-group row">
                                                    <label for="h-password" class="col-md-2 col-form-label form-control-label">Password</label>
                                                    <div class="col-md-10">
                                                        <input id="password" name="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password"> 

                                                        @if ($errors->has('password'))
                                                            <span class="invalid-feedback text-danger" role="alert">
                                                                <strong>{!! $errors->first('password') !!}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>  

                                                <div class="form-group row">
                                                    <label for="h-password" class="col-md-2 col-form-label form-control-label">Confirm Password</label>
                                                    <div class="col-md-10">
                                                        <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" placeholder="Password">
                                                    </div>
                                                </div>  
                                                 
                                                <div class="form-group row">
                                                    <div class="col-md-9">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                            {{isset($editEmail) ? 'Save ': 'Add'}}
                                                        </button>
                                                    </div>
                                                </div>
                                             {{ Form::close() }}   
                                            </div> 
                                        </div>
                                    </div>
                                </div>

                                <table class="table table-hover table-bordered table-striped" id="myTable"> 
                                    <thead class="table-inverse">
                                        <tr>
                                            <th>Sign Up</th> 
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
                                        </tr>
                                    </thead>
                                    <tbody>   
                                        @php $i=1 @endphp 
                                        @php
                                        /*
                                        @foreach($seeks as $seek)
                                        <tr>
                                            <td class="w-25">{{$i++}}</td> 
                                            <td>{{date('d/M/y H:i:s a', strtotime($seek->created_at))}}</td>
                                            <td>{{$seek->seeker_name}}</td>
                                            <td>{{$seek->seeker_state}}</td>
                                            <td>{{date('d/M/y', strtotime($seek->seeker_DOB))}}</td>
                                            <td>{{$seek->seeker_name}}</td>
                                            <td>{{$seek->seeker_nric}}</td>
                                            <td>
                                            	{{$seek->education[0]->highest_education}}
                                            </td>
                                            <td>
                                            	{{$seek->education[0]->field_of_study}} ({{$seek->education[0]->major_study}}) 
                                            </td>
                                            <td>
                                            	{{$seek->education[0]->grade_achievement}}
                                            </td>
                                            <td>
                                            	{{$seek->education[0]->institute}}
                                            </td>
                                            <td>
                                            	@if(isset($seek->resume))  
                                            	<a href="{{ route('resume', ['id'=>$seek->resume->resume_loc]) }}" target="_blank">Resume</a>
                                            	@endif
                                            </td>
                                        </tr>  
                                        @endforeach 
                                        */
                                        @endphp
                                    </tbody>
                                </table>
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
<script type="text/javascript" src="{{ asset('public/js/custom/dataTables.min.js') }}"></script>
<script>
$(function () {       
    //$('#myTable').DataTable();
    $('#myTable').DataTable({

        processing: true,

        serverSide: true,

        ajax: '{!! route('admin.seeker_getData') !!}',

        columns: [ 

            { data: 'created_at', name: 'job_seekers.created_at' },

            { data: 'seeker_name', name: 'job_seekers.seeker_name' },

            { data: 'seeker_state', name: 'job_seekers.seeker_state' },

            { data: 'seeker_DOB', name: 'job_seekers.seeker_DOB' },

            { data: 'seeker_nric', name: 'job_seekers.seeker_nric' }, 

            { data: 'seeker_ctc_tel1', name: 'job_seekers.seeker_ctc_tel1' },

            { data: 'highest_education', name: 'job_seeker_education.highest_education' }, 
            
            { data: 'field_of_study', name: 'job_seeker_education.field_of_study' },

            { data: 'grade_achievement', name: 'job_seeker_education.grade_achievement' },

            { data: 'institute', name: 'job_seeker_education.institute' },

            { data: 'resume_loc', name: 'job_seeker_education.resume_loc' },










        ]

    });
});
</script>
@endsection

@endsection