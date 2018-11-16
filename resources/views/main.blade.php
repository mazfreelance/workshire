@extends('layouts.master')

@section('title', 'Explore Opportunities')

@section('content')     
<main class="py-0">  
	@guest
		@include('includes.slider')  
	@else
		@if(Auth::check() && Auth::user()->role->id == 1) 
		<div class="row bg-third border border-bottom-primary py-2 pl-sm-4 mr-0"> 
			<div class="container">
				<div class="row mx-1">
					<div class="col-sm-6 col-md-3"> 
						<div class="input-group">
						  	<div class="input-group-prepend">
						    	<button class="btn btn-sm btn-secondary border-right-0 border" type="submit" onclick="ajaxLoad('{{url('search-job')}}?search_job='+$('#search_job').val())">
						    		<span class="fa fa-search"></span>
						    	</button>
						  	</div>
							<input class="form-control form-control-sm py-2 border-left-0 border" type="text" placeholder="Search Jobs..." name="search_job" id="search_job" value="{{ request()->session()->get('search') }}" onkeydown="if (event.keyCode == 13) ajaxLoad('{{url('search-job')}}?search_job='+this.value)"/> 
						</div>

						<!--
						<input class="form-control" id="search"
                       value="{{ request()->session()->get('search') }}"
                       onkeydown="if (event.keyCode == 13) ajaxLoad('{{url('posts')}}?search='+this.value)"
                       placeholder="Search Title" name="search"
                       type="text" id="search"/>
                <div class="input-group-btn">
                    <button type="submit" class="btn btn-primary"
                            onclick="ajaxLoad('{{url('posts')}}?search='+$('#search').val())">
                            <i class="fa fa-search" aria-hidden="true"></i>
                    </button>
                </div>

						-->
					</div> 
					<div class="col-sm-6 col-md-3">  
						<select class="form-control form-control-sm border" name="job_cat" id="job_cat">
							<option value="" selected="">Job Category</option>
							<?php 
							$jobCats2 = ['General', 'Management', 'Manufacturing Engineering', 'Construction Engineering', 'Finance & Accounting', 'Human Resources & Administration', 'Information Technology & Multimedia', 'Art & Design', 'Legal', 'Education & Teaching', 'Sale & Marketing', 'Hotel Management & Hospitality', 'Sciences & Mathematics', 'Agriculture', 'Healthcare'];
							sort($jobCats2);
							?>
							@foreach($jobCats2 as $jobCat)
								<option value="{{$jobCat}}">{{$jobCat}}</option>
							@endforeach
							<!--
							@foreach($jobCats as $jobCat)
								<option value="{{$jobCat->category_name}}">{{$jobCat->category_name}}</option>
							@endforeach
							-->
						</select>
					</div> 
					<div class="col-sm-6 col-md-3">  
						<select class="form-control form-control-sm border" name="state" id="state">
							<option value="" selected="">Entire Malaysia</option>
							@foreach($state_array as $state)  
					        	<option value="{{$state->state_name}}">{{$state->state_name}}</option>
							@endforeach
						</select>
					</div> 

					<div class="col-sm-6 col-md-3">  
						<select class="form-control form-control-sm border" name="emp_type"  id="emp_type">
							<option value="" selected>Employment Type</option>
							@foreach($empType_array as $empType)  
					        	<option value="{{$empType->emp_type}}">{{$empType->emp_type}}</option>
							@endforeach
						</select>
					</div> 
				</div>
			</div>
		</div>   

		<div class="row mt-1 py-2 pl-sm-4 mr-0 mx-0"> 
			<div class="col-sm col-md-9"> 
				<div class="row pl-sm-5 mt-3">
					<div class="col-sm col-md">
						{{$jobposts->total()}} jobs available. 
					</div>
					<div class="col-sm col-md text-sm-right"> 
						Page {{$jobposts->count()}} of {{$jobposts->total()}}
					</div>
				</div> 
				@if($jobposts->total() == 0)
				<hr class="ml-sm-5">
				<div class="row ml-sm-5">
					<img src="{{url('images/icon/search_not_found.png')}}" style="margin-top: -3em" class="" />
				</div>
				@else
					@foreach ($jobposts as $jobpost) 
					<hr class="ml-sm-5">
					<div class="row pl-sm-5">
						<div class="col-sm col-md-3"> 
							@if (file_exists('images/default_pic/'.$jobpost->employerDetailBySeq->emp_logo_loc) and $jobpost->employerDetailBySeq->emp_logo_loc != '')
							<img src="images/default_pic/{{ $jobpost->employerDetailBySeq->emp_logo_loc }}" class="img-fluid img-rounded border border-dark" width="150"> 
							@else
							<img src="https://www.w3schools.com/bootstrap/cinqueterre.jpg" class="img-fluid img-rounded border border-dark" width="150">
							@endif
						</div>
						<div class="col-sm col-md py-1">
							<div class="col-sm col-md">
								<a href="ViewJob/{{str_replace(' ', '-', $jobpost->jobpost_position)}}/{{$jobpost->jobpost_seq}}" target="_blank">
									<h4>{{$jobpost->jobpost_position}}</h4>
								</a>
							</div>
							<div class="col-sm col-md">
								<h6>
									<i class="fa fa-building"></i>{!!ucwords(strtolower($jobpost->employerDetailBySeq->emp_name))!!}
								</h6>
							</div>
							<div class="col-sm col-md"><h6><i class="fa fa-map-marker"></i> {{$jobpost->jobpost_loc_city}}, {{$jobpost->jobpost_loc_state}}</h6></div>
							<div class="col-sm col-md small">
								<span><i class="fa fa-tag"></i> {!!$jobpost->jobpost_emp_type!!}</span>
								<span class="float-right">MYR {{$jobpost->jobpost_minSalary}} - {{$jobpost->jobpost_maxSalary}}</span>
							</div>
							<div class="col-sm col-md small">
								<span><i class="fa fa-clock"></i> Posted on {{date('jS M Y, H:i:s a', strtotime($jobpost->jobpost_startDate))}}

								</span>
								<span class="float-right">/ month</span>
							</div>
						</div>
					</div>
					@endforeach  
				@endif
				<!--Pagination -->
				<nav aria-label="pagination" class="mt-2 d-flex justify-content-center">
					{{ $jobposts->links('vendor.pagination.bootstrap-4') }}
				</nav>    
			</div> 
			<div class="col-sm col-md-3 border border-right-0 border-top-0 border-bottom-0 border-secondary pl-sm-2 pl-4 mt-2">
				<span class="d-block text-center mt-2 text-primary font-weight-bold">ADVANCED SEARCH</span>
				<hr> 
				<center>
					<button type="button" class="btn btn-outline-primary btn-md d-block mb-1">Fresh Graduate</button>
					<button type="button" class="btn btn-outline-danger btn-md d-block mb-1">Experience</button>
					<button type="button" class="btn btn-outline-success btn-md d-block mb-1">Internship</button>
					<button type="button" class="btn btn-outline-info btn-md d-block">SPM Leave</button>
				</center>
				<hr> 
				<div class="row justify-content-center"> 
					<div class="form-row"> 
					    <div class="form-group col-md">
					      	<label class="d-block text-center">Job Level</label> 
							<select class="custom-select" name="post_level" id="post_level">
								<option value="" selected>Select One..</option> 
								@foreach($poslvl_array as $poslvl)  
						        	<option value="{{$poslvl->post_level}}">{{$poslvl->post_level}}</option>
								@endforeach
							</select>
					    </div>
				  	</div>
				</div>
				<hr> 
				<div class="row justify-content-center"> 
					<div class="form-row"> 
					    <div class="form-group col-md">
					      	<label class="d-block text-center">Salary (MYR)</label> 
							<select class="custom-select" name="salary" id="salary">
								<option value="" selected>Select One..</option>
								@foreach($salarys as $salary)  
						        	<option value="{{$salary->rangeValue}}">{{$salary->rangeFrom}} - {{$salary->rangeTo}}</option>
								@endforeach
							</select>
					    </div>
				  	</div>
				</div> 
			</div>
		</div> 
		@endif
		@if(Auth::check() && Auth::user()->role->id == 2)

			@include('includes.slider')  
			asd
			
		@endif
	@endguest
</main>
<!-- Footer -->  
@include('includes.footer')  
@endsection


@section('js')
<script>
  /*ajax 2*/
  $(document).on('click', 'a.page-link', function (event) {
      event.preventDefault();
      ajaxLoad($(this).attr('href'));
  });

  $(document).on('submit', 'form#frm', function (event) {
      event.preventDefault();
      var form = $(this);
      var data = new FormData($(this)[0]);
      var url = form.attr("action");
      $.ajax({
          type: form.attr('method'),
          url: url,
          data: data,
          cache: false,
          contentType: false,
          processData: false,
          success: function (data) {
              $('.is-invalid').removeClass('is-invalid');
              if (data.fail) {
                  for (control in data.errors) {
                      $('#' + control).addClass('is-invalid');
                      $('#error-' + control).html(data.errors[control]);
                  }
              } else {
                  ajaxLoad(data.redirect_url);
              }
          },
          error: function (xhr, textStatus, errorThrown) {
              alert("Error: " + errorThrown);
          }
      });
      return false;
  });

  $(document).on('blur', '#search_job', function(){
    var query = $(this).val(); 
    ajaxLoad('{{url('search-job')}}?search_job='+query); 
  }); 

  function ajaxLoad(filename, content) {
      console.log(filename+"\n"+content);
      content = typeof content !== 'undefined' ? content : 'content';
      $('.loading').show();
      $.ajax({
          type: "GET",
          url: filename,
          contentType: false,
          success: function (data) {
              $("#" + content).html(data);
              $('.loading').hide();
          		console.log(data);
          },
          error: function (xhr, status, error) {
              alert(xhr.responseText);

              console.log(xhr.responseText);
          }
      });
  }

  function ajaxDelete(filename, token, content) {
      content = typeof content !== 'undefined' ? content : 'content';
      $('.loading').show();
      $.ajax({
          type: 'POST',
          data: {_method: 'DELETE', _token: token},
          url: filename,
          success: function (data) {
              $("#" + content).html(data);
              $('.loading').hide();
          },
          error: function (xhr, status, error) {
              alert(xhr.responseText);
          }
      });
  }
</script> 
@endsection