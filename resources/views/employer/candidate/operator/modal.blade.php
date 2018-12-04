<div class="modal fade" tabindex="-1" role="dialog" id="buy_candidate_modal">
  	<div class="modal-dialog modal-sm" role="document">
	    <div class="modal-content">
	      	<div class="modal-header">
	        	<h5 class="modal-title" id="buy_candidateLabel">
	        		Buy candidate profile
	        	</h5>
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          		<span aria-hidden="true">&times;</span>
	        	</button>
	      	</div>
	      	<div class="modal-body">
	        	<h5>Your remaining tokens:  {{-- $currToken->balance --}}
	        		<a href="{{route('employer.setting.plan')}}" class="small">Add topup</a>
	        	</h5>
				<div>
					Click "Buy" to purchase <span class="font-weight-bold">or</span> "Abort" to cancel the purchasing.
				</div> 
				<div class="d-sm-flex justify-content-center mt-2">
					<button class="btn btn-md btn-danger" data-dismiss="modal">Abort</button>
					<button type="button" id="" class="btn btn-md btn-primary submit_buy ml-3">Buy</button>
				</div>
				<hr>
				<div class="small font-italic">
					Notes: <span class="font-weight-bold">{{ $duration->token_value }}</span> token will be deduct after purchase the profile. This profile available to view for <span class="font-weight-bold">{{ $duration->duration }}</span> after purchase.
				</div>
	      	</div> 
    	</div>
  	</div>
</div>