@extends('layouts.master')
@section('title', 'Applicant') 

@section('content')  
  <div id="content">
    @include('employer.applicant.index')
  </div>
  <div class="loading">
    <i class="fa fa-refresh fa-spin fa-2x fa-tw"></i>
    <br>
    <span>Loading</span>
  </div> 
  <!-- Footer -->  
  @include('includes.footer') 
@endsection

@section('css')
<style> 

</style>
@endsection

@section('js') 
<script>
  $(function () {
    $('.profile').tooltip();
    $('.check').tooltip();
    $('.times').tooltip();
  });

  $(document).on('click', 'a.page-link', function (event) {
      event.preventDefault();
      ajaxLoad($(this).attr('href'));
      //alert($(this).attr('href'));
  });
  $(document).on('click', 'a[rel="open"]', function (e) {
    e.preventDefault();

    var tmp_sport_id = $(this).parent().prev().text();
    //alert(tmp_sport_id);
  }); 
  function ajaxLoad(filename, content){
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

  function ajaxLoad_redirect(filename, content){
      //alert(filename+"\n"+content);
      content = typeof content !== 'undefined' ? content : 'content';
      $('.loading').show();
      $.ajax({
          type: "GET",
          url: filename,
          contentType: false,
          success: function (data) {
            //alert(data);
            $.confirm({
              icon: 'fa fa-check-circle',
              theme: 'modern',
              closeIcon: true,
              animation: 'scale',
              type: 'green',
              title: 'You are successfully '+data+' this applicant',
              content: false,
              buttons: {
                  Okay: function (){location.reload();}
              }
            });  
          },
          error: function (xhr, status, error) {
            alert(xhr.responseText); 
            console.log(xhr.responseText);
            $('.loading').hide();
          }
      });
  }
</script>
@endsection