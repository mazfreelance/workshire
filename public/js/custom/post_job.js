/* VALIDATION */
$(function () {   
    $('#jobpost_desc').ckeditor();  
    $('#jobpost_exp').ckeditor();  

    $(document).on('change', '#jobpost_education, #postEduOthers', function() { 
    	//$(this).val() == "Others" ? $('#postEduOthers').prop('disabled', false) : $('#postEduOthers').prop('disabled', true);
    	if($('#jobpost_education').val() == "Others"){
    		$('#postEduOthers').prop('disabled', false);
    		if($('#postEduOthers').val() == ''){
    			$('button[type="submit"]').prop('disabled', true);
    			$('#postEduOthers').val("");
    		}else{
    			$('button[type="submit"]').prop('disabled', false);
    		}
    	}else{
    		$('#postEduOthers').prop('disabled', true);
    		$('#postEduOthers').val("");
    		$('button[type="submit"]').prop('disabled', false);
    	}
    });    

    $(document).on('change', '#jobpost_field_study, #postFieldOthers', function() { 
    	//$(this).val() == "Others" ? $('#postEduOthers').prop('disabled', false) : $('#postEduOthers').prop('disabled', true);
    	if($('#jobpost_field_study').val() == "Other"){
    		$('#postFieldOthers').prop('disabled', false);
    		if($('#postFieldOthers').val() == ''){
    			$('button[type="submit"]').prop('disabled', true);
    			$('#postFieldOthers').val("");
    		}else{
    			$('button[type="submit"]').prop('disabled', false);
    		}
    	}else{
    		$('#postFieldOthers').prop('disabled', true);
    		$('#postFieldOthers').val("");
    		$('button[type="submit"]').prop('disabled', false);
    	}
    });  

    


    $('#jobpost_position').keyup(function() {
    var caps = $('#jobpost_position').val(); 
    caps = caps.charAt(0).toUpperCase() + caps.slice(1);
    $('#jobpost_position').val(caps);
    });
    //location
    $('#jobpost_loc_city').keyup(function() {
    var caps = $('#jobpost_loc_city').val(); 
    caps = caps.charAt(0).toUpperCase() + caps.slice(1);
    $('#jobpost_loc_city').val(caps);
    });

    //Other Description
    $('#postEduOthers').keyup(function() {
    var caps = $('#postEduOthers').val(); 
    caps = caps.charAt(0).toUpperCase() + caps.slice(1);
    $('#postEduOthers').val(caps);
    });

    //Other Description
    $('#postFieldOthers').keyup(function() {
    var caps = $('#postFieldOthers').val(); 
    caps = caps.charAt(0).toUpperCase() + caps.slice(1);
    $('#postFieldOthers').val(caps);
    });

    //skill
    $('#skill').keyup(function() {
    var caps = $('#skill').val(); 
    caps = caps.charAt(0).toUpperCase() + caps.slice(1);
    $('#skill').val(caps);
    }); 
});

//datepicker
var $datepicker =  	$('#jobpost_startDate').datepicker({ 
			    	uiLibrary: 'bootstrap4', 
			    	iconsLibrary: 'fontawesome',
			    	format: 'mm/dd/yyyy'  
	    		}); 

	
$(document).on('click', '.getdate', function(){
	var durs = $('#duration_package').val().split(' ');  
	var raw_datepick = $datepicker.value();
	var enddateconvert = moment(raw_datepick).add(durs[0], durs[1]).calendar();
	$('#jobpost_endDate').val(enddateconvert);
	//alert(enddateconvert);
	return false;
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
//additional allowance
var template_add_allowance = '<div class="form-group category-allowance my-1">'
						+  '	<div class="input-group">'
						+  '		<input type="text" name="allowance[]" id="allowance" class="form-control"/>'        
						+  '		<span class="input-group-btn">'
						+  '			<a class="btn btn-danger btn-remove-allowance"><i class="fa fa-times" aria-hidden="true"></i></a>'
						+  '		</span>'
						+  '	</div>'
						+  '</div>';    
$(document).on('click', '.btn-add-more-allowance', function(e) { 
	e.preventDefault();
	$('.onerowallow').before(template_add_allowance); 
});   
$(document).on('click', '.btn-remove-allowance', function(e) { 
	e.preventDefault();
	$(this).parents('.category-allowance').remove();
});

/***/
$(document).on('submit', 'form#frm', function (event) {
    event.preventDefault();
    $('.loading').show();
    var form = $(this);
    var data = new FormData($(this)[0]);
    var url = form.attr("action");
    $.confirm({
        icon: 'fa fa-question',
        theme: 'modern',
        closeIcon: true,
        animation: 'scale',
        type: 'blue',
        title: 'Are you sure want to save job?',
        content: false,
        buttons: {
            confirm: function (){    
                $.ajax({
                    type: form.attr('method'),
                    url: url,
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data) { 
                        $('.is-invalid').removeClass('is-invalid');
                        if (data.fail) { 
                            for (control in data.errors) {   
                                $('#' + control).addClass('is-invalid');
                                $('#error-' + control).html(data.errors[control]);
                                $('#' + control).focus();
                            } 
                            $('.loading').hide();
                        } else {   
                            $('.loading').hide();
                            $.confirm({
                                icon: 'fa fa-check-circle',
                                theme: 'modern',
                                type: 'green',
                                title: false,
                                content: '<p>Successfully saved job. Your job post will be approval soon during working days. Thank you and continue keep to support us.</p>',
                                buttons:{
                                    okay: function(){   
                                        location.replace(data.redirect_url);   
                                        //console.log(data);   
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
                        $('.loading').hide();
                    }
                });   
            }, Cancel: function (){
                $('.loading').hide();
            }
        }
    });  
    return false;
}); 