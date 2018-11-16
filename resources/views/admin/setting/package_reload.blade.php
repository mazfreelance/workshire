@extends('layouts.master_admin')

@section('title', 'Setting | Package Topup Reload')

@section('content') 
<div class="content-wrapper">
        <!-- Container-fluid starts -->
       <div class="container-fluid">
        <!-- Row Starts -->
        <div class="row">
            <div class="col-sm-12 p-0">
                <div class="main-header">
                    <h4>Setting | Package Topup Reload</h4>
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="icofont icofont-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="">User Setting</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('admin.package_reload')}}">List of Package Topup Reload</a>
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
                    	Setting for package topup&#39;s {{$employers->emp_name}}
                    </div>  
                    <div class="card-block">
                        <div class="row">
                            <div class="col-sm-12 table-responsive"> 
                                <button type="button" class="btn btn-danger waves-effect waves-light d-block" style="margin-bottom:1em" onClick="location.href='{{route('admin.package_employer')}}?employer_name={{$employers->emp_name}}'">
                                   <i class="icofont icofont-arrow-left"></i>
                                     <span class="m-l-10">Back to employer list</span>
                                 </button>

                                @if($tokenRs)
                                <button type="button" class="btn btn-primary waves-effect waves-light" style="margin-bottom:1em">
                                   <i class="icofont icofont-refresh"></i>
                                     <span class="m-l-10">Reload Resume Token</span>
                                 </button>  
                                <table class="table table-hover table-bordered table-striped"> 
                                    <thead class="table-inverse">
                                        <tr>
                                            <th>Package</th>
                                            <th>Current Balance</th> 
                                            <th>Subscribe Date</th> 
                                            <th>Expired Date</th>  
                                            <th>Status</th> 
                                        </tr>
                                    </thead>
                                    <tbody>     
                                        <tr>
                                            <td>{{$tokenRs->package_plan}}</td>
                                            <td>{{$tokenRs->balance}}</td>
                                            <td>{{date('M d, Y' , strtotime($tokenRs->subscribe_date))}}</td>
                                            <td>{{date('M d, Y' , strtotime($tokenRs->expired_date))}}</td>
                                            <td>
                                                @if(date('Y-m-d') < $tokenRs->expired_date)
                                                    <div class="label-main">
                                                        <label class="label bg-success">Active</label>
                                                    </div>
                                                @else 
                                                    <div class="label-main">
                                                        <label class="label bg-danger">Expired</label>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>   
                                @endif
                                
                                @if($tokenPs)
                                <button type="button" class="btn btn-primary waves-effect waves-light" style="margin-bottom:1em">
                                   <i class="icofont icofont-refresh"></i>
                                     <span class="m-l-10">Reload Job Post Token</span>
                                 </button>  
                                <table class="table table-hover table-bordered table-striped"> 
                                    <thead class="table-inverse">
                                        <tr>
                                            <th>Package</th>
                                            <th>Current Balance</th> 
                                            <th>Subscribe Date</th> 
                                            <th>Expired Date</th>  
                                            <th>Status</th> 
                                        </tr>
                                    </thead>
                                    <tbody>     
                                        <tr> 
                                            <td>{{$tokenPs->package_plan}}</td>
                                            <td>{{$tokenPs->balance}}</td>
                                            <td>{{date('M d, Y' , strtotime($tokenPs->subscribe_date))}}</td>
                                            <td>{{date('M d, Y' , strtotime($tokenPs->expired_date))}}</td>
                                            <td>
                                                @if(date('Y-m-d') < $tokenPs->expired_date)
                                                    <div class="label-main">
                                                        <label class="label bg-success">Active</label>
                                                    </div>
                                                @else 
                                                    <div class="label-main">
                                                        <label class="label bg-danger">Expired</label>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>  
                                @endif
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
<script>
$(function () {    
     
});
</script>
@endsection

@endsection