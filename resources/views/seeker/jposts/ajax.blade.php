@extends('layouts.master')
@section('title', 'Explore Opportunities') 
@section('content')  
  <div id="content">
    @include('seeker.jposts.index')
  </div>
  <div class="loading">
    <i class="fas fa-spinner fa-spin fa-2x fa-tw"></i>
    <br>
    <span>Loading</span>
  </div>
  <!-- Footer -->  
  @include('includes.footer') 
@endsection

@section('js')
<script> 

  $(function () { 
    $('.bookmark_save').tooltip();
    $('.bookmark_unsave').tooltip();
  });

  /*
  $(document).on('click', 'a.page-link', function (event) {
      event.preventDefault();
      ajaxLoad($(this).attr('href')); 
  }); */
  
  $(document).on('click', 'a[rel="open"]', function (e) {
    e.preventDefault();

    var tmp_sport_id = $(this).parent().prev().text();
    alert(tmp_sport_id);
  });

  $(document).on('blur, change', '#search, #emp_type, #state, #job_cat, #post_level, #years_exp', function(){
    var query = $('#search').val(); 
    var query_emptype = $('#emp_type').val();
    var query_searchState = $('#state').val();
    var query_jobCat = $('#job_cat').val();
    var query_post_level = $('#post_level').val();
    var query_years_exp = $('#years_exp').val();

    var ajaxloader = '{{route('main')}}?search='+query
                      +'&emptype='+query_emptype
                      +'&searchState='+query_searchState
                      +'&searchJobCat='+query_jobCat
                      +'&srch_poslvl='+query_post_level
                      +'&srch_years='+query_years_exp; 
    ajaxLoad(ajaxloader);   
  });   

  function ajaxLoad(filename, content) {
      //alert(filename+"\n"+content);
      content = typeof content !== 'undefined' ? content : 'content';
      $('.loading').show();
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

  /**Delete Search Filter **/
  $(document).on('click', '.select_job_remove', function(){  
    var query = $('#search').val(); 
    var query_emptype = $('#emp_type').val();
    var query_searchState = $('#state').val();
    var query_jobCat = $('#job_cat').val();
    var query_post_level = $('#post_level').val();
    var query_years_exp = $('#years_exp').val();

    if($('.select_job_remove')){
      query = ''; 
    }
    var ajaxloader = '{{route('main')}}?search='+query
                      +'&emptype='+query_emptype
                      +'&searchState='+query_searchState
                      +'&searchJobCat='+query_jobCat
                      +'&srch_poslvl='+query_post_level;
                      +'&srch_years='+query_years_exp;

    ajaxLoad(ajaxloader);  
    return false;
  }); 
  $(document).on('click', '.select_emptype_remove', function(){  
    var query = $('#search').val(); 
    var query_emptype = $('#emp_type').val();
    var query_searchState = $('#state').val();
    var query_jobCat = $('#job_cat').val();
    var query_post_level = $('#post_level').val();
    var query_years_exp = $('#years_exp').val();

    if($('.select_emptype_remove')){
      query_emptype = '';  
    }

    var ajaxloader = '{{route('main')}}?search='+query
                      +'&emptype='+query_emptype
                      +'&searchState='+query_searchState
                      +'&searchJobCat='+query_jobCat
                      +'&srch_poslvl='+query_post_level
                      +'&srch_years='+query_years_exp;

    ajaxLoad(ajaxloader);  
    return false;
  }); 
  $(document).on('click', '.select_searchState_remove', function(){  
    var query = $('#search').val(); 
    var query_emptype = $('#emp_type').val();
    var query_searchState = $('#state').val();
    var query_jobCat = $('#job_cat').val();
    var query_post_level = $('#post_level').val();
    var query_years_exp = $('#years_exp').val();
    
    if($('.select_searchState_remove')){ 
      query_searchState = ''; 
    }

    var ajaxloader = '{{route('main')}}?search='+query
                      +'&emptype='+query_emptype
                      +'&searchState='+query_searchState
                      +'&searchJobCat='+query_jobCat
                      +'&srch_poslvl='+query_post_level
                      +'&srch_years='+query_years_exp;

    ajaxLoad(ajaxloader);  
    return false;
  });  
  $(document).on('click', '.select_jobCat_remove', function(){  
    var query = $('#search').val(); 
    var query_emptype = $('#emp_type').val();
    var query_searchState = $('#state').val();
    var query_jobCat = $('#job_cat').val();
    var query_post_level = $('#post_level').val();
    var query_years_exp = $('#years_exp').val();

    if($('.select_jobCat_remove')){ 
      query_jobCat = ''; 
    }

    var ajaxloader = '{{route('main')}}?search='+query
                      +'&emptype='+query_emptype
                      +'&searchState='+query_searchState
                      +'&searchJobCat='+query_jobCat
                      +'&srch_poslvl='+query_post_level
                      +'&srch_years='+query_years_exp;

    ajaxLoad(ajaxloader);  
    return false;
  }); 
  $(document).on('click', '.select_post_level_remove', function(){  
    var query = $('#search').val(); 
    var query_emptype = $('#emp_type').val();
    var query_searchState = $('#state').val();
    var query_jobCat = $('#job_cat').val();
    var query_post_level = $('#post_level').val();
    var query_years_exp = $('#years_exp').val();

    if($('.select_post_level_remove')){
      query_post_level = '';  
    }

    var ajaxloader = '{{route('main')}}?search='+query
                      +'&emptype='+query_emptype
                      +'&searchState='+query_searchState
                      +'&searchJobCat='+query_jobCat
                      +'&srch_poslvl='+query_post_level
                      +'&srch_years='+query_years_exp;

    ajaxLoad(ajaxloader);  
    return false;
  }); 

  $(document).on('click', '.select_years_exp_remove', function(){  
    var query = $('#search').val(); 
    var query_emptype = $('#emp_type').val();
    var query_searchState = $('#state').val();
    var query_jobCat = $('#job_cat').val();
    var query_post_level = $('#post_level').val();
    var query_years_exp = $('#years_exp').val();

    if($('.select_years_exp_remove')){
      query_years_exp = '';  
    }

    var ajaxloader = '{{route('main')}}?search='+query
                      +'&emptype='+query_emptype
                      +'&searchState='+query_searchState
                      +'&searchJobCat='+query_jobCat
                      +'&srch_poslvl='+query_post_level
                      +'&srch_years='+query_years_exp;

    ajaxLoad(ajaxloader);  
    return false;
  }); 
</script> 
@endsection