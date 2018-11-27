@extends('layouts.master') 
@section('title', 'Profile View')

@section('content')     
<main class="py-0">  
	<div class="row my-1 mx-2">
		<div class="col-sm-12">
			<h3>Profile</h3>
			<hr style="height:1px;border-width:0;background-color:#6066c4">
		</div> 
		<div class="col-sm ml-sm-2"> 
		    <div class="row my-1 pt-2 shadow p-3 bg-white rounded" style="background-color:#fff;">
		        <div class="col-lg-8 order-lg-2">
		            @include('seeker.profile.includes.menutab')
		            <div class="tab-content py-4"> 
		                <div class="tab-pane active" id="messages">
		                    <div class="alert alert-info alert-dismissable">
		                        <a class="panel-close close" data-dismiss="alert">×</a> This is an <strong>.alert</strong>. Use this to show important messages to the user.
		                    </div>
		                    <table class="table table-hover table-striped">
		                        <tbody>                                    
		                            <tr>
		                                <td>
		                                   <span class="float-right font-weight-bold">3 hrs ago</span> Here is your a link to the latest summary report from the..
		                                </td>
		                            </tr>
		                            <tr>
		                                <td>
		                                   <span class="float-right font-weight-bold">Yesterday</span> There has been a request on your account since that was..
		                                </td>
		                            </tr>
		                            <tr>
		                                <td>
		                                   <span class="float-right font-weight-bold">9/10</span> Porttitor vitae ultrices quis, dapibus id dolor. Morbi venenatis lacinia rhoncus. 
		                                </td>
		                            </tr>
		                            <tr>
		                                <td>
		                                   <span class="float-right font-weight-bold">9/4</span> Vestibulum tincidunt ullamcorper eros eget luctus. 
		                                </td>
		                            </tr>
		                            <tr>
		                                <td>
		                                   <span class="float-right font-weight-bold">9/4</span> Maxamillion ais the fix for tibulum tincidunt ullamcorper eros. 
		                                </td>
		                            </tr>
		                        </tbody> 
		                    </table>
		                </div> 
		            </div>
		        </div>
		        <div class="col-lg-4 order-lg-1 text-center">
		            @include('seeker.profile.includes.dp')
		        </div>
		    </div> 

			 
		</div> 
	</div> 
</main>
	@include('seeker.profile.includes.script') 
	<!-- Footer -->  
	@include('includes.footer') 

@endsection 