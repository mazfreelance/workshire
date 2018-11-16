@extends('layouts.master')
@section('title', 'Dashboard')
@section('content')  
  <div id="content">
    @include('employer.jposts.index')
  </div>
  <div class="loading">
    <i class="fa fa-refresh fa-spin fa-2x fa-tw"></i>
    <br>
    <span>Loading</span>
  </div>
@endsection

@section('css')
<style>
a.applBTN:hover {
  text-decoration:none;
  background-color: #0a0ad8;
  color:#fff;
}
</style>
@endsection

@section('js') 
<script>     
  $('a[data-toggle="tooltip"]').tooltip(); 

  $(document).on('click', '.opencloseposttool', function(evt){
    evt.preventDefault();  
    var action = $(this).attr('id').split('|'); 
    var href = action[2]; 
    if(action[0] == 'SHOW'){
      $.confirm({
        icon: 'fa fa-briefcase',
        theme: 'modern',
        closeIcon: true,
        animation: 'scale',
        type: 'blue',
        title: 'Are you sure want to open '+action[1]+' job posting ?',
        content: 'This job will be open from advertise',
        buttons: {
            Okay: function (){    
              var split = href.split(',');
              $.ajax({
                  type: 'POST',
                  data: {_method: 'GET', _token: split[1], status: action[0]},
                  url: split[0],
                  dataType: 'json',
                  success: function (data){   
                      $.confirm({
                          icon: 'fa fa-check-circle',
                          theme: 'modern',
                          type: 'green',
                          title: false,
                          content: '<p>Successfully open job post</p>',
                          buttons:{
                              okay: function(){   
                                  location.replace(data.redirect_url);   
                                  //alert(data.redirect_url);   
                              }
                          }
                      });
                  },
                  error: function (xhr, status, error) {
                    //alert(xhr.responseText); 
                    $.alert({
                        icon: 'fa fa-times-circle',
                        theme: 'modern',
                        type: 'red',
                        title: 'Fail to open job post',
                        content: xhr.responseText,
                        confirm: function(){}
                    });
                  }
              }); 
            },
            Cancel: function (){}
        }
      });
    }else if(action[0] == 'HIDE'){
      $.confirm({
        icon: 'fa fa-briefcase',
        theme: 'modern',
        closeIcon: true,
        animation: 'scale',
        type: 'blue',
        title: 'Are you sure want to close '+action[1]+' job posting ?',
        content: 'This job will be close from advertise',
        buttons: {
            Okay: function (){  
              var split = href.split(',');
              $.ajax({
                  type: 'POST',
                  data: {_method: 'GET', _token: split[1], status: action[0]},
                  url: split[0],
                  dataType: 'json',
                  success: function (data){   
                      $.confirm({
                          icon: 'fa fa-check-circle',
                          theme: 'modern',
                          type: 'green',
                          title: false,
                          content: '<p>Successfully close job post</p>',
                          buttons:{
                              okay: function(){   
                                  location.replace(data.redirect_url);   
                                  //alert(data.redirect_url);   
                              }
                          }
                      });
                  },
                  error: function (xhr, status, error) {
                    //alert(xhr.responseText); 
                    $.alert({
                        icon: 'fa fa-times-circle',
                        theme: 'modern',
                        type: 'red',
                        title: 'Fail to close job post',
                        content: xhr.responseText,
                        confirm: function(){}
                    });
                  }
              });   
            },
            Cancel: function (){}
        }
      }); 
    }
  });
  /*
  $(document).on('click', 'a.page-link', function (event) {
      event.preventDefault();
      ajaxLoad($(this).attr('href'));
      //alert($(this).attr('href'));
  }); */
  
  $(document).on('click', 'a[rel="open"]', function (e) {
    e.preventDefault();
    var tmp_sport_id = $(this).parent().prev().text();
    alert(tmp_sport_id);
  }); 

  $(document).on('click', '.delposttool', function (e) {
    var href = $(this).attr('id'); 
    $.confirm({
      icon: 'fa fa-trash',
      theme: 'modern',
      closeIcon: true,
      animation: 'scale',
      type: 'red',
      title: 'Are you sure want to delete?',
      content: false,
      buttons: {
          Okay: function (){   
            var split = href.split(',');
            //alert(split[1]+"\n\n"+href);
            $.ajax({
                type: 'POST',
                data: {_method: 'DELETE', _token: split[1]},
                url: split[0],
                success: function (data){ 
                    $("#content").html(data);
                    $('.loading').hide();
                    $.alert({
                        icon: 'fa fa-check-circle',
                        theme: 'modern',
                        type: 'green',
                        title: false,
                        content: '<p>Successfully deleted job post</p>',
                        confirm: function(){}
                    });
                },
                error: function (xhr, status, error) {
                  //alert(xhr.responseText);
                  $.alert({
                      icon: 'fa fa-times-circle',
                      theme: 'modern',
                      type: 'red',
                      title: 'Fail to delete job post',
                      content: xhr.responseText,
                      confirm: function(){}
                  });
                }
            });
            /*
            $.alert({
                icon: 'fa fa-check-circle',
                theme: 'modern',
                type: 'green',
                title: false,
                content: 'Successfully deleted job post',
                confirm: function(){
                    //$.alert('Successfully deleted job post'); // shorthand.
                }
            });
            */
          },
          Cancel: function (){}
      }
    }); 
    return false;
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

  function ajaxDelete(filename, token, content) {
      //alert(filename);
      content = typeof content !== 'undefined' ? content : 'content';
      $('.loading').show();
      $.ajax({
          type: 'POST',
          data: {_method: 'DELETE', _token: token},
          url: filename,
          success: function (data) {
              $("#" + content).html(data);
              $('.loading').hide();
          },
          error: function (xhr, status, error) {
              alert(xhr.responseText);
          }
      });
  } 
</script> 
@endsection