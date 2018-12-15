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
                                            {!! Form::open(['route'=>'admin.create_cart_package','id'=>'frm']) !!}
                                            @endif 

                                            <div class="modal-body"> 

                                                @if(isset($editPkg) AND ($editPkg->id == 1 OR $editPkg->id == 2))
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1" class="form-control-label">Name</label>
                                                        <input type="text" class="form-control" name="name" value="{{ isset($editPkg) ? $editPkg->name :''}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1" class="form-control-label">Package Description</label>
                                                        <textarea class="form-control" name="description" cols="5" placeholder="Insert description package">{{ isset($editPkg) ? $editPkg->description :''}}</textarea>
                                                    </div>
                                                @else
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1" class="form-control-label">Name</label>
                                                        <input type="text" class="form-control" name="name" value="{{ isset($editPkg) ? $editPkg->name :''}}">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1" class="form-control-label">Package</label>
                                                        <div class="form-inline"> 
                                                            @php
                                                                $postPlan = \App\Model\PackagePlan::where('type','=','P')->get();
                                                                $viewPlan = \App\Model\PackagePlan::where('type','=','V')->get();
                                                            @endphp 
                                                            <div class="form-group"> 
                                                                <select class="form-control" name="jobpost">
                                                                    <option selected disabled>Select job posting...</option>
                                                                    @foreach($postPlan as $pp)
                                                                    <option value="{{$pp->id}}" 
                                                                    {{ isset($editPkg) ? $editPkg->post_id == $pp->id? 'selected':'' :''}}>
                                                                        {{$pp->type.'|'.$pp->id}} : {{$pp->description}}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <select class="form-control" name="viewresume">
                                                                    <option selected disabled>Select profile/resume viewing...</option>
                                                                    <option value="0"
                                                                    {{ isset($editPkg) ? $editPkg->resume_id == 0? 'selected':'' :''}}>
                                                                        0 : No Job Posting
                                                                    </option>
                                                                    @foreach($viewPlan as $vp)
                                                                    <option value="{{$vp->id}}" 
                                                                    {{ isset($editPkg) ? $editPkg->resume_id == $vp->id? 'selected':'' :''}}>
                                                                        {{$vp->type.'|'.$vp->id}} : {{$vp->description}}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>  


                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1" class="form-control-label">Price (MYR)</label>
                                                        <div class="form-inline">
                                                            <div class="form-group"> 
                                                                <label for="inline3mail" class="block form-control-label">Total</label> 
                                                                <input type="number" class="form-control" name="total" value="{{ isset($editPkg) ? $editPkg->price :'0.00'}}">
                                                            </div>
                                                            <div class="form-group">  
                                                                <label for="inline3mail" class="block form-control-label">Discount</label> 
                                                                <input type="number" class="form-control" name="discount" value="{{ isset($editPkg) ? $editPkg->disc_price :'0.00'}}">
                                                            </div>
                                                        </div>
                                                    </div> 

                                                    <div class="form-group">
                                                        <label for="exampleSelect1" class="form-control-label">Duration</label>
                                                        @php
                                                            if(isset($editPkg)){
                                                                $arr_duration = explode(' ', $editPkg->duration);
                                                            }
                                                        @endphp

                                                        <div class="form-radio">
                                                            <div class="radio radio-inline">
                                                                <label>
                                                                    <input type="radio" name="type" value="limit" {{ isset($editPkg) ? $editPkg->duration !== 'lifetime'? 'checked':'' :''}}>
                                                                        <i class="helper"></i>Limit time
                                                                </label>
                                                            </div>
                                                            <div class="radio radio-inline">
                                                                <label>
                                                                    <input type="radio" name="type" value="lifetime" {{ isset($editPkg) ? $editPkg->duration == 'lifetime'? 'checked':'' :''}}>
                                                                        <i class="helper"></i>Unlimited
                                                                </label>
                                                            </div>
                                                        </div> 
                                                        <div class="form-inline limitdur">
                                                            <div class="form-group"> 
                                                                <input type="number" class="form-control" name="number" 
                                                                value="{{ isset($editPkg)? $arr_duration[0]:''}}">
                                                            </div>
                                                            <div class="form-group"> 
                                                                <select class="form-control" name="number_dur">
                                                                    <option value="" disabled selected>Please select</option>
                                                                    <option value="days" {{ isset($editPkg)? in_array('days', $arr_duration)? 'selected':'' :'' }}>days</option>
                                                                    <option value="months" {{ isset($editPkg)? in_array('months', $arr_duration)? 'selected':'' :'' }}>months</option>
                                                                    <option value="years" {{ isset($editPkg)? in_array('years', $arr_duration)? 'selected':'' :'' }}>years</option> 
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div> 

                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1" class="form-control-label">Package Description</label>
                                                        <textarea class="form-control" name="description" cols="5" placeholder="Insert description package">{{ isset($editPkg) ? $editPkg->description :''}}</textarea>
                                                        <br/>
                                                        <p><code>
                                                            Notes:<br/>
                                                            Use &#39;|&#39; as separator, example: sentence 1|sentence 2|...|sentence x<br/>
                                                            Use &lt;strike&gt; test &lt;/strike&gt;, example: <strike> test </strike>
                                                        </code></p>
                                                    </div>
                                                @endif
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
                                            <th>Name</th> 
                                            <th>Plan</th> 
                                            <th>Price</th> 
                                            <th>Discount Price</th>  
                                            <th>Duration</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>   
                                        @foreach($cartPro as $pkg)
                                        <tr>
                                            @if($pkg->id == 1 OR $pkg->id == 2)
                                                <td colspan="5">
                                                     {{$pkg->name}}
                                                </td>
                                                <td>
                                                     {{$pkg->description}}
                                                </td>
                                            @else
                                                <td class="w-50"> 
                                                     {{$pkg->name}}
                                                </td> 
                                                <td class="w-25">
                                                    {{ 'P|'.$pkg->post_id }}
                                                    <br/>
                                                    {{ 'V|'.$pkg->resume_id }}
                                                </td> 
                                                <td class="w-25"> 
                                                     {{$pkg->price}}
                                                </td> 
                                                <td class="w-25"> 
                                                     {{$pkg->disc_price}}
                                                </td> 
                                                <td class="w-25"> 
                                                     {{$pkg->duration}}
                                                </td> 
                                                <td class="w-25"> 
                                                     {!!$pkg->description!!}
                                                </td> 
                                            @endif
                                            <td class="w-25 text-center">
                                                <button class="btn btn-flat flat-info txt-info waves-effect waves-light" 
                                                onClick="location.href='{{ route('admin.update_cart_package', ['id' => $pkg->id]) }}'">Edit</button>

                                                @if(!($pkg->id == 1 OR $pkg->id == 2))
                                                <button class="btn btn-flat flat-danger txt-danger waves-effect waves-light" 
                                                onClick="location.href='{{ route('admin.destroy_cart_package', ['id' => $pkg->id]) }}'">Delete</button> 
                                                @endif
                                            </td>
                                        </tr> 
                                        @endforeach
                                    </tbody>
                                </table> 
                                <nav class="table-responsive" aria-label="pagination" style="margin-bottom:-1em">
                                    {{ $cartPro->links('vendor.pagination.bootstrap-4') }}
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

    var limit = $("input[name='type']:checked").val();    
    limit == 'lifetime' ? $('.limitdur').hide() : $('.limitdur').show(); 

    $(document).on('change', "input[name='type']", function(){  
        if( $(this).is(":checked") )
        {   
            var limit = $(this).val(); 
            limit == 'lifetime' ? $('.limitdur').hide() : $('.limitdur').show();
        }
    });
});
</script>
@endsection

@endsection