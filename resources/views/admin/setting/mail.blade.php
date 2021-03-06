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


                                <h5>Email CC</h5>
                                <button type="button" class="btn btn-primary waves-effect waves-light" style="margin-bottom:1em" 
                                id="addEmail">
                                   <i class="icofont icofont-plus"></i>
                                     <span class="m-l-10">
                                        {{isset($editEmail) ? 'Edit ': 'Add'}}
                                        E-mail
                                    </span>
                                </button>

                                <div class="modal fade" id="addEmailModal" tabindex="-1" role="dialog" 
                                aria-labelledby="addEmailModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">{{isset($editEmail) ? 'Update existing ': 'Add new'}} email</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body"> 
                                            @if(isset($editEmail))
                                                {!! Form::model($editEmail,['method'=>'put','id'=>'frm']) !!}
                                            @else
                                                {{ Form::open(array('route' => 'admin.post')) }}  
                                            @endif 
                                                <div class="form-group row">
                                                    <label for="h-email" class="col-md-2 col-form-label form-control-label">
                                                        Notification Email
                                                    </label>
                                                    <div class="col-md-10"> 
                                                        <select class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}"
                                                        name="type" id="type">
                                                            <option value="" disabled selected>Select ..</option>
                                                            <option value="job" 
                                                            {{isset($editEmail) ?($editEmail->type == 'job'?'selected':'') : null}}>
                                                            Job Alert
                                                            </option>
                                                            <option value="signup" 
                                                            {{isset($editEmail) ?($editEmail->type == 'signup'?'selected':'') : null}}>
                                                            Sign Up Alert
                                                            </option>
                                                        </select>

                                                        @if ($errors->has('type'))
                                                            <span class="invalid-feedback text-danger" role="alert">
                                                                <strong>{!! $errors->first('type') !!}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div> 

                                                <div class="form-group row">
                                                    <label for="h-email" class="col-md-2 col-form-label form-control-label">Email</label>
                                                    <div class="col-md-10">
                                                        <input type="text" id="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email" value="{{isset($editEmail) ?$editEmail->email : null}}">

                                                        @if ($errors->has('email'))
                                                            <span class="invalid-feedback text-danger" role="alert">
                                                                <strong>{!! $errors->first('email') !!}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div> 
                                                 
                                                <div class="form-group row">
                                                    <label for="h-password" class="col-md-2 col-form-label form-control-label">Name</label>
                                                    <div class="col-md-10">
                                                        <input id="name" name="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name" value="{{isset($editEmail) ?$editEmail->name : null}}">


                                                        @if ($errors->has('name'))
                                                            <span class="invalid-feedback text-danger" role="alert">
                                                                <strong>{!! $errors->first('name') !!}</strong>
                                                            </span>
                                                        @endif
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
                                        <tr>
                                            <td colspan="4" class="bg-default p-10">Job Email</td>
                                        </tr>
                                        @foreach($emailJob as $ej)
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
                                                    <label class="label bg-danger">{{$ej->class}}</label>
                                                </div> 
                                            </td>
                                            <td class="w-25 text-center">
                                                <button class="btn btn-flat flat-info txt-info waves-effect waves-light" 
                                                onClick="location.href='{{route('admin.update_email', ['id' => $ej->id])}}'">
                                                    Edit
                                                </button>
                                                @if($ej->class !== 'primary') 
                                                <button class="btn btn-flat flat-danger txt-danger waves-effect waves-light" 
                                                onClick="location.href='{{route('admin.delete_email', ['id' => $ej->id])}}'">
                                                    Delete
                                                </button>  
                                                @endif
                                            </td>
                                        </tr>  
                                        @endforeach
                                        <tr>
                                            <td colspan="4" class="bg-default p-10">Sign Up Email</td>
                                        </tr>
                                        @foreach($emailSignup as $es)
                                        <tr>
                                            <td class="w-25">{{$i++}}</td>
                                            <td class="w-50"> 
                                                <div class="label-main">
                                                    <label class="label-lg bg-primary text-lowercase">{{$es->email}}</label>
                                                </div> 
                                                <p>{{$es->name}}</p>
                                            </td> 
                                            <td class="w-25"> 
                                                <div class="label-main"> 
                                                    <label class="label bg-danger">{{$es->class}}</label>
                                                </div> 
                                            </td>
                                            <td class="w-25 text-center"> 
                                                <button class="btn btn-flat flat-info txt-info waves-effect waves-light" 
                                                onClick="location.href='{{route('admin.update_email', ['id' => $es->id])}}'">
                                                    Edit
                                                </button>
                                                @if($es->class !== 'primary') 
                                                <button class="btn btn-flat flat-danger txt-danger waves-effect waves-light" 
                                                onClick="location.href='{{route('admin.delete_email', ['id' => $es->id])}}'">
                                                    Delete
                                                </button>  
                                                @endif
                                            </td>
                                        </tr>  
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!--
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
                            -->
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