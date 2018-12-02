@extends('layouts.master_admin')

@section('title', 'Setting | User')

@section('content') 
<div class="content-wrapper">
        <!-- Container-fluid starts -->
       <div class="container-fluid">
        <!-- Row Starts -->
        <div class="row">
            <div class="col-sm-12 p-0">
                <div class="main-header">
                    <h4>Setting | User</h4>
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="icofont icofont-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="">User Setting</a>
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
                    	Setting for User
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

                                <table class="table table-hover table-bordered table-striped"> 
                                    <thead class="table-inverse">
                                        <tr>
                                            <th>No.</th>
                                            <th>Email</th> 
                                            <th>Class</th>
                                            <th>Action</th> 
                                        </tr>
                                    </thead>
                                    <tbody>   
                                        @php $i=1 @endphp 
                                        @foreach($user as $ej)
                                        <tr>
                                            <td class="w-25">{{$i++}}</td>
                                            <td class="w-50"> 
                                                <div class="label-main">
                                                    <label class="label-lg bg-primary text-lowercase">{{$ej->email}}</label>
                                                </div> 
                                                <p>{{$ej->name}}</p>
                                            </td> 
                                            <td class="w-25"> 
                                                <div class="label-main"> 
                                                    @if($ej->role_id == 3)
                                                    <label class="label bg-success">Owner</label>
                                                    @else
                                                    <label class="label bg-warning">Administrator</label> 
                                                    @endif
                                                </div> 
                                            </td>
                                            <td class="w-25 text-center">
                                                <button class="btn btn-flat flat-info txt-info waves-effect waves-light" 
                                                onClick="location.href='{{route('admin.delete_user', ['id' => $ej->id])}}'">
                                                    Edit
                                                </button>
                                                @if($ej->role_id !== 3) 
                                                <button class="btn btn-flat flat-danger txt-danger waves-effect waves-light" 
                                                onClick="location.href='{{route('admin.delete_user', ['id' => $ej->id])}}'">
                                                    Delete
                                                </button>  
                                                @endif
                                            </td>
                                        </tr>  
                                        @endforeach 
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
    $(document).on('click', '#addEmail', function(e){
        e.preventDefault();
        $('#addEmailModal').modal('show');
    });
    <?php if(isset($editEmail)){ ?>
        $('#addEmailModal').modal('show');
    <?php } ?>
});
</script>
@endsection

@endsection