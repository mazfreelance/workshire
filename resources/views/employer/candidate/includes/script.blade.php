<script>  
$(function () {    
	$("select.chosen").chosen(); 
	$('.resume_attach').tooltip();

	$(document).on('click', '.buy_candidate', function(e){  
			e.preventDefault();
			var value = $(this).attr('data'); //&employer=1&seeker=1377&tokenVal=1&duration=30 days&type=FRESH 
			var url = "<?php echo url('employer/buy_candidate') ?>";
			$('#buy_candidate_modal').modal('show');  
			$(document).on('click', '.submit_buy', function(){  
				var bal = parseInt("<?php echo isset($currToken) ? $currToken->balance:''; ?>"); 
				var tokenVal = parseInt("<?php echo $duration->token_value ?>"); 
				var expired = Date.parse("<?php echo isset($currToken) ? $currToken->expired_date:''; ?>"); 
				var now = Date.now(); 
				if(now <= expired){ 
					if(bal >= tokenVal){ 
						$.ajax({
							url: url,
							type: 'get',
							data: value, 
							//async: false,
							dataType: 'json',
							success: function(data){   
								$.confirm({
									icon: 'fa fa-check-circle',
									theme: 'modern',
									closeIcon: true,
									animation: 'scale',
									type: 'green',
									title: 'You are successfully paid this candidate',
									content: 'Paid candidates list<br/>Your name > Paid candidates',
									buttons: {
											Okay: function (){
												//alert(data.redirect_url);
												location.reload(data.redirect_url+"/candidate-fresh");
												$('#buy_candidate_modal').modal('hide'); 
												$('.loading').show();
											}
									}
								}); 
							},
							error: function(xhr, status, error) {
								alert(xhr.responseText);
								$('#buy_candidate_modal').modal('hide');
							}
						});
					}else{ 
						$.confirm({
								icon: 'fa fa-times-circle',
								theme: 'modern',
								closeIcon: true,
								animation: 'scale',
								type: 'red',
								title: false,
								content: 'You have insufficient tokens for the amount requested. Your token balance is '+bal,
								buttons: {
										Okay: function (){}
								}
						}); 
					}
				}else{
					$.confirm({
							icon: 'fa fa-times-circle',
							theme: 'modern',
							closeIcon: true,
							animation: 'scale',
							type: 'red',
							title: false,
							content: 'Your package is expired, please buy a new one to continue your process.',
							buttons: {
									Okay: function (){}
							}
					}); 
				}

					
			}); 
	}); 

	$(document).on('click', 'a.workexp', function(){ 
		var query_workexp = $(this).attr('data');   
		var ajaxloader = '{{url('employer/candidate-operator')}}?search_working='+query_workexp;  
		
		//alert(ajaxloader);
		ajaxLoad(ajaxloader);   
		return false;
	});

	$(document).on('click', 'a.availability', function(){ 
		var query_availability = $(this).attr('data');   
		var ajaxloader = '{{url('employer/candidate-operator')}}?search_availability='+query_availability;  
		
		//alert(ajaxloader);
		ajaxLoad(ajaxloader);   
		return false;
	});

	$(document).on('click', 'a.gender', function(){
		var query_gender = $(this).attr('data'); 

		@if(Request::path() == 'employer/candidate-fresh')
		var ajaxloader = '{{url('employer/candidate-fresh')}}?search_gender='+query_gender;
		@elseif(Request::path() == 'employer/candidate-exp')
		var ajaxloader = '{{url('employer/candidate-exp')}}?search_gender='+query_gender;
		@elseif(Request::path() == 'employer/candidate-operator')  
		var ajaxloader = '{{url('employer/candidate-operator')}}?search_gender='+query_gender;
		@endif

		//alert(ajaxloader);
		ajaxLoad(ajaxloader);  
		return false;
	});

	$(document).on('click', 'a.edu_category', function(){
		var query_eduCate = $(this).attr('data');   
		
		@if(Request::path() == 'employer/candidate-fresh')
		var ajaxloader = '{{url('employer/candidate-fresh')}}?search_eduCate='+query_eduCate;
		@elseif(Request::path() == 'employer/candidate-exp')
		var ajaxloader = '{{url('employer/candidate-exp')}}?search_eduCate='+query_eduCate;
		@elseif(Request::path() == 'employer/candidate-operator')
		var ajaxloader = '{{url('employer/candidate-operator')}}?search_eduCate='+query_eduCate;
		@endif

		ajaxLoad(ajaxloader); 
		//alert(ajaxloader);   
		return false;
	});

	$(document).on('blur, change', '#fos_search', function(){
		var query_fos_search = $('#fos_search').val();   
		
		@if(Request::path() == 'employer/candidate-fresh')
		var ajaxloader = '{{url('employer/candidate-fresh')}}?search_fos_search='+query_fos_search;  
		@elseif(Request::path() == 'employer/candidate-exp')
		var ajaxloader = '{{url('employer/candidate-exp')}}?search_fos_search='+query_fos_search;  
		@elseif(Request::path() == 'employer/candidate-operator')
		var ajaxloader = '{{url('employer/candidate-operator')}}?search_fos_search='+query_fos_search;  
		@endif

		ajaxLoad(ajaxloader); 
		//alert(ajaxloader);   
		return false;
	});

	$(document).on('blur, change', '#state, #education, #institute', function(){
		var query_state = $('#state').val();  
		var query_education = $('#education').val();  
		var query_institute = $('#institute').val();  


		
	 	@if(Request::path() == 'employer/candidate-fresh')
	 	var ajaxloader = '{{url('employer/candidate-fresh')}}?search_state='+query_state
					 +'&search_education='+query_education
					 +'&search_institute='+query_institute; 
		@elseif(Request::path() == 'employer/candidate-exp')
		var ajaxloader = '{{url('employer/candidate-exp')}}?search_state='+query_state
					 +'&search_education='+query_education
					 +'&search_institute='+query_institute; 
		@elseif(Request::path() == 'employer/candidate-operator')
		var ajaxloader = '{{url('employer/candidate-operator')}}?search_state='+query_state
					 +'&search_education='+query_education
					 +'&search_institute='+query_institute; 
		@endif		

		ajaxLoad(ajaxloader); 
		//alert(ajaxloader);   
		return false;
	});

	/** REMOVE FILTER START **/  
	$(document).on('click', '.select_search_fos_search_remove', function(){  
		$('.cursor').addClass('cursorgrabbing'); 
		if($(this)) query_fos_search = '';   
		
		@if(Request::path() == 'employer/candidate-fresh')
		var ajaxloader = '{{url('employer/candidate-fresh')}}?search_fos_search='+query_fos_search;
		@elseif(Request::path() == 'employer/candidate-exp')
		var ajaxloader = '{{url('employer/candidate-exp')}}?search_fos_search='+query_fos_search;
		@elseif(Request::path() == 'employer/candidate-operator')
		var ajaxloader = '{{url('employer/candidate-operator')}}?search_fos_search='+query_fos_search;
     @endif

		ajaxLoad(ajaxloader);  
		return false;
	}); 

	$(document).on('click', '.select_search_institute_remove', function(){  
		$('.cursor').addClass('cursorgrabbing'); 
		if($(this)) query_institute = '';   
		
		@if(Request::path() == 'employer/candidate-fresh')
		var ajaxloader = '{{url('employer/candidate-fresh')}}?search_institute='+query_institute; 
		@elseif(Request::path() == 'employer/candidate-exp')
		var ajaxloader = '{{url('employer/candidate-exp')}}?search_institute='+query_institute; 
		@elseif(Request::path() == 'employer/candidate-operator')
		var ajaxloader = '{{url('employer/candidate-operator')}}?search_institute='+query_institute; 
    @endif

		ajaxLoad(ajaxloader);  
		return false;
	});  

	$(document).on('click', '.select_search_state_remove', function(){  
		$('.cursor').addClass('cursorgrabbing');
		if($(this)) query_state = '';   
		 
		@if(Request::path() == 'employer/candidate-fresh')
		var ajaxloader = '{{url('employer/candidate-fresh')}}?search_state='+query_state; 
		@elseif(Request::path() == 'employer/candidate-exp')
		var ajaxloader = '{{url('employer/candidate-exp')}}?search_state='+query_state; 
		@elseif(Request::path() == 'employer/candidate-operator')
		var ajaxloader = '{{url('employer/candidate-operator')}}?search_state='+query_state; 
		@endif

		ajaxLoad(ajaxloader);  
		return false;
	}); 

	$(document).on('click', '.select_search_education_remove', function(){  
		$('.cursor').addClass('cursorgrabbing');
		if($(this)) query_education = '';

		@if(Request::path() == 'employer/candidate-fresh')
		var ajaxloader = '{{url('employer/candidate-fresh')}}?search_education='+query_education; 
		@elseif(Request::path() == 'employer/candidate-exp')
		var ajaxloader = '{{url('employer/candidate-exp')}}?search_education='+query_education; 
		@elseif(Request::path() == 'employer/candidate-operator')
		var ajaxloader = '{{url('employer/candidate-operator')}}?search_education='+query_education;
		@endif

		ajaxLoad(ajaxloader);  
		return false;
	});  
	/** REMOVE FILTER END **/

	//ajaxLoad function
	function ajaxLoad(filename, content){
			$('.loading').show();
			content = typeof content !== 'undefined' ? content : 'content';
			//alert(filename+"\n"+content);
			$.ajax({
					type: "GET",
					url: filename,
					contentType: false,
					success: function (data) {
						//console.log(data);
						$("#" + content).html(data);
						$('.loading').hide(); 
					},
					error: function (xhr, status, error) {
						alert(xhr.responseText);

						console.log(xhr.responseText);
					}
			});
	}
}); 
</script>