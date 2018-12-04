<div class="modal fade" tabindex="-1" role="dialog" id="buy_candidate_modal">
  	<div class="modal-dialog modal-sm" role="document">
	    <div class="modal-content">
	      	<div class="modal-header">
	        	<h5 class="modal-title" id="buy_candidateLabel">
	        		Renew candidate profile 
	        	</h5>
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          		<span aria-hidden="true">&times;</span>
	        	</button>
	      	</div>
	      	<div class="modal-body">
	        	<h5>
	        		Your remaining tokens:  {{ isset($currToken) ? $currToken->balance : 'Please add new token to proceed'}} 
	        	</h5> 
	        	<a href="" class="small">Add topup</a>
				<div>
					Click "Renew" to purchase <span class="font-weight-bold">or</span> "Abort" to cancel the purchasing.
				</div> 
				<div class="d-sm-flex justify-content-center mt-2">
					<button class="btn btn-md btn-danger" data-dismiss="modal">Abort</button>
					@if( date('Y-m-d', strtotime($currToken->expired_date)) < date('Y-m-d'))
				 		<button type="button" class="btn btn-md btn-primary ml-3" disabled>Renew</button> 
					@else
						<button type="button" class="btn btn-md btn-primary submit_buy ml-3">
							Renew
						</button>  
					@endif
				</div>
				<hr>
				<div class="small font-italic">
					Notes: <span class="font-weight-bold" id="token_value"></span> token will be deduct after purchase the profile. This profile available to view for <span class="font-weight-bold" id="dur_token"></span> after purchase.
					@if( date('Y-m-d', strtotime($currToken->expired_date)) < date('Y-m-d'))
					<span class="d-block text-danger">
						Your package is expired, buy new one to continue the process.
					</span>
					@endif
				</div>
	      	</div> 
    	</div>
  	</div>
</div>