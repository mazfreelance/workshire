<div class="container">
    <div class="col-md-8 offset-md-2">
        <h1>{{isset($post)?'Edit':'New'}} Post</h1>
        <hr/>
        @if(isset($post))
            {!! Form::model($post,['method'=>'put','id'=>'frm']) !!}
        @else
            {!! Form::open(['id'=>'frm']) !!}
        @endif
        <div class="form-group row required">
            {!! Form::label("title","Position",["class"=>"col-form-label col-md-3 col-lg-2"]) !!}
            <div class="col-md-8">
                {!! Form::text("title",isset($post) ?$post->jobpost_position : null,["class"=>"form-control".($errors->has('title')?" is-invalid":""),"autofocus",'placeholder'=>'Title']) !!}
                <!--<input type="text" name="title"/>-->
                <span id="error-title" class="invalid-feedback"></span>
            </div>
        </div>

        <div class="form-group row required">
            {!! Form::label("description","Job Description",["class"=>"col-form-label col-md-3 col-lg-2"]) !!}
            <div class="col-md-8">
                {!! Form::textarea("description",isset($post) ?$post->jobpost_desc : null,["class"=>"form-control".($errors->has('description')?" is-invalid":""),'placeholder'=>'Description']) !!}
                <span id="error-description" class="invalid-feedback"></span>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3 col-lg-2"></div>
            <div class="col-md-4">
                <a href="javascript:ajaxLoad('{{url('posts')}}')" class="btn btn-danger btn-xs">
                    Back</a>
                {!! Form::button("Save",["type" => "submit","class"=>"btn btn-primary btn-xs"])!!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>