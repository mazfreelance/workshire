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
                                            <th>Course</th>
                                            <th>Major</th>
                                            <th>Achievement</th> 
                                            <th>School</th>
                                            <th>Resume</th>  
                                        </tr>
                                    </thead> 
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

            { data: 'major_study', name: 'job_seeker_education.major_study' },

            { data: 'grade_achievement', name: 'job_seeker_education.grade_achievement' },

            { data: 'institute', name: 'job_seeker_education.institute' },

            { data: 'resume_loc', name: 'job_seeker_education.resume_loc' },










        ]

    });
});
</script>
@endsection

@endsection