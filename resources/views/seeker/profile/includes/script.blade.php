@section('js') 
<script type="text/javascript" src="{{ asset('public/js/jquery.printPage.js') }}"></script>
<script>
	$('[data-toggle="tooltip"]').tooltip();
	var resume_updated = $('input[name="resume_updated"]').val();
	var moment_resume = moment(resume_updated).calendar();
	$('#updateresumejs').text(moment_resume);

	var profile_updated = $('input[name="profile_updated"]').val();
	var moment_profile = moment(profile_updated).calendar();
	$('#updateprofilejs').text(moment_profile);

	<?php if(isset($seek)){ ?>
	$(document).ready(function(){
		var raw = $('#dob').val();
		var years = moment().diff(raw, 'years',false);  
		$('#dobTxt').text(years);

		$(".btnPrint").printPage({
	      url: "{{ URL::to('profile/print').'/'.encrypt($seek->id) }}",
	      attr: "href",
	      message:"Your document is being created"
	    }) 
	});
	<?php } ?>

	//validation

	if($("#ic_type1").prop("checked")){
		$("#nric_field").show();
	}else if($("#ic_type2").prop("checked")){
		$("#passport_field").show();
	}
	$(document).on("change", "#ic_type1", function(event){
		event.preventDefault(); 
		if($(this).val() == "malay") {
			$("#nric_field").show();
			$("#passport_field").hide();
			$('#error-passport').hide();
		}
	}); 
	$(document).on("change", "#ic_type2", function(event){
		event.preventDefault();  
		if($(this).val() == "non malay"){
			$("#passport_field").show();
			$("#nric_field").hide(); 
			$('#error-nric_full').hide();
		}
	});  

	$(document).on('keyup', '#nric_date, #nric_state, #nric_ic', function(e){
		e.preventDefault();

		var nric_date = $('#nric_date').val();
		var nric_state = $('#nric_state').val();
		var nric_ic = $('#nric_ic').val();
		var full = nric_date+''+nric_state+''+nric_ic;
		$('#nric_full').val(full);
	});
 
	$(document).on('change, keyup', '#seeker_zip' , function(e){
		e.preventDefault();
	    var data = "zip="+$(this).val()+"&_token={{CSRF_TOKEN()}}";   
	    $.ajax({
	        url: "{{route('poskod')}}",
	        data: data,
	        cache: false,
	        contentType: false,
	        processData: false,
	        success: function (data) {   
	        	$('#seeker_city').val(data.kawasan);
	        	$('#seeker_state').val(data.negeri);
	        },
	        error: function (xhr, textStatus, errorThrown){
	            //alert("Error: " + errorThrown);
	            $.alert({
	                icon: 'fa fa-times-circle',
	                theme: 'modern',
	                type: 'red',
	                title: 'Fail to generate states',
	                content: xhr.responseText,
	                confirm: function(){}
	            });
	        }
	    }); 
	});  

	$(document).on('change', '#highEdu' , function(e){
		e.preventDefault();
		var highEdu = $(this).val();
		highEdu == 'SPM' ? $('#major').prop('disabled', true) : $('#major').prop('disabled', false);

	}); 

	//achievement 
	$('#achievement_grade').hide();
	$('#achievement_cgpa').hide();
	$('#achievement_class').hide();

	if($("#grade").prop("checked")){  
        $('#achievement_grade').show();
		$('#achievement_cgpa').hide();
		$('#achievement_class').hide();  

		$('#error-achievement_grade').show();
		$('#error-achievement_cgpa').hide();
		$('#error-achievement_class').hide();

        $('#achievement_grade').on('blur keyup change', function(){ 
            var achievement_grade = $(this).val();
            if(achievement_grade != ''){   
                $('#achievement_cgpa').val('0.00');  
                $('#achievement_class').val(''); 
            }  
        });  
    }
    else if($("#cgpa").prop("checked")) {   
        $('#achievement_grade').hide();
		$('#achievement_cgpa').show();
		$('#achievement_class').hide(); 

		$('#error-achievement_grade').hide();
		$('#error-achievement_cgpa').show();
		$('#error-achievement_class').hide();

        $('#achievement_cgpa').on('blur keyup change', function(){ 
            var achievement_cgpa = $(this).val();
            if(achievement_cgpa != ''){    
                $('#achievement_grade').val('');  
                $('#achievement_class').val('');  
            }  
        });  
    }
    else if($("#class").prop("checked")) {   
        $('#achievement_grade').hide();
		$('#achievement_cgpa').hide();
		$('#achievement_class').show();  

		$('#error-achievement_grade').hide();
		$('#error-achievement_cgpa').hide();
		$('#error-achievement_class').show();

        $('#achievement_class').on('blur keyup change', function(){ 
            var achievement_class = $(this).val();
            if(achievement_class != ''){    
                $('#achievement_grade').val('');  
                $('#achievement_cgpa').val('0.00');  
            }  
        }); 
    }

    $('#grade, #cgpa, #class').on('change', function(){ 
        if($("#grade").prop("checked")){  
	        $('#achievement_grade').show();
			$('#achievement_cgpa').hide();
			$('#achievement_class').hide();  

			$('#error-achievement_grade').show();
			$('#error-achievement_cgpa').hide();
			$('#error-achievement_class').hide();

	        $('#achievement_grade').on('blur keyup change', function(){ 
	            var achievement_grade = $(this).val();
	            if(achievement_grade != ''){   
	                $('#achievement_cgpa').val('0.00');  
	                $('#achievement_class').val(''); 
	            }  
	        });  
	    }
	    else if($("#cgpa").prop("checked")) {   
	        $('#achievement_grade').hide();
			$('#achievement_cgpa').show();
			$('#achievement_class').hide(); 

			$('#error-achievement_grade').hide();
			$('#error-achievement_cgpa').show();
			$('#error-achievement_class').hide();

	        $('#achievement_cgpa').on('blur keyup change', function(){ 
	            var achievement_cgpa = $(this).val();
	            if(achievement_cgpa != ''){    
	                $('#achievement_grade').val('');  
	                $('#achievement_class').val('');  
	            }  
	        });  
	    }
	    else if($("#class").prop("checked")) {   
	        $('#achievement_grade').hide();
			$('#achievement_cgpa').hide();
			$('#achievement_class').show();  

			$('#error-achievement_grade').hide();
			$('#error-achievement_cgpa').hide();
			$('#error-achievement_class').show();

	        $('#achievement_class').on('blur keyup change', function(){ 
	            var achievement_class = $(this).val();
	            if(achievement_class != ''){    
	                $('#achievement_grade').val('');  
	                $('#achievement_cgpa').val('0.00');  
	            }  
	        }); 
	    }
    });

    $('#survey').on('change', function(){ 
    	if($(this).val() == 'Other'){
    		$('#other_survey').prop('disabled', false); 
    	}else{ 
    		$('#other_survey').prop('disabled', true);
    		$('#other_survey').val('');
    	}
    });

	//skill 
	var template_add_skill = '<div class="form-group category-skill my-1">'
							+  '	<div class="input-group">'
							+  '		<input class="form-control" type="text" name="skill[]" id="skill" placeholder="eg: Commnunication"/>'        
							+  '		<span class="input-group-btn">'
							+  '			<a class="btn btn-danger btn-remove-skill"><i class="fa fa-times" aria-hidden="true"></i></a>'
							+  '		</span>'
							+  '	</div>'
							+  '</div>';    
	$(document).on('click', '.btn-add-more-skill', function(e) { 
		e.preventDefault();
		$('.onerowskill').before(template_add_skill); 
	});   
	$(document).on('click', '.btn-remove-skill', function(e) { 
		e.preventDefault();
		$(this).parents('.category-skill').remove();
	}); 

	$(document).on('click, change', '#lang', function(e){
 		e.preventDefault(); 
 		$('#lang :selected').each(function(i, sel){  
		    $(sel).val() == 'Other' ? $('#other_language').prop('disabled', false) : $('#other_language').prop('disabled', true);
		}); 
 	});
 	$('#lang :selected').each(function(i, sel){  
	    $(sel).val() == 'Other' ? $('#other_language').prop('disabled', false) : $('#other_language').prop('disabled', true);
	}); 

 	/* COMPLETE PROFILE */
	$('.completeprof').show();
	$(document).on('click', '.updProf', function(e){
		e.preventDefault();
		$('.completeprof').toggle();
	});
	
	/*===========================================================*/ 
	//submittion edit profile
	$(document).on('submit', 'form#editprofile', function (event){
		event.preventDefault();
		$('.loading').show();
	    var form = $(this);
	    var data = new FormData($(this)[0]);
	    var url = form.attr("action");
	    var method = form.attr("method");
	    $.ajax({
	        type: method,
	        url: url,
	        data: data,
	        cache: false,
	        contentType: false,
	        processData: false,
	        success: function (data) { 
	            $('.is-invalid').removeClass('is-invalid');
	            if (data.fail) { 
	            	$.each(data.errors, function (key, value) {  
					  	if(key.indexOf(".") != -1){
						    var arr = key.split("."); 
	                   	 	$("input[name='"+arr[0]+"[]']:eq("+arr[1]+")").addClass('is-invalid');
		                    $("input[name='"+arr[0]+"[]']:eq("+arr[1]+")").focus(); 
		                    $('#error-' + arr[0]).html(value[0]);  
					  	} 
					  	if(key == 'seektype' || key == 'travel' || key == 'gender'){
					  		$('input[name="' + key + '"]').addClass('is-invalid');
		                   	$('#error-' + key).html(value);
					  	}
	                    $('#' + key).addClass('is-invalid');
	                    $('#error-' + key).html(value);
	                    $('#' + key).focus();
					});  
	                $('.loading').hide();
	            } else {   
	                $.confirm({
	                    icon: 'fa fa-check-circle',
	                    theme: 'modern',
	                    type: 'green',
	                    title: false,
	                    content: '<p>Successfully saved job. Your job post will be approval soon during working days. Thank you and continue keep to support us.</p>',
	                    buttons:{
	                        okay: function(){   
	                            location.replace(data.redirect_url);   
	                            //alert(data.redirect_url);   
	                            //$('.loading').hide();
	                        }
	                    }
	                }); 
	            }
	        },
	        error: function (xhr, textStatus, errorThrown){
	            //alert("Error: " + errorThrown);
	            $.alert({
	                icon: 'fa fa-times-circle',
	                theme: 'modern',
	                type: 'red',
	                title: 'Fail to save job',
	                content: xhr.responseText,
	                confirm: function(){}
	            });
	        }
	    });   
	});

	//submittion jobfair
	$(document).on('submit', 'form#jobfairform', function (event){
		$('.loading').show();
		event.preventDefault(); 
	    var form = $(this);
	    var data = new FormData($(this)[0]);
	    var url = form.attr("action");
	    var method = form.attr("method");
	    $.ajax({
	        type: method,
	        url: url,
	        data: data,
	        cache: false,
	        contentType: false,
	        processData: false,
	        success: function (data) { 
	            $('.is-invalid').removeClass('is-invalid');
	            if (data.fail) { 
	            	$.each(data.errors, function (key, value) {  
					  	if(key=='nric_full' || key=='passport'){  
	                    	$('input[name="ic_type"]').addClass('is-invalid');
					  	}
					  	if(key=='achievement_grade' || key=='achievement_cgpa' || key=='achievement_class'){
							$('input[name="achieve"]').addClass('is-invalid');
						} 
                    	$('#' + key).addClass('is-invalid');
                    	$('#error-' + key).html(value);
                    	//$('#' + key).focus();   
					});  
	                $('.loading').hide();
	            } else {   
	                $.confirm({
	                    icon: 'fa fa-check-circle',
	                    theme: 'modern',
	                    type: 'green',
	                    title: false,
	                    content: '<p>Successfully signed up. Email verification sent.</p>',
	                    buttons:{
	                        okay: function(){   
	                            location.replace(data.redirect_url);   
	                            //alert(data.redirect_url);   
	                            //$('.loading').hide();
	                        }
	                    }
	                }); 
	            }
	        },
	        error: function (xhr, textStatus, errorThrown){
	            //alert("Error: " + errorThrown);
	            $.alert({
	                icon: 'fa fa-times-circle',
	                theme: 'modern',
	                type: 'red',
	                title: 'Fail to sign up',
	                content: xhr.responseText,
	                confirm: function(){}
	            });
	        }
	    });   
	});


















</script>
@endsection