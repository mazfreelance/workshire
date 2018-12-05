<div class="row">   
	<div class="col-sm col-md">  
		<div class="btn-group float-right"> 
            <?php 
            	if(in_array($paids->seeker_id, $final_exp) )
            		$dur = $duration[1];
            	else 
            		$dur = $duration[0];
            ?>   
			@if( date('Y-m-d', strtotime($paids->expiredDate)) < date('Y-m-d')) 
                <a class="btn btn-outline-primary btn-sm buy_candidate" href="" 
            		data="&employer={{Auth::guard('employer')->user()->employer[0]->id}}
        				&seeker={{$paids->seeker_id}}
        				&tokenVal={{$dur->token_value}}
        				&duration={{$dur->duration}}
        				&type={{$paids->position}}
        				&statBuy=Renew
        				&paidID={{$paids->id}}"
        			data-duration="{{$dur->duration}}"
        			data-token="{{$dur->token_value}}">
                	Renew
                </a>  
                <!-- Modal #buy_candidate -->
                @include('employer.candidate.paid.modal')
			@endif
        </div>
		<h4 class="text-uppercase">{{$paids->name}}</h4> 
	</div>
</div>	
<div class="row"> 		
	<div class="col-sm col-md">
		<h6><i class="fa fa-map-marker-alt"></i>&nbsp;
			@if($paids->district != '')
				{{$paids->poscode.' '.$paids->district.', '.$paids->state}}
			@else
				{{$paids->poscode.' '.$paids->state}}
			@endif
		</h6>
	</div>
</div>
<div class="row"> 
	<div class="col-sm col-md">
		<h6>
			<i class="fa fa-birthday-cake"></i>&nbsp; 
			<?php
				$nric = $paids->nric;
				if(strlen($nric) == 12){
					$array = str_split($nric,6); 
					$array1 = str_split($nric,2);  
					$array2 = str_split($nric,4);  

					$rawDOB = $array[0]; //901010
					$arrayDOB = str_split($rawDOB,2); 
					//echo $arrayDOB[0].'\n'..'\n'.$arrayDOB[2]; 
					$date = $arrayDOB[0]; 
					$dates = DateTime::createFromFormat('y', $date); 
					$year = $dates->format('Y');    
					$breakDOB = $year.'-'.$arrayDOB[1].'-'.$arrayDOB[2];
					$DOB = $arrayDOB[2].'/'.$arrayDOB[1].'/'.$year;


					//$age = date('Y-m-d') - date('Y-m-d', strtotime($breakDOB));
					$tz  = new DateTimeZone('Asia/Kuala_Lumpur');
					$age = DateTime::createFromFormat('d/m/Y', $DOB, $tz)
					     ->diff(new DateTime('now', $tz))
					     ->y; 
				} 
			?>
			{{$age.' years old'}} 
			&nbsp;<i class="fa fa-user"></i>&nbsp;{{$paids->gender=='M'?'Male':'Female'}} 
		</h6>
	</div>
</div>
<div class="row"> 		
	<div class="col-sm col-md small"> 
		@if($paids->availability_work != '')  
	 	<div>
	 		<i class="fa fa-check"></i>&nbsp;
	  		{{ $paids->availability_work }} 
	  	</div> 
		@endif 
		<h6 class="small">  
			@if( date('Y-m-d', strtotime($paids->expiredDate)) < date('Y-m-d') )
			<span class="badge badge-danger"><i class="fa fa-info-circle"></i>  Expired</span> 
			@else 
				@if( $paids->buy_stat == 'New' )
				<span class="badge badge-success"><i class="fa fa-info-circle"></i>  Paid</span>
				<span>(Last date: {{ date('M d, Y', strtotime($paids->expiredDate)) }})</span>
				@else
				<span class="badge badge-primary"><i class="fa fa-info-circle"></i>  Renew</span>
				<span>(Last date: {{ date('M d, Y', strtotime($paids->expiredDate)) }})</span>
				@endif
			@endif 
		</h6> 
	</div>  
</div> 
<hr>