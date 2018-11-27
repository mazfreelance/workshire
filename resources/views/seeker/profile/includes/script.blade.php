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
		}
	}); 
	$(document).on("change", "#ic_type2", function(event){
		event.preventDefault();  
		if($(this).val() == "non malay"){
			$("#passport_field").show();
			$("#nric_field").hide();
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
	                    alert(value[0]);
					  }else{ 
	                    $('#' + key).addClass('is-invalid');
	                    $('#error-' + key).html(value);
	                    $('#' + key).focus();  
					  } 
					}); 

	                for (control in data.errors) {   
	                    //$('#' + control).addClass('is-invalid');
	                    //$('#error-' + control).html(data.errors[control]);
	                    //$('#' + control).focus(); 
	                }  
                	//alert('#error-' +control+" : "+data.errors[control]);
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

	//language 
	var template_add_lang = '<div class="form-group category-lang my-1">'
							+  '	<div class="input-group">'
							+  '		<input class="form-control" type="text" name="lang[]" id="lang" placeholder="eg: Commnunication"/>'        
							+  '		<span class="input-group-btn">'
							+  '			<a class="btn btn-danger btn-remove-lang"><i class="fa fa-times" aria-hidden="true"></i></a>'
							+  '		</span>'
							+  '	</div>'
							+  '</div>';    
	$(document).on('click', '.btn-add-more-lang', function(e) { 
		e.preventDefault();
		$('.onerowlang').before(template_add_lang); 
	});   
	$(document).on('click', '.btn-remove-lang', function(e) { 
		e.preventDefault();
		$(this).parents('.category-lang').remove();
	});
</script>
@endsection