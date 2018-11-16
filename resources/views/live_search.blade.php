@extends('layouts.master')

@section('content')
<div class="container box">
   <h3 align="center">Live search in laravel using AJAX</h3><br />
   	<div class="panel panel-default">
    <div class="panel-heading">Search Customer Data</div>
	    <div class="panel-body">
	     	<div class="form-group">
	      		<input type="text" name="search" id="search" class="form-control" placeholder="Search Customer Data" />
	     	</div>

		    <div class="show"></div>
		    <div class="table-responsive">
		      	<h3 align="center">Total Data : <span id="total_records"></span></h3>
		      	<table class="table table-striped table-bordered">
			       	<thead>
				        <tr>
				         <th>jobpost_refNumber</th>
				         <th>City</th>
				         <th>State</th>
				         <th>Position</th>
				         <th>Skill</th>
				        </tr>
			       	</thead>
			       	<tbody>

			       	</tbody>
		      	</table>

					<section class="articles"> 
                    </section>
		    </div>
	    </div>    
   	</div>
</div> 
@endsection

@section('js')
<script> 
$(document).ready(function() {
  $('.show').removeClass('fa fa-spin fa-refresh fa-2x fa-tw');
  fetch_customer_data();

  function fetch_customer_data(query = '')
  { 
    $('.show').addClass('fa fa-spin fa-refresh fa-2x fa-tw');
    $.ajax({
     url:"{{ route('live_search.action') }}",
     method:'GET',
     data:{cite:query},
     dataType:'json',
     success:function(data)
     {

    $('.show').removeClass('fa fa-spin fa-refresh fa-2x fa-tw');
      $('tbody').html(data.table_data);
      $('#total_records').text(data.total_data);
      
      $('.articles').html(data.all);
      //console.log(data.all);
     }
    })
  }

  $(document).on('keyup', '#search', function(){
    var query = $(this).val();
    fetch_customer_data(query);

    //console.log(query);
  }); 
});  
</script>


@endsection