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
                @if(session('success'))
                <div class="alert alert-success" role="alert">
                  {{ session('success') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                @endif
                {!! Form::open(['route' => 'admin.post_search_candidate']) !!}
                <input type="hidden" name="candidate_id" value="{{$status[0]->id}}">
        		<!-- Col content-2 -->   
				<div class="card">
                    <div class="card-header">
                        <div class="form-radio">
                            <div class="radio radio-inline">
                                <label>
                                    <input type="radio" name="status" value="ENABLE" {{ $status[0]->status == 'ENABLE' ? 'checked' : '' }}>
                                        <i class="helper"></i>ENABLE
                                </label>
                            </div>
                            
                            <div class="radio radio-inline">
                                <label>
                                    <input type="radio" name="status" value="DISABLE" {{ $status[0]->status == 'DISABLE' ? 'checked' : '' }}>
                                        <i class="helper"></i>DISABLE
                                </label>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="exampleTextarea" class="form-control-label">Message</label>
                                    <textarea class="form-control" name="status-msg" id="status-msg" rows="4">{{ $status[0]->message }}</textarea>
                                </div>
                            </div>
                        </div> 
                    </div>  
                    <div class="card-block"> 
                        <div class="row enable_candidate">
                            <div class="col-sm-12 table-responsive">

                                <input type="hidden" name="fresh_id" value="{{$candidates[0]->id}}">
                                <input type="hidden" name="exp_id" value="{{$candidates[1]->id}}">
                                <input type="hidden" name="intern_id" value="{{$candidates[2]->id}}">
                                <input type="hidden" name="operator_id" value="{{$candidates[3]->id}}">
                                
                                <table class="table table-inverse">
                                    <tbody> 
                                        <tr class="bg-info">
                                            <td>Fresh</td>
                                            <td>
                                                <label class="custom-control availability-checkbox checkbox-1">
                                                    <input type="checkbox" class="custom-control-input" name="fresh-radio" id="fresh-radio" value="YES" {{ $candidates[0]->status == 'YES' ? 'checked' : '' }}>
                                                    <span class="custom-control-indicator"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="fresh-msg" id="fresh-msg" 
                                                value="{{ $candidates[0]->message }}" placeholder="Enter message">
                                            </td>
                                        </tr>
                                        <tr class="bg-primary">
                                            <td>Experience</td>
                                            <td>
                                                <label class="custom-control availability-checkbox checkbox-2">
                                                    <input type="checkbox" class="custom-control-input" name="exp-radio" id="exp-radio" value="YES" {{ $candidates[1]->status == 'YES' ? 'checked' : '' }}>
                                                    <span class="custom-control-indicator"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="exp-msg" id="exp-msg" 
                                                value="{{ $candidates[1]->message }}" placeholder="Enter message">
                                            </td>
                                        </tr>
                                        <tr class="bg-warning">
                                            <td>Internship</td>
                                            <td>
                                                <label class="custom-control availability-checkbox checkbox-3">
                                                    <input type="checkbox" class="custom-control-input" name="intern-radio" id="intern-radio" value="YES" {{ $candidates[2]->status == 'YES' ? 'checked' : '' }}>
                                                    <span class="custom-control-indicator"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="intern-msg" id="intern-msg" 
                                                value="{{ $candidates[2]->message }}" placeholder="Enter message">
                                            </td>
                                        </tr>
                                        <tr class="bg-success">
                                            <td>Operator</td>
                                            <td>
                                                <label class="custom-control availability-checkbox checkbox-4">
                                                    <input type="checkbox" class="custom-control-input" name="operator-radio" id="operator-radio" value="YES" {{ $candidates[3]->status == 'YES' ? 'checked' : '' }}>
                                                    <span class="custom-control-indicator"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="operator-msg" id="operator-msg" 
                                                value="{{ $candidates[3]->message }}" placeholder="Enter message">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>  
                        <div class="row">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-sm btn-outline-primary">Save</button>
                            </div>
                        </div> 
                    </div>
                </div>  
    			<!-- Col content-2 end-->
                {!! Form::close() !!}
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
$(document).ready(function(){
    $('.enable_candidate').hide();  

    var status = $("input[name='status']:checked").val();    
    if(status == 'ENABLE'){
        $('#status-msg').prop('readonly', true);
        $('.enable_candidate').show();
    }else if(status == 'DISABLE'){
        $('#status-msg').prop('readonly', false);
        $('.enable_candidate').hide();
    }

    $("input[name='status']").change(function(){  
        if( $(this).is(":checked") ){   
            var status = $(this).val();
            if(status == 'ENABLE'){
                $('#status-msg').prop('readonly', true);
                $('.enable_candidate').show();
            }else if(status == 'DISABLE'){
                $('#status-msg').prop('readonly', false);
                $('.enable_candidate').hide();
            }
        }
    });

    $('#fresh-radio').is(":checked") ? $('#fresh-msg').prop('readonly', false) : $('#fresh-msg').prop('readonly', true);  
    $("#fresh-radio").change(function(){    
        $(this).is(":checked") ? $('#fresh-msg').prop('readonly', false) : $('#fresh-msg').prop('readonly', true); 
    }); 
    $('#exp-radio').is(":checked") ? $('#exp-msg').prop('readonly', false) : $('#exp-msg').prop('readonly', true);  
    $("#exp-radio").change(function(){    
        $(this).is(":checked") ? $('#exp-msg').prop('readonly', false) : $('#exp-msg').prop('readonly', true); 
    }); 
    $('#intern-radio').is(":checked") ? $('#intern-msg').prop('readonly', false) : $('#intern-msg').prop('readonly', true);  
    $("#intern-radio").change(function(){    
        $(this).is(":checked") ? $('#intern-msg').prop('readonly', false) : $('#intern-msg').prop('readonly', true); 
    }); 
    $('#operator-radio').is(":checked") ? $('#operator-msg').prop('readonly', false) : $('#operator-msg').prop('readonly', true);  
    $("#operator-radio").change(function(){    
        $(this).is(":checked") ? $('#operator-msg').prop('readonly', false) : $('#operator-msg').prop('readonly', true); 
    }); 


});
</script>
@endsection

@endsection