@extends('layouts.master_admin')

@section('title', 'Setting | Employer Package')

@section('content') 
<div class="content-wrapper">
        <!-- Container-fluid starts -->
       <div class="container-fluid">
        <!-- Row Starts -->
        <div class="row">
            <div class="col-sm-12 p-0">
                <div class="main-header">
                    <h4>Setting | Employer Package</h4>
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="icofont icofont-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="">User Setting</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('admin.package')}}">List of Employer Package</a>
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
                    	Setting for employer package list
                    </div>  
                    <div class="card-block">
                        <div class="row">
                            <form> 
                                <div class="col-sm-12">  
                                    <div class="md-group-add-on">
                                        <span class="md-add-on">
                                            <button type="submit" class="btn btn-mini btn-info btn-icon waves-effect waves-light"><i class="icofont icofont-search-alt-2"></i></button>
                                        </span>
                                        <div class="md-input-wrapper">
                                            <input type="text" class="md-form-control {{request()->session()->get('employer_name') != '' ?'md-valid':''}}" name="employer_name" value="{{request()->session()->get('employer_name')}}" />
                                            <label>Search employer name</label>
                                        </div>
                                    </div> 
                                </div>
                            </form> 

                            <div class="col-sm-12 table-responsive"> 
                                <button type="button" class="btn btn-warning waves-effect waves-light" style="margin-bottom:1em" onClick="location.href='{{route('admin.package')}}'">
                                    <i class="icofont icofont-arrow-left"></i>
                                    <span class="m-l-10">Back to package list</span>
                                </button>    

                                <table class="table table-hover table-bordered table-striped"> 
                                    <thead class="table-inverse">
                                        <tr>
                                            <th>id</th>
                                            <th>Name</th> 
                                            <th colspan="2" class="text-center">Package Plan</th>  
                                            <th class="text-center">Action</th>  
                                        </tr>
                                    </thead>
                                    <tbody>    
                                        @foreach($tokenRs as $tokenR)
                                            <?php
                                                $array_employerR = $tokenR->employer_id;      
                                                $finalRESUME[] = $array_employerR;                                    
                                            ?>  
                                        @endforeach 
                                        @foreach($tokenPs as $tokenP)
                                            <?php
                                                $array_employerP = $tokenP->employer_id;      
                                                $finalPOST[] = $array_employerP;                                    
                                            ?>  
                                        @endforeach  

                                        @foreach($employers as $employer)
                                        <tr>
                                            <td class="w-50">{{$employer->id}}</td>
                                            <td class="w-50"> 
                                                 {{$employer->emp_name}}
                                            </td> 
                                            <td class="w-25 text-center"> 
                                               <div class="label-main"> 
                                                    @if(in_array($employer->id, $finalPOST)) 
                                                        @foreach($tokenPs as $tokenP)
                                                            @if($tokenP->employer_id == $employer->id)
                                                                <label class="label bg-primary d-block">Post: {{$tokenP->package_plan}}</label>
                                                                @if($tokenP->package_plan == 'P|26')
                                                                <label class="label bg-info d-block">Balance: Unlimited</label>
                                                                @else
                                                                <label class="label bg-info d-block">Balance: {{$tokenP->balance}}</label>
                                                                @endif
                                                            @endif
                                                        @endforeach 
                                                    @else
                                                        <label class="label bg-primary">Post: None</label>
                                                    @endif
                                                </div>   
                                            </td> 
                                            <td class="w-25 text-center">  
                                               <div class="label-main"> 
                                                    @if(in_array($employer->id, $finalRESUME)) 
                                                        @foreach($tokenRs as $tokenR)
                                                            @if($tokenR->employer_id == $employer->id)
                                                                <label class="label bg-success d-block">Resume: {{$tokenR->package_plan}}</label>
                                                                @if($tokenR->package_plan == 'V|25')
                                                                <label class="label bg-info d-block">Balance: Unlimited</label>
                                                                @else
                                                                <label class="label bg-info d-block">Balance: {{$tokenR->balance}}</label>
                                                                @endif
                                                            @endif
                                                        @endforeach 
                                                    @else
                                                        <label class="label bg-success">Resume: None</label>
                                                    @endif
                                                </div>     
                                            </td> 
                                            <td class="w-25 text-center">
                                                @if(in_array($employer->id, $finalPOST)) 
                                                    @foreach($tokenPs as $tokenP)
                                                        @if($tokenP->employer_id == $employer->id)
                                                        <a class="btn btn-flat flat-primary txt-primary waves-effect waves-light" onClick="location.href='{{route('admin.package_reload')}}?idP={{$tokenP->id}}&employer={{$employer->id}}'">
                                                            Topup<br/>Post
                                                        </a>
                                                        @endif
                                                    @endforeach 
                                                @else
                                                    <button class="btn btn-flat flat-primary txt-primary waves-effect waves-light" onClick="location.href='{{route('admin.package_add')}}?employer={{$employer->id}}'">
                                                        Upgrade<br/>Post
                                                    </button>
                                                @endif

                                                @if(in_array($employer->id, $finalRESUME)) 
                                                    @foreach($tokenRs as $tokenR)
                                                        @if($tokenR->employer_id == $employer->id)
                                                        <a class="btn btn-flat flat-success txt-success waves-effect waves-light" onClick="location.href='{{route('admin.package_reload')}}?idR={{$tokenR->id}}&employer={{$employer->id}}'">
                                                            Topup<br/>Resume
                                                        </a>
                                                        @endif
                                                    @endforeach 
                                                @else
                                                    <button class="btn btn-flat flat-success txt-success waves-effect waves-light" onClick="location.href='{{route('admin.package_add')}}?employer={{$employer->id}}'">
                                                        Upgrade<br/>Resume
                                                    </button>
                                                @endif
                                                 
                                            </td>
                                        </tr> 
                                        @endforeach
                                    </tbody>
                                </table> 
                                <nav class="table-responsive" aria-label="pagination" style="margin-bottom:-1em">
                                    {{ $employers->links('vendor.pagination.bootstrap-4') }}
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