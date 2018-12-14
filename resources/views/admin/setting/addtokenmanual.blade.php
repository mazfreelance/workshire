@extends('layouts.master_admin')

@section('title', 'Setting | Employer Token')

@section('content') 
<div class="content-wrapper">
        <!-- Container-fluid starts -->
       <div class="container-fluid">
        <!-- Row Starts -->
        <div class="row">
            <div class="col-sm-12 p-0">
                <div class="main-header">
                    <h4>Setting | Employer Token (Add Token Manual)</h4>
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="icofont icofont-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="">Customers</a>
                        </li>
                        <li class="breadcrumb-item"><a href="">Add Token Manual</a>
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
                    	Setting for employer token list
                    </div>  
                    <div class="card-block">
                        <div class="row">
                            <div class="col-sm-12 table-responsive"> 
                                 <div class="modal" tabindex="-1" role="dialog" id="editpackage">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Orders</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            
                                            @if(isset($editPkg))
                                            {!! Form::model($editPkg,['method'=>'put','id'=>'frm']) !!}
                                            @endif 

                                            <div class="modal-body">  
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1" class="form-control-label">Status</label>
                                                    <select class="form-control" name="status">
                                                        <option value="" selected disabled>Select status..</option>
                                                        <option value="pending" 
                                                        {{ isset($editPkg) ? $editPkg->status == 'pending'? 'selected':'' :''}}>
                                                        Pending</option>
                                                        <option value="Approved" 
                                                        {{ isset($editPkg) ? $editPkg->status == 'Approved'? 'selected':'' :''}}>
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


                                <table class="table table-hover table-bordered table-striped"> 
                                    <thead class="table-inverse">
                                        <tr> 
                                            <th>#</th> 
                                            <th>Detail</th> 
                                            <th>Product</th> 
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>   @php $i=1; @endphp
                                        @foreach($employer as $emp)
                                        @php 

                                        $jpost = \App\Model\EmployerTokenPost::where('employer_id', '=', $emp->id)->first();
                                        $rview = \App\Model\EmployerTokenResume::where('employer_id', '=', $emp->id)->first(); 
                                        @endphp
                                        <tr> 
                                            <td class="w-25">#{{ $rview->id }}</td>
                                            <td class="w-25">{{ $emp->emp_name }}</td> 
                                            <td class="w-25"> 
                                                 <table>
                                                    <tr>
                                                        <th>Package</th>
                                                        <td>
                                                            {{ $jpost->package_plan }} : Bal: {{ $jpost->package_plan == 'P|26'? 'Unlimited':$jpost->balance }}
                                                            <br/>
                                                            {{ $rview->package_plan }} - Bal: {{ $rview->package_plan == 'V|25'? 'Unlimited':$rview->balance }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Bought / Expired</th>
                                                        <td>
                                                            {{ $jpost->package_plan }} : Bought: {{ date('M, d Y', strtotime($jpost->subscribe_date)) }}
                                                            <br/>
                                                            {{ $rview->package_plan }} - Expired: {{ date('M, d Y', strtotime($rview->expired_date)) }}
                                                            <br/>
                                                            @if(date('Y-m-d') >= $jpost->expired_date AND date('Y-m-d') >= $rview->expired_date)
                                                            	<label class="badge badge-inverse-danger">Expired; Add Token Now</label>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>  
                                            <td class="w-25 text-center"> 
                                            	@php
                                            		$rpp = explode ('|', $rview->package_plan);
                                            		$jpp = explode ('|', $jpost->package_plan);
                                            	@endphp

                                                @if(date('Y-m-d') >= $jpost->expired_date AND date('Y-m-d') >= $rview->expired_date)
                                                    <button class="btn btn-flat flat-success txt-success waves-effect waves-light" 
                                                    onClick="location.href='{{ route('admin.add_token_manual', ['emp_id' => $emp->id, 'post_id' => $jpp[1], 'resume_id' => $rpp[1]]) }}'">
                                                    Add Token
                                                    </button>
                                                @else 
                                                    <button class="btn btn-flat flat-danger txt-danger waves-effect waves-light" disabled>
                                                    Add Token
                                                    </button>
                                                    <br/><span class="text-danger small">* Package not expired yet</span>
                                                @endif
                                            </td>
                                        </tr> 
                                        @endforeach
                                    </tbody>
                                </table> 
                                <nav class="table-responsive" aria-label="pagination" style="margin-bottom:-1em">
                                    {{ $employer->links('vendor.pagination.bootstrap-4') }}
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
<script> 
$(document).ready(function() {
    @if(isset($editPkg)) $('#editpackage').modal('show'); @endif
});
</script>
@endsection

@endsection