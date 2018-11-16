@extends('layouts.master_admin')

@section('title', 'Setting | Mail')

@section('content') 
<div class="content-wrapper">
        <!-- Container-fluid starts -->
       <div class="container-fluid">
        <!-- Row Starts -->
        <div class="row">
            <div class="col-sm-12 p-0">
                <div class="main-header">
                    <h4>Setting | Mail</h4>
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="icofont icofont-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="">User Setting</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('admin.mail')}}">Mail</a>
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
                    	Setting for Simple Mail Transfer Protocol (SMTP)
                    </div>  
                    <div class="card-block">
                        <div class="row">
                            <div class="col-sm-12 table-responsive">
                                <h5>Default Email</h5>
                                <button type="button" class="btn btn-primary waves-effect waves-light" style="margin-bottom:1em">
                                   <i class="icofont icofont-edit"></i>
                                     <span class="m-l-10">Edit default</span>
                                 </button>

                                <table class="table table-hover table-striped"> 
                                    <tbody>  
                                        <tr>
                                            <th class="table-inverse  w-25 nowrap">MAIL DRIVER</th>
                                            <td class="w-100 nowrap">smtp</td>
                                        </tr>
                                        <tr>
                                            <th class="table-inverse  w-25 nowrap">MAIL HOST</th>
                                            <td class="w-100 nowrap"></td>
                                        </tr>
                                        <tr>
                                            <th class="table-inverse  w-25 nowrap">MAIL PORT</th>
                                            <td class="w-100 nowrap"></td>
                                        </tr>
                                        <tr>
                                            <th class="table-inverse  w-25 nowrap">MAIL FROM ADDRESS</th>
                                            <td class="w-100 nowrap">noreply@workshire.com.my</td>
                                        </tr>
                                        <tr>
                                            <th class="table-inverse  w-25 nowrap">MAIL FROM NAME</th>
                                            <td class="w-100 nowrap"></td>
                                        </tr>
                                        <tr>
                                            <th class="table-inverse  w-25 nowrap">MAIL ENCRYPTION</th>
                                            <td class="w-100 nowrap"></td>
                                        </tr>
                                        <tr>
                                            <th class="table-inverse  w-25 nowrap">MAIL USERNAME</th>
                                            <td class="w-100 nowrap"></td>
                                        </tr>
                                        <tr>
                                            <th class="table-inverse  w-25 nowrap">MAIL PASSWORD</th>
                                            <td class="w-100 nowrap"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-12 table-responsive">
                                <h5>Email CC</h5>
                                <button type="button" class="btn btn-primary waves-effect waves-light" style="margin-bottom:1em">
                                   <i class="icofont icofont-plus"></i>
                                     <span class="m-l-10">Add CC</span>
                                </button>

                                <table class="table table-hover table-bordered table-striped"> 
                                    <thead class="table-inverse">
                                        <tr>
                                            <th>No.</th>
                                            <th>Email</th> 
                                            <th>Action</th> 
                                        </tr>
                                    </thead>
                                    <tbody>   
                                        <tr>
                                            <td class="w-25">1</td>
                                            <td class="w-50"> 
                                                <div class="label-main">
                                                    <label class="label-lg bg-primary text-lowercase">Bedah@workshire.com.my</label>
                                                </div>
                                                <p>Bedah</p>
                                            </td> 
                                            <td class="w-25 text-center">
                                                <button class="btn btn-flat flat-info txt-info waves-effect waves-light">Edit</button>
                                                <button class="btn btn-flat flat-danger txt-danger waves-effect waves-light">Delete</button> 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="w-25">1</td>
                                            <td class="w-50"> 
                                                <div class="label-main">
                                                    <label class="label-lg bg-primary text-lowercase">Bedah@workshire.com.my</label>
                                                </div>
                                                <p>Bedah</p>
                                            </td> 
                                            <td class="w-25 text-center">
                                                <button class="btn btn-flat flat-info txt-info waves-effect waves-light">Edit</button>
                                                <button class="btn btn-flat flat-danger txt-danger waves-effect waves-light">Delete</button> 
                                            </td>
                                        </tr>
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
<script>
$(function () {    
     
});
</script>
@endsection

@endsection