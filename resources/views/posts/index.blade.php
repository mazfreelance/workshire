
<div class="container"> 
    <div class="row">
        <div class="col-sm-7">
          <h3>Laravel CRUD, Search, Sort - AJAX</h3>
        </div>
        <div class="col-sm-5">
          <div class="pull-right">
            <div class="input-group">
                <input class="form-control" id="search"
                       value="{{ request()->session()->get('search') }}"
                       onkeydown="if (event.keyCode == 13) ajaxLoad('{{url('posts')}}?search='+this.value)"
                       placeholder="Search Title" name="search"
                       type="text" id="search"/>
                <div class="input-group-btn">
                    <button type="submit" class="btn btn-primary"
                            onclick="ajaxLoad('{{url('posts')}}?search='+$('#search').val())">
                            <i class="fa fa-search" aria-hidden="true"></i>
                    </button>
                </div>
            </div>

          </div>
        </div>
    </div>
    <table class="table">
        <thead>
        <tr> 
            <th width="60px">No</th>
            <th><a href="javascript:ajaxLoad('{{url('posts?field=jobpost_position&sort='.(request()->session()->get('sort')=='asc'?'desc':'asc'))}}')">Post Title</a>
                {{request()->session()->get('field')=='jobpost_position'?(request()->session()->get('sort')=='asc'?'▲':'▼'):''}}
            </th>

            <th style="vertical-align: middle">
                <a href="javascript:ajaxLoad('{{url('posts?field=jobpost_desc&sort='.(request()->session()->get('sort')=='asc'?'desc':'asc'))}}')">
                    Description
                </a>
                {{request()->session()->get('field')=='jobpost_desc'?(request()->session()->get('sort')=='asc'?'▲':'▼'):''}}
            </th>

            <th style="vertical-align: middle">
                <a href="javascript:ajaxLoad('{{url('posts?field=created_at&sort='.(request()->session()->get('sort')=='asc'?'desc':'asc'))}}')">
                    Created At
                </a>
                {{request()->session()->get('field')=='created_at'?(request()->session()->get('sort')=='asc'?'▲':'▼'):''}}
            </th>

            <th style="vertical-align: middle">
              <a href="javascript:ajaxLoad('{{url('posts?field=updated_at&sort='.(request()->session()->get('sort')=='asc'?'desc':'asc'))}}')">
                Update At
              </a>
              {{request()->session()->get('field')=='updated_at'?(request()->session()->get('sort')=='asc'?'▲':'▼'):''}}
            </th>
            <th width="160px" style="vertical-align: middle">
              <a href="javascript:ajaxLoad('{{url('posts/create')}}')"
                 class="btn btn-primary btn-xs"> <i class="fa fa-plus" aria-hidden="true"></i> New Post</a>
            </th>
        </tr>
        </thead>
        <tbody>
        @php
            $i=1;
        @endphp
        @foreach ($posts as $post)
          <tr>
            <th>{{$i++}}</th>
            <td>{{ $post->jobpost_position }}</td>
            <td>{!! html_entity_decode($post->jobpost_desc) !!}</td>
            <td>{{ $post->created_at }}</td>
            <td>{{ $post->updated_at }}</td>
            <td>
              <a class="btn btn-info btn-sm" title="Show"
                 href="javascript:ajaxLoad('{{url('posts/show/'.$post->id)}}')">
                  Show</a>
                <a class="btn btn-warning btn-sm" title="Edit"
                   href="javascript:ajaxLoad('{{url('posts/update/'.$post->id)}}')">
                    Edit</a>
                <input type="hidden" name="_method" value="delete"/>
                <a class="btn btn-danger btn-sm" title="Delete"
                   href="javascript:if(confirm('Are you sure want to delete?')) ajaxDelete('{{url('posts/delete/'.$post->id)}}','{{csrf_token()}}')">
                    Delete
                </a>
            </td>
        </tr>
        @endforeach 
        </tbody>
    </table> 
    <ul class="pagination">
        {{ $posts->links() }}
    </ul>
</div>

@section('js')
<script>
  //ajax 2
  $(document).on('click', 'a.page-link', function (event) {
      event.preventDefault();
      ajaxLoad($(this).attr('href'));
  });

  $(document).on('submit', 'form#frm', function (event) {
      event.preventDefault();
      var form = $(this);
      var data = new FormData($(this)[0]);
      var url = form.attr("action");
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
                  }
              } else {
                  ajaxLoad(data.redirect_url);
              }
          },
          error: function (xhr, textStatus, errorThrown) {
              alert("Error: " + errorThrown);
          }
      });
      return false;
  });

  $(document).on('blur', '#search', function(){
    var query = $(this).val(); 
    ajaxLoad('{{url('posts')}}?search='+query); 
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