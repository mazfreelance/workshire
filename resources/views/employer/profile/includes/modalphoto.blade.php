<div class="modal fade" id="photoModal" tabindex="-1" role="dialog" aria-labelledby="photoModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload default pictures</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{ Form::open(array('route' => 'employer.upload_photo', 'id' => 'uploadphoto' , 'enctype' => 'multipart/form-data')) }}
        <div class="form-group">
          <label>Upload Image</label>
          <div class="input-group">
              <span class="input-group-btn">
                  <span class="btn btn-default btn-file">
                      Browse… <input type="file" id="imgInp" name="photo">
                  </span>
              </span>
              <input type="text" class="form-control" readonly>
          </div>
          <hr>
          <h6 class="mt-3 font-weight-bold">Preview image</h6>
          <div class="row">
            <div class="col-sm-6 card border-0">
              <img id='img-upload250' src="{{ asset('public/images/favicon/whv2-310.png') }}" />
              <div class="card-body"> 
                <p class="card-text">250 x 250 pixel</p> 
              </div>
            </div>

            <div class="col-sm-6 card border-0">
              <img id='img-upload50' src="{{ asset('public/images/favicon/whv2-310.png') }}" />
              <div class="card-body"> 
                <p class="card-text">250 x 250 pixel</p> 
              </div>
            </div>
          </div> 
        </div>  


        <div class="form-group row">
            <label class="col-lg-3 col-form-label form-control-label"></label>
            <div class="col-lg-9">
                <input type="reset" class="btn btn-secondary" value="Cancel">
                <input type="submit" class="btn btn-primary" value="Save Changes">
            </div>
        </div>
        {{ Form::close() }}
      </div>
    </div>
  </div>
</div>