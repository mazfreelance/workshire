@extends('layouts.master_admin')

@section('title', 'Setting | Demo Data ')

@section('content') 
<div class="content-wrapper">
        <!-- Container-fluid starts -->
       <div class="container-fluid">
        <!-- Row Starts -->
        <div class="row">
            <div class="col-sm-12 p-0">
                <div class="main-header">
                    <h4>Setting | Demo Data </h4>
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="icofont icofont-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="">Sourcing</a>
                        </li>
                        <li class="breadcrumb-item"><a href="">Demo Data</a>
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
                    	Setting for demo data list
                    </div>  
                    <div class="card-block">
                        <div class="row">
                            <div class="col-md-12"> 
                                <ul id="tabsJustified" class="nav nav-tabs">
                                    <li class="nav-item"><a href="" data-target="#age" data-toggle="tab" class="nav-link small text-uppercase active">Age</a></li> 
                                    <li class="nav-item"><a href="" data-target="#eduLvl" data-toggle="tab" class="nav-link small text-uppercase">Education Level</a></li>
                                    <li class="nav-item"><a href="" data-target="#exp" data-toggle="tab" class="nav-link small text-uppercase">Experience</a></li>
                                    <li class="nav-item"><a href="" data-target="#fos" data-toggle="tab" class="nav-link small text-uppercase">Field of Study</a></li>
                                    <li class="nav-item"><a href="" data-target="#gender" data-toggle="tab" class="nav-link small text-uppercase">Gender</a></li> 
                                    <li class="nav-item"><a href="" data-target="#school" data-toggle="tab" class="nav-link small text-uppercase">Institution</a></li>
                                    <li class="nav-item"><a href="" data-target="#state" data-toggle="tab" class="nav-link small text-uppercase">State</a></li>
                                </ul>
                                <br>
                            </div>
                        </div>
                        <div id="tabsJustifiedContent" class="tab-content"> 
                            
                            <div id="age" class="tab-pane fade active show">
                              <table class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th>No.</th>
                                    <th>Year</th>
                                    <th>Age</th>
                                    <th>Total</th> 
                                  </tr>
                                </thead> 
                                <tbody>
                                    @php
                                    $a=1;$sumGender=0;
                                    @endphp 

                                    @foreach($age as $ages)

                                    @if($ages->year != '' AND $ages->age != '') 
                                    <tr>
                                        <td>{{$a++}}</td>
                                        <td>{{$ages->year}}</td>
                                        <td>{{$ages->age}}</td>
                                        <td>{{$ages->Total}}</td>
                                    </tr>
                                    @endif

                                    @php $sumGender += $ages->Total; @endphp
                                    @endforeach
                                  <tr>
                                    <td colspan="3"></td> 
                                    <td class="text-left font-weight-bold"><u>{{$sumGender}}</u></td> 
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                            <div id="state" class="tab-pane fade">
                                <table class="table table-bordered">
                                  <thead>
                                    <tr>
                                      <th>No.</th>
                                      <th>Level of State</th>
                                      <th>Total</th> 
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @php
                                    $a=1;$sumstate=0;
                                    @endphp 

                                    @foreach($state_array as $state)
                                    @php 
                                        $statetotal = \App\Model\JobSeeker_Education::whereRaw('institute LIKE "%'.$state->state_name.'%"')->count();

                                        $sumstate += $statetotal;
                                    @endphp
                                        <tr>
                                            <td>{{$a++}}</td>
                                            <td>{{$state->state_name}}</td>
                                            <td>{{$statetotal}}</td> 
                                        </tr> 
                                    @endforeach
                                    <tr>
                                      <td colspan="2"></td> 
                                      <td class="text-left font-weight-bold"><u>{{$sumstate}}</u></td> 
                                    </tr>
                                  </tbody>
                                </table>
                            </div>
                            <div id="gender" class="tab-pane fade">
                                <table class="table table-bordered">
                                  <thead>
                                    <tr>
                                      <th>Male.</th>
                                      <th>Female</th>
                                      <th>Total All</th> 
                                    </tr>
                                  </thead> 
                                  <tbody>
                                    @foreach($gender as $gdr)  
                                    <tr>
                                        <td>{{$gdr->male_cnt}}</td> 
                                        <td>{{$gdr->female_cnt}}</td>
                                        <td>{{$gdr->total_cnt}}</td>
                                    </tr>
                                    @endforeach
                                  </tbody>
                                </table>
                            </div>
                            <div id="school" class="tab-pane fade">
                                <table class="table table-bordered">
                                  <thead>
                                    <tr>
                                      <th>No.</th>
                                      <th>School Name</th>
                                      <th>Total</th> 
                                    </tr>
                                  </thead> 
                                  <tbody>
                                    @php
                                    $a=1;$sumSchool=0;
                                    @endphp 

                                    @foreach($institutes as $ins)
                                    @php 
                                        $unitotal = \App\Model\JobSeeker_Education::whereRaw('institute LIKE "%'.$ins->uni_name.'%"')->count();

                                        $sumSchool += $unitotal;
                                    @endphp
                                        <tr>
                                            <td>{{$a++}}</td>
                                            <td>{{$ins->uni_name}}</td>
                                            <td>{{$unitotal}}</td> 
                                        </tr> 
                                    @endforeach
                                    <tr>
                                      <td colspan="2"></td> 
                                      <td class="text-left font-weight-bold"><u>{{$sumSchool}}</u></td> 
                                    </tr>
                                  </tbody>
                                </table>
                            </div>
                            <div id="eduLvl" class="tab-pane fade">
                                <table class="table table-bordered">
                                  <thead>
                                    <tr>
                                      <th>No.</th>
                                      <th>Level of Education</th>
                                      <th>Total</th> 
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @php
                                    $a=1;$sumlevel=0;
                                    $edulvls = array('SPM' => 'SPM', 'STPM' => 'STPM', 'Diploma' => 'Diploma', 'Degree' => 'Bachelor Degree', 'Master' => 'Master Degree', 'PHD' => 'PHD');
                                    @endphp
                                    @foreach($edulvls as $key => $edulvl) 

                                    @php 
                                        $edulvltotal = \App\Model\JobSeeker_Education::whereRaw('highest_education LIKE "%'.$key.'%"')->count();

                                        $sumlevel += $edulvltotal;
                                    @endphp

                                        <tr>
                                            <td>{{$a++}}</td>
                                            <td>{{$edulvl}}</td>
                                            <td>{{$edulvltotal}}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                      <td colspan="2"></td> 
                                      <td class="text-left font-weight-bold"><u>{{$sumlevel}}</u></td> 
                                    </tr>
                                  </tbody>
                                </table>
                            </div>
                            <div id="fos" class="tab-pane fade"> 
                                <table class="table table-bordered">
                                  <thead>
                                    <tr>
                                      <th>No.</th>
                                      <th>Level of Field of Study</th>
                                      <th>Total</th> 
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @php
                                    $a=1;$sumfos=0;
                                    @endphp 

                                    @foreach($fos as $fosdtl)
                                    @php 
                                        $fostotal = \App\Model\JobSeeker_Education::whereRaw('field_of_study LIKE "%'.$fosdtl->category_Name.'%"')->count();

                                        $sumfos += $fostotal;
                                    @endphp
                                        <tr>
                                            <td>{{$a++}}</td>
                                            <td>{{$fosdtl->category_Name}}</td>
                                            <td>{{$fostotal}}</td> 
                                        </tr> 
                                    @endforeach
                                    <tr>
                                      <td colspan="2"></td> 
                                      <td class="text-left font-weight-bold"><u>{{$sumfos}}</u></td> 
                                    </tr> 
                                  </tbody>
                                </table>
                            </div>
                            <div id="exp" class="tab-pane fade">
                                <table class="table table-bordered">
                                  <thead>
                                    <tr>
                                      <th>No.</th>
                                      <th>Year of experience</th>
                                      <th>Total</th> 
                                    </tr>
                                  </thead>
                                  
                                  <tbody>
                                        @php
                                        $a=1;$sumExp=0;
                                        @endphp 

                                        @foreach($exps as $exp)
                                        @php  
                                            $sumExp += $exp->count_exp;
                                        @endphp

                                        @if($exp->expno != '') 
                                        <tr>
                                            <td>{{$a++}}</td> 
                                            <td>{{$exp->expno}} years</td> 
                                            <td>{{$exp->count_exp}}</td> 
                                        </tr> 
                                        @endif

                                        @endforeach
                                        <tr>
                                          <td colspan="2"></td> 
                                          <td class="text-left font-weight-bold"><u>{{$sumExp}}</u></td> 
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
<script src="{{ asset('public/js/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('public/js/ckeditor/adapters/jquery.js') }}"></script>
<script> 
$(document).ready(function() {
    @if(isset($editapproval)) $('#editjobapproval').modal('show'); @endif
    @if(isset($editjob)) $('#editjob').modal('show'); @endif

    $('#desc_job').ckeditor();
    $('#desc_scopejob').ckeditor();
});
</script>
@endsection

@endsection