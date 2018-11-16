<div class="container">
  <div class="col-md-8 offset-md2">
    <h2>Show Post</h2>
    <hr>
    <div class="form-group">
      <h2>{{ $post->jobpost_position }}</h2>
    </div>

    <div class="form-group">
      <h2>{!! html_entity_decode($post->jobpost_desc) !!}</h2>
    </div>

    <a class="btn btn-xs btn-danger" href="javascript:ajaxLoad('{{ url('posts') }}')">Back</a>
  </div>
</div>