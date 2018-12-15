@extends('layouts.master_admin')

@section('title', 'Numbers')

@section('content')  
<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
<div class="content-wrapper">
        <!-- Container-fluid starts -->
       <div class="container-fluid">
        <!-- Row Starts -->
        <div class="row">
            <div class="col-sm-12 p-0">
                <div class="main-header">
                    <h4>Numbers</h4>
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="icofont icofont-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="">Sourcing</a></li>
                        <li class="breadcrumb-item"><a href="">Numbers</a>
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
                        {!! Form::open(['route'=> 'admin.postadvancesearch', 'id'=>'dd-form']) !!}  
                        <table class="table table-bordered">
                          <tr>
                            <th>Date From</th>
                            <td>
                              <input class="form-control" type="date" name="datefrom" value="" />
                            </td>
                            <th>Date To</th>
                            <td>
                              <input class="form-control" type="date" name="dateto" value="" />
                            </td>
                          </tr>
                        </table>  
                        {!! Form::close() !!}
                        <div class="row container">
                            <div class="col-sm-4 bg-primary">Duration</div>
                            <div class="col-sm"></div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-sm-12 table-responsive">  
                                <table class="table table-hover table-bordered table-striped" id="myTable">
                                    <tr>
                                        <th width="150">Seeker</th>
                                        <td width="450"></td>
                                    </tr>  
                                    <tr>
                                        <th>Employer</th>
                                        <td></td>
                                    </tr>  
                                    <tr>
                                        <th>Resume Access</th>
                                        <td></td>
                                    </tr>  
                                    <tr>
                                        <th>Job Posting Access</th>
                                        <td></td>
                                    </tr> 
                                    <tr>
                                        <th>Job Applicants</th>
                                        <td></td>
                                    </tr> 
                                    <tr>
                                        <th>Login</th>
                                        <td></td>
                                    </tr> 
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

});
</script>
@endsection

@endsection