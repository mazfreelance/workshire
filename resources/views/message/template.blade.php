@extends('layouts.master')

@section('title', 'Message')
@section('css')
<style>
	a.msg_anc{text-decoration: none !important;}
	a.msg_anc:hover{background: blue;}
</style>
@endsection
@section('content')   
<style>
.container {
	margin-top: 20px;
	margin-bottom: 20px;
}

.list-group-item {
	padding: .25rem 1.25rem;
}

.fullname {
	min-width: 120px;
	display: inline-block;
}
</style>
<main class="py-0">  
	<div class="container">
	 	<div class="row">
	  		<!-- First row -->
	  		<div class="col-12 col-sm-12 col-md-3 col-lg-2">
			   	<!-- Left column (First row) -->
			   	<a href="#" class="btn btn-danger btn-primary btn-block">
			    	<i class="fa fa-edit"></i> Compose
			   	</a>
	  		</div>
		  	<div class="col-12 col-sm-12 col-md-9 col-lg-10">
			   	<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
				    <button type="button" class="btn btn-secondary">&nbsp;<i class="fas fa-sync-alt" aria-hidden="true"></i>&nbsp;</button>
				    <button type="button" class="btn btn-secondary">&nbsp;<i class="fa fa-star" aria-hidden="true"></i>&nbsp;</button>
			   	</div>
			   	<div class="btn-group" role="group">
				    <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" 
				    	data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						More
					</button>
				    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
						<a class="dropdown-item" href="#">Action</a>
						<a class="dropdown-item" href="#">Another action</a>
						<a class="dropdown-item" href="#">Something else here</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="#">Separated link</a>
				    </div>
			   	</div>

			   	<!-- Right side buttons -->
			   	<div class="float-right">
					<button type="button" class="btn btn-secondary">&nbsp;<i class="fa fa-cog" aria-hidden="true"></i>&nbsp;</button>
					<button type="button" class="btn btn-secondary">&nbsp;<i class="fa fa-bars" aria-hidden="true"></i>&nbsp;</button>
			   	</div>
		   		<!-- END: Right side buttons -->
			</div>
	  		<!-- END: Right column -->
		</div>
	 	<!-- END: first row -->
		<hr>
	 	<div class="row">
			<!-- Sencond row -->
			<div class="col-12 col-sm-12 col-md-3 col-lg-2">
			   	<!-- LEFT COLUMN Menu (Sencond row) -->
				<ul class="list-group">
			    <!-- Menu --> 
				    <li class="list-group-item justify-content-between active">
				     	Inbox 
				     	<span class="badge badge-pill badge-dark">1</span>
				    </li>
				    <li class="list-group-item justify-content-between">
				     	Important
				     	<span class="badge badge-default badge-pill">2</span>
				    </li>
				    <li class="list-group-item justify-content-between">
				     	Sent
				     	<span class="badge badge-default badge-pill">1</span>
				    </li>
				    <li class="list-group-item justify-content-between">
				     	Spam
				    </li>
			   	</ul>
			   <!-- End left menu -->
			</div>
			<!-- END: Left column (Second row) -->
	  		<div class="col-12 col-sm-12 col-md-9 col-lg-10">
			   <!-- Tabs -->
			   	<ul class="nav nav-tabs">
				    <li class="nav-item">
				     	<a class="nav-link active" href="#"><i class="fa fa-inbox"></i>&nbsp;&nbsp;Inbox</a>
				    </li> 
			   	</ul>
	   			<!-- END: Tabs -->
	   			<div style="height:250px;overflow-y: scroll;">
				@if(count($msgs) > 0)
					@foreach($msgs as $msg)
					<div class="list-group"> 
		    			<li class="list-group-item d-flex justify-content-start">
					     	<div class="checkbox">
						      	<input type="checkbox">
					     	</div>

				     		&nbsp;&nbsp;<span class="far fa-star"></span>&nbsp;&nbsp;
					     	<span class="name fullname">Admin</span>
					     	<span class="">{!!$msg->msgText!!}</span> 
					     	<span class="ml-auto p-2"> 
					     		<span class="badge badge-default badge-pill">{{date('d M y H:i', strtotime($msg->created_at))}}</span>
				     		</span>
					    </li> 
		   			</div>
				    @endforeach
				@else

				@endif
				</div>
	  		</div>
		 </div>
	 	<!-- END: Second row -->
	</div>
	<!-- END: container -->
</main>
<!-- Footer -->  
@include('includes.footer') 

@endsection