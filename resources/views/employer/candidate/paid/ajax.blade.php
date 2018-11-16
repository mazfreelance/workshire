@extends('layouts.master')
@section('title', 'Paid Candidates') 

@section('content')  
  	<div id="content">
    	@include('employer.candidate.paid.index')
  	</div>
  	<div class="loading">
	    <i class="fas fa-spinner fa-spin fa-2x fa-tw"></i>
	    <br>
	    <span>Loading</span>
  	</div>
	<!-- Footer -->  
	@include('includes.footer') 
@endsection

@section('css')
<style>
.cursor{ cursor: grab; }
.cursorgrabbing{ cursor: grabbing; } 
</style>
@endsection
 
@section('js')  
<script>  
$(function () {   
    $("select.chosen").chosen(); 
    $('.resume_attach').tooltip();
    
  $(document).on('click', 'a.buy_candidate', function(evt){
    evt.preventDefault();    
    var value = $(this).attr('data'); //&employer=1&seeker=1377&tokenVal=1&duration=30 days&type=FRESH
    var data_duration = $(this).attr('data-duration');
    var data_token = $(this).attr('data-token');
    var url = "<?php echo url('employer/buy_candidate') ?>";
    $('#buy_candidate_modal').modal('show');  
    $('#token_value').text(data_token);
    $('#dur_token').text(data_duration); 
    
    $(document).on('click', '.submit_buy', function(){  
      var bal = parseInt("<?php echo isset($currToken) ? $currToken->balance : '' ?>"); 
      var tokenVal = parseInt(data_token);  
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
                    ajaxLoad(data.redirect_url+"/paid-candidate");
                    $('#buy_candidate_modal').modal('hide');
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
       
    });  
  }); 

  $(document).on('blur, change', '#fos_search', function(){
    var query_fos_search = $('#fos_search').val();   
    var ajaxloader = '{{url('employer/paid-candidate')}}?search_fos_search='+query_fos_search;  
    ajaxLoad(ajaxloader); 
    //alert(ajaxloader);   
    return false;
  });

  $(document).on('blur, change', '#state, #education, #institute, #talent_type', function(){
    var query_state = $('#state').val();  
    var query_education = $('#education').val();  
    var query_institute = $('#institute').val();  
    var query_talent_type = $('#talent_type').val();  

    var ajaxloader = '{{url('employer/paid-candidate')}}?search_state='+query_state
           +'&search_education='+query_education
           +'&search_institute='+query_institute
           +'&search_talent_type='+query_talent_type; 

    ajaxLoad(ajaxloader); 
    //alert(ajaxloader);   
    //return false;
  });

  /** REMOVE FILTER START **/  
  $(document).on('click', '.select_search_fos_search_remove', function(){  
    $('.cursor').addClass('cursorgrabbing'); 
    if($(this)) query_fos_search = '';   
    var ajaxloader = '{{url('employer/paid-candidate')}}?search_fos_search='+query_fos_search;  
    ajaxLoad(ajaxloader);  
    return false;
  });
 
  $(document).on('click', '.select_talent_type_remove', function(){  
    $('.cursor').addClass('cursorgrabbing');  
    if($(this)) query_talent_type = '';   
    var ajaxloader = '{{url('employer/paid-candidate')}}?search_talent_type='+query_talent_type;  
    ajaxLoad(ajaxloader);           
    return false;
  });  

  $(document).on('click', '.select_search_institute_remove', function(){  
    $('.cursor').addClass('cursorgrabbing'); 
    if($(this)) query_institute = '';   
    var ajaxloader = '{{url('employer/paid-candidate')}}?search_institute='+query_institute;          
    ajaxLoad(ajaxloader);  
    return false;
  });  

  $(document).on('click', '.select_search_state_remove', function(){  
    $('.cursor').addClass('cursorgrabbing');
    if($(this)) query_state = '';   
    var ajaxloader = '{{url('employer/paid-candidate')}}?search_state='+query_state;  
    ajaxLoad(ajaxloader);  
    return false;
  }); 

  $(document).on('click', '.select_search_education_remove', function(){  
    $('.cursor').addClass('cursorgrabbing');
    if($(this)) query_education = '';   
    var ajaxloader = '{{url('employer/paid-candidate')}}?search_education='+query_education;   
    ajaxLoad(ajaxloader);  
    return false;
  }); 

  /** REMOVE FILTER END **/
  $(document).on('click', 'a.page-link', function (event) {
    event.preventDefault();
    ajaxLoad($(this).attr('href'));
    //alert($(this).attr('href'));
  });
  //ajaxLoad function
  function ajaxLoad(filename, content){
      //alert(filename+"\n"+content);
      $('.loading').show();
      content = typeof content !== 'undefined' ? content : 'content';
      $.ajax({
          type: "GET",
          url: filename,
          contentType: false,
          success: function (data) {
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
@endsection