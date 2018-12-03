@section('js') 
<script type="text/javascript" src="{{ asset('public/js/jquery.printPage.js') }}"></script>
<script src="{{ asset('public/js/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('public/js/ckeditor/adapters/jquery.js') }}"></script>
<script> 
	//validation   
	$('[data-toggle="tooltip"]').tooltip();
	var profile_updated = $('input[name="profile_updated"]').val();
	var moment_profile = moment(profile_updated).calendar();
	$('#updateprofilejs').text(moment_profile); 
	$('#about_us').ckeditor();

	$(document).on('change, keyup', '#zip' , function(e){
		e.preventDefault();
	    var data = "zip="+$(this).val()+"&_token={{CSRF_TOKEN()}}";   
	    $.ajax({
	        url: "{{route('poskod')}}",
	        data: data,
	        cache: false,
	        contentType: false,
	        processData: false,
	        success: function (data) {   
	        	$('#district').val(data.daerah);
	        	$('#city').val(data.kawasan);
	        	$('#state').val(data.negeri);
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

	$('#type').val() == 'Others' ? $('#other_type').prop('disabled', false) : $('#other_type').prop('disabled', true);
	$(document).on('change', '#type' , function(e){
		e.preventDefault(); 
		$(this).val() == 'Others' ? $('#other_type').prop('disabled', false) : $('#other_type').prop('disabled', true);

	});  

	$(document).on('click, change', '#lang', function(e){
 		e.preventDefault(); 
 		$('#lang :selected').each(function(i, sel){  
 			if($(sel).val() == 'Other' ){
 				$('#other_language').prop('disabled', false); 
 			}else{
 				$('#other_language').prop('disabled', true);
 				$('#other_language').val('');
 			} 
		}); 
 	});
 	$('#lang :selected').each(function(i, sel){  
	    $(sel).val() == 'Other' ? $('#other_language').prop('disabled', false) : $('#other_language').prop('disabled', true);
	}); 

	$("#benefit8").is(':checked') ? $('#other_benefit').prop('disabled',false) : $('#other_benefit').prop('disabled',true);
    $(document).on('change', "#benefit8", function(e){  
    	e.preventDefault();
        $(this).is(':checked') ? $('#other_benefit').prop('disabled',false) : $('#other_benefit').prop('disabled',true); 
    });    

	$('#photoModal').modal('show');
	$(document).on('click', '#addphoto', function(e){
		e.preventDefault();
		$('#photoModal').modal('show');
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
					  	if(key == 'benefit'){
					  		$('input[name="' + key + '[]"]').addClass('is-invalid');
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
	                    content: '<p>Successfully updated profile.</p>',
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
	            $('.loading').hide();
	            $.alert({
	                icon: 'fa fa-times-circle',
	                theme: 'modern',
	                type: 'red',
	                title: 'Fail to update profile',
	                content: xhr.responseText,
	                confirm: function(){}
	            });
	        }
	    });   
	});  

	//image
	$(document).on('change', '.btn-file :file', function() {
		var input = $(this),
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		input.trigger('fileselect', [label]);
	});

	$('.btn-file :file').on('fileselect', function(event, label) {
	    
	    var input = $(this).parents('.input-group').find(':text'),
	        log = label;
	    
	    if( input.length ) {
	        input.val(log);
	    } else {
	        if( log ) alert(log);
	    }
    
	});
	function readURL(input) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        
	        reader.onload = function (e) {
	            $('#img-upload250').attr('src', e.target.result);
	            $('#img-upload50').attr('src', e.target.result);
	        }
	        
	        reader.readAsDataURL(input.files[0]);
	    }
	}

	$("#imgInp").change(function(){
	    readURL(this);
	}); 


	$(document).on('submit', 'form#uploadphoto', function (event){
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
	                    content: '<p>Successfully uploaded default pictures.</p>',
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
	            $('.loading').hide();
	            $.alert({
	                icon: 'fa fa-times-circle',
	                theme: 'modern',
	                type: 'red',
	                title: 'Fail to upload default pictures',
	                content: xhr.responseText,
	                confirm: function(){}
	            });
	        }
	    });   
	});  








</script>
@endsection