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
                    	Setting for package list
                    </div>  
                    <div class="card-block">
                        <div class="row">
                            <div class="col-sm-12 table-responsive"> 
                                <button type="button" class="btn btn-primary waves-effect waves-light editpackage" style="margin-bottom:1em">
                                   <i class="icofont icofont-plus"></i>
                                     <span class="m-l-10">Add package</span>
                                 </button>
                                
                                 <div class="modal" tabindex="-1" role="dialog" id="editpackage">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Package</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            
                                            @if(isset($editPkg))
                                            {!! Form::model($editPkg,['method'=>'put','id'=>'frm']) !!}
                                            @else
                                            {!! Form::open(['route'=>'admin.create_package','id'=>'frm']) !!}
                                            @endif 

                                            <div class="modal-body"> 
                                                <div class="form-group">
                                                    <label for="exampleSelect1" class="form-control-label">Package type</label>  
                                                    <div class="form-radio">
                                                        <div class="radio radio-inline">
                                                            <label>
                                                                <input type="radio" name="type" value="P" {{ isset($editPkg) ? $editPkg->type == 'P'? 'checked':'' :''}}>
                                                                    <i class="helper"></i>Job Posting
                                                            </label>
                                                        </div>
                                                        <div class="radio radio-inline">
                                                            <label>
                                                                <input type="radio" name="type" value="V" {{ isset($editPkg) ? $editPkg->type == 'V'? 'checked':'' :''}}>
                                                                    <i class="helper"></i>Resume/Profile Viewing
                                                            </label>
                                                        </div>
                                                    </div>  
                                                </div> 

                                                <div class="form-group">
                                                    <label for="exampleInputPassword1" class="form-control-label">Package Description</label>
                                                    <textarea class="form-control" name="description" cols="5" placeholder="Insert description package">{{ isset($editPkg) ? $editPkg->description :''}}</textarea>
                                                </div>  

                                                <div class="form-group">
                                                    <label for="exampleInputPassword1" class="form-control-label">Token amount</label>
                                                    <input type="number" class="form-control" name="token_amt" value="{{ isset($editPkg) ? $editPkg->token_amount :''}}">
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
                                                <button class="btn btn-flat flat-info txt-info waves-effect waves-light" 
                                                onClick="location.href='{{ route('admin.update_package', ['id' => $pkg->id]) }}'">Edit</button>
                                                <button class="btn btn-flat flat-danger txt-danger waves-effect waves-light" 
                                                onClick="location.href='{{ route('admin.destroy_package', ['id' => $pkg->id]) }}'">Delete</button> 
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
                <!-- Col content-2 --> 
                <div class="card">
                    <div class="card-header">
                        Setting for job posting duration list
                    </div>  
                    <div class="card-block">
                        <div class="row">
                            <div class="col-sm-12 table-responsive"> 
                                <button type="button" class="btn btn-primary waves-effect waves-light editpackagedur" style="margin-bottom:1em">
                                   <i class="icofont icofont-plus"></i>
                                     <span class="m-l-10">Add job posting duration</span>
                                 </button>
                                
                                 <div class="modal" tabindex="-1" role="dialog" id="editpackagedur">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Job posting duration</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            
                                            @if(isset($editPkgDur))
                                            {!! Form::model($editPkgDur,['method'=>'put','id'=>'frm']) !!}
                                            @else
                                            {!! Form::open(['route'=>'admin.create_jobpostingduration','id'=>'frm']) !!}
                                            @endif 

                                            <div class="modal-body"> 
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1" class="form-control-label">Package</label>
                                                    @php
                                                        $postPlan = \App\Model\PackagePlan::where('type','=','P')->get();
                                                    @endphp 
                                                    <select class="form-control" name="jobpost">
                                                        <option selected disabled>Select job posting...</option>
                                                        @foreach($postPlan as $pp)
                                                        <option value="{{$pp->type.'|'.$pp->id}}" 
                                                        {{ isset($editPkgDur) ? $editPkgDur->post_type == $pp->type.'|'.$pp->id? 'selected':'' :''}}>
                                                            {{$pp->type.'|'.$pp->id}} : {{$pp->description}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>  

                                                <div class="form-group">
                                                    <label for="exampleSelect1" class="form-control-label">Duration</label>
                                                    @php
                                                        if(isset($editPkgDur)){
                                                            $arr_duration = explode(' ', $editPkgDur->duration);
                                                        }
                                                    @endphp
                                                    <div class="form-inline">
                                                        <div class="form-group"> 
                                                            <input type="number" class="form-control" name="number" 
                                                            value="{{ isset($editPkgDur)? $arr_duration[0]:''}}">
                                                        </div>
                                                        <div class="form-group"> 
                                                            <select class="form-control" name="number_dur">
                                                                <option value="" disabled selected>Please select</option>
                                                                <option value="days" {{ isset($editPkgDur)? in_array('days', $arr_duration)? 'selected':'' :'' }}>days</option>
                                                                <option value="months" {{ isset($editPkgDur)? in_array('months', $arr_duration)? 'selected':'' :'' }}>months</option>
                                                                <option value="years" {{ isset($editPkgDur)? in_array('years', $arr_duration)? 'selected':'' :'' }}>years</option> 
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div> 

                                                <div class="form-group">
                                                    <label for="exampleInputPassword1" class="form-control-label">Token value</label>
                                                    <input type="number" class="form-control" name="token_amt" value="{{ isset($editPkgDur) ? $editPkgDur->token_value :'0'}}">
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
                                            <th>Package</th>
                                            <th>Duration</th> 
                                            <th>
                                                Token value<br/>
                                                (* From applying job posting in employer account)
                                            </th>  
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>   
                                        @foreach($postDur as $pkg)
                                        <tr>
                                            <td class="w-50">{{$pkg->post_type}}</td>
                                            <td class="w-50"> 
                                                 {{$pkg->duration}}
                                            </td> 
                                            <td class="w-25"> 
                                                 {{$pkg->token_value}}
                                            </td> 
                                            <td class="w-25 text-center">
                                                <button class="btn btn-flat flat-info txt-info waves-effect waves-light" 
                                                onClick="location.href='{{ route('admin.update_jobpostingduration', ['id' => $pkg->id]) }}'">Edit</button>
                                                <button class="btn btn-flat flat-danger txt-danger waves-effect waves-light" 
                                                onClick="location.href='{{ route('admin.destroy_jobpostingduration', ['id' => $pkg->id]) }}'">Delete</button> 
                                            </td>
                                        </tr> 
                                        @endforeach
                                    </tbody>
                                </table> 
                                <nav class="table-responsive" aria-label="pagination" style="margin-bottom:-1em">
                                    {{-- $postDur->links('vendor.pagination.bootstrap-4') --}}
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
    @if(isset($editPkg)) $('#editpackage').modal('show'); @endif
    $(document).on('click', '.editpackage', function(){
        $('#editpackage').modal('show');
    });

    @if(isset($editPkgDur)) $('#editpackagedur').modal('show'); @endif
    $(document).on('click', '.editpackagedur', function(){
        $('#editpackagedur').modal('show');
    });
});
</script>
@endsection

@endsection