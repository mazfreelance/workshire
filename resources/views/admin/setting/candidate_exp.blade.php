@extends('layouts.master_admin')

@section('title', 'Setting | Search Candidate Duration')

@section('content') 
<div class="content-wrapper">
        <!-- Container-fluid starts -->
       <div class="container-fluid">
        <!-- Row Starts -->
        <div class="row">
            <div class="col-sm-12 p-0">
                <div class="main-header">
                    <h4>Setting | Search Candidate Duration</h4>
                    {{ Breadcrumbs::render('search_candidate_expired') }}
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
                    	Setting for duration employer owned candidates.
                    </div>  
                    <div class="card-block">
                        <div class="row">
                            <div class="col-sm-12 table-responsive">
                                <table class="table">
                                    <thead class="table-inverse">
                                    <tr>
                                        <th>No.</th>
                                        <th>Graduate Type</th>
                                        <th>Duration</th>
                                        <th>Token value</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($duration as $dur)
                                        @if($dur->candidate_type == 'Fresh')
                                        <tr class="table-active"> 
                                        @elseif($dur->candidate_type == 'Experience')
                                        <tr> 
                                        @elseif($dur->candidate_type == 'Internship')
                                        <tr class="table-success"> 
                                        @elseif($dur->candidate_type == 'Operator')
                                        <tr> 
                                        @elseif($dur->candidate_type == 'Senior')
                                        <tr class="table-info">
                                        @endif 
                                            <td>{{$dur->id}}</td>
                                            <td>{{$dur->candidate_type}}</td> 
                                            <td>
                                                @if($dur->duration == 0)
                                                    Forever
                                                @else
                                                    {{$dur->duration}}
                                                @endif
                                            </td>
                                            <td>{{$dur->token_value}}</td>
                                            <td><button class="btn btn-flat flat-info" onClick="location.href='{{ route('admin.update_candidate_expired', ['id' => $dur->id]) }}'">Edit</button></td>
                                        </tr> 
                                    @endforeach 
                                    </tbody>
                                </table>


                                <div class="modal" tabindex="-1" role="dialog" id="editCandidate">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Duration candidate</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            @if(isset($editDuration))
                                            {!! Form::model($editDuration,['method'=>'put','id'=>'frm']) !!}
                                            <div class="modal-body"> 
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1" class="form-control-label">{{ isset($editDuration) ?$editDuration->candidate_type :'' }}</label>
                                                    <input type="text" class="form-control form-control-sm" name="dur_id" value="{{ isset($editDuration) ?$editDuration->id:'' }}" readonly>
                                                </div> 
                                                 
                                                <div class="form-group">
                                                    <label for="exampleSelect1" class="form-control-label">Duration</label>
                                                    @php
                                                        if(isset($editDuration)){
                                                            $arr_duration = explode(' ', $editDuration->duration);
                                                        }
                                                    @endphp

                                                    <div class="form-radio">
                                                        <div class="radio radio-inline">
                                                            <label>
                                                                <input type="radio" name="limit" value="1" {{ isset($editDuration)? $arr_duration[0]!=0? 'checked':'' :'' }}>
                                                                    <i class="helper"></i>Limit
                                                            </label>
                                                        </div>
                                                        <div class="radio radio-inline">
                                                            <label>
                                                                <input type="radio" name="limit" value="0" {{ isset($editDuration)? $arr_duration[0]==0? 'checked':'' :'' }}>
                                                                    <i class="helper"></i>Unlimited
                                                            </label>
                                                        </div>
                                                    </div> 
                                                    <div class="form-inline limitdur">
                                                        <div class="form-group"> 
                                                            <input type="number" class="form-control" name="number" 
                                                            value="{{ isset($editDuration)? $arr_duration[0]:''}}">
                                                        </div>
                                                        <div class="form-group"> 
                                                            <select class="form-control" name="number_dur">
                                                                <option value="" disabled selected>Please select</option>
                                                                <option value="days" {{ isset($editDuration)? in_array('days', $arr_duration)? 'selected':'' :'' }}>days</option>
                                                                <option value="months" {{ isset($editDuration)? in_array('months', $arr_duration)? 'selected':'' :'' }}>months</option>
                                                                <option value="years" {{ isset($editDuration)? in_array('years', $arr_duration)? 'selected':'' :'' }}>years</option> 
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                 
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1" class="form-control-label">Token value</label>
                                                    <input type="number" class="form-control" name="token_value" value="{{ isset($editDuration)? $editDuration->token_value:''}}">
                                                </div>  
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                            {!! Form::close() !!}
                                            @endif
                                        </div>
                                    </div>
                                </div>
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
    @if(isset($editDuration)) $('#editCandidate').modal('show'); @endif


    var limit = $("input[name='limit']:checked").val();    
    limit == 0 ? $('.limitdur').hide() : $('.limitdur').show(); 

    $(document).on('change', "input[name='limit']", function(){  
        if( $(this).is(":checked") )
        {   
            var limit = $(this).val(); 
            limit == 0 ? $('.limitdur').hide() : $('.limitdur').show();
        }
    });
});
</script>
@endsection

@endsection