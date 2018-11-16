@extends('layouts.master_admin')

@section('title', 'Setting | Package')

@section('content') 
<div class="content-wrapper">
        <!-- Container-fluid starts -->
       <div class="container-fluid">
        <!-- Row Starts -->
        <div class="row">
            <div class="col-sm-12 p-0">
                <div class="main-header">
                    <h4>Setting | Package</h4>
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="icofont icofont-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="">User Setting</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('admin.package')}}">List of Package</a>
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
                    	Setting for package list
                    </div>  
                    <div class="card-block">
                        <div class="row">
                            <div class="col-sm-12 table-responsive"> 
                                <button type="button" class="btn btn-primary waves-effect waves-light" style="margin-bottom:1em">
                                   <i class="icofont icofont-plus"></i>
                                     <span class="m-l-10">Add package</span>
                                 </button>
                                  
                                <table class="table table-hover table-bordered table-striped"> 
                                    <thead class="table-inverse">
                                        <tr>
                                            <th>Package</th>
                                            <th>Name</th> 
                                            <th>Amount</th> 
                                            <th>Count</th>  
                                            <th>Status<br/>(A-Active,<br/>NA-Non active)</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>   
                                        @foreach($pkgs as $pkg)
                                        <tr>
                                            <td class="w-50">{{$pkg->type.'|'.$pkg->id}}</td>
                                            <td class="w-50"> 
                                                 {{$pkg->description}}
                                            </td> 
                                            <td class="w-25"> 
                                                 {{$pkg->token_amount}}
                                            </td> 
                                            <td class="w-25"> 
                                                 {{$pkg->token_count}}
                                            </td> 
                                            <td class="w-25"> 
                                                 {{$pkg->status}}
                                            </td> 
                                            <td class="w-25 text-center">
                                                <button class="btn btn-flat flat-info txt-info waves-effect waves-light">Edit</button>
                                                <button class="btn btn-flat flat-danger txt-danger waves-effect waves-light">Delete</button> 
                                            </td>
                                        </tr> 
                                        @endforeach
                                    </tbody>
                                </table> 
                                <nav class="table-responsive" aria-label="pagination" style="margin-bottom:-1em">
                                    {{ $pkgs->links('vendor.pagination.bootstrap-4') }}
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
$(function () {    
     
});
</script>
@endsection

@endsection