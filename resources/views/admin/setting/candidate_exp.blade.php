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
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="icofont icofont-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="">User Setting</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('admin.candidate_expired')}}">Search Candidate Duration</a>
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
                                            <td><button class="btn btn-flat flat-info">Edit</button></td>
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
     
});
</script>
@endsection

@endsection