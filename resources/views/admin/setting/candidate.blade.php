@extends('layouts.master_admin')

@section('title', 'Setting | Search Candidate')

@section('content') 
<div class="content-wrapper">
        <!-- Container-fluid starts -->
       <div class="container-fluid">
        <!-- Row Starts -->
        <div class="row">
            <div class="col-sm-12 p-0">
                <div class="main-header">
                    <h4>Setting | Search Candidate</h4>
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="icofont icofont-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="">User Setting</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('admin.search_candidate')}}">Search Candidate</a>
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
                    	@if($status[0]->status == 'ENABLE')
                        <div class="d-block">
                         	<button class="btn btn-success waves-effect waves-light js-programmatic-enable" disabled> Enabled</button>
    						<button class="btn btn-danger waves-effect waves-light js-programmatic-disable" value="DISABLE"> Disable</button>
                        </div>
                        <label class="col-xs-7 col-sm-1 col-form-label col-form-label">Message</label>
                        <div class="d-block">
                            <input type="text" class="form-control col-sm-5" id="" placeholder="Enter message">
                        </div>
                     	@elseif($status[0]->status == 'DISABLE')
                     	<button class="btn btn-success waves-effect waves-light js-programmatic-enable" value="ENABLE"> Enable</button>
						<button class="btn btn-danger waves-effect waves-light js-programmatic-disable" disabled> Disabled</button>
						@endif

						<input type="hidden" class="status" value="{{$status[0]->status}}">
                    </div>  
                    <div class="card-block" style="margin-left:2em">
                        <form>  
							<div class="form-group row">
							    <label for="inputEmail3" class="col-xs-6 col-sm-2 col-form-label col-form-label bg-info">Fresh</label>
							    <div class="col-xs-6 col-sm-2">
							      	<label class="custom-control availability-checkbox checkbox-1">
		                        		<input type="checkbox" class="custom-control-input">
		                        		<span class="custom-control-indicator"></span>
		                    	  	</label>
							    </div>
                                <label class="col-xs-7 col-sm-1 col-form-label col-form-label">Message</label>
                                <div class="col-xs-6 col-sm-7">
                                    <input type="text" class="form-control-sm" id="" placeholder="Enter message">
                                </div>
						  	</div>

							<div class="form-group row">
							    <label for="inputEmail3" class="col-xs-6 col-sm-2 col-form-label col-form-label bg-primary">Experience</label>
							    <div class="col-xs-6 col-sm-2">
							      	<label class="custom-control availability-checkbox checkbox-2">
		                        		<input type="checkbox" class="custom-control-input">
		                        		<span class="custom-control-indicator"></span>
		                    	  	</label>
							    </div>
                                <label class="col-xs-7 col-sm-1 col-form-label col-form-label">Message</label>
                                <div class="col-xs-6 col-sm-7">
                                    <input type="text" class="form-control-sm" id="" placeholder="Enter message">
                                </div>
						  	</div>

							<div class="form-group row">
							    <label for="inputEmail3" class="col-xs-6 col-sm-2 col-form-label col-form-label bg-warning">Intership</label>
							    <div class="col-xs-6 col-sm-2">
							      	<label class="custom-control availability-checkbox checkbox-3">
		                        		<input type="checkbox" class="custom-control-input">
		                        		<span class="custom-control-indicator"></span>
		                    	  	</label>
							    </div>
                                <label class="col-xs-7 col-sm-1 col-form-label col-form-label">Message</label>
                                <div class="col-xs-6 col-sm-7">
                                    <input type="text" class="form-control-sm" id="" placeholder="Enter message">
                                </div>
						  	</div>

							<div class="form-group row">
							    <label for="inputEmail3" class="col-xs-6 col-sm-2 col-form-label col-form-label bg-danger">Operator</label>
							    <div class="col-xs-6 col-sm-2">
							      	<label class="custom-control availability-checkbox checkbox-4">
		                        		<input type="checkbox" class="custom-control-input">
		                        		<span class="custom-control-indicator"></span>
		                    	  	</label>
							    </div>
                                <label class="col-xs-7 col-sm-1 col-form-label col-form-label">Message</label>
                                <div class="col-xs-6 col-sm-7">
                                    <input type="text" class="form-control-sm" id="" placeholder="Enter message">
                                </div>
						  	</div>

                            <button type="submit" class="btn btn-primary waves-effect waves-light m-r-30">Save</button>
                        </form>
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
    var status = $('.status').val(); 

    alert('status');
});
</script>
@endsection

@endsection