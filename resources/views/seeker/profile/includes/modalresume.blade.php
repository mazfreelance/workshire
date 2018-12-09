<div class="modal fade" id="resumeModal" tabindex="-1" role="dialog" aria-labelledby="photoModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload resume</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{ Form::open(array('route' => 'seeker.upload_resume', 'id' => 'uploadphoto' , 'enctype' => 'multipart/form-data')) }}
        <div class="form-group">
          <label>Upload resume</label>
          <div class="input-group">
              <span class="input-group-btn">
                  <span class="btn btn-default btn-file">
                      Browse… <input type="file" id="ResumeInp" name="photo">
                  </span>
              </span>
              <input type="text" class="form-control" readonly>
          </div>
              
          <p id="error3" style="display:none; color:#FF0000;">
              Invalid Resume Format! Resume Format Must Be PDF only.
          </p>
          <p id="error4" style="display:none; color:#FF0000;">
              Maximum File Size Limit is 4MB.
          </p>

          <hr>
          <h6 class="mt-3 font-weight-bold">Preview resume</h6>
          <div class="row">
            <div class="col-sm-12 card border-0">  
              <embed id="resumesrc" style="width:100%;height:200px">
            </div>
          </div> 
        </div>  
 
        <div class="form-group row">
            <label class="col-lg-3 col-form-label form-control-label"></label>
            <div class="col-lg-9">
                <input type="reset" class="btn btn-secondary" value="Reset" data-dismiss="modal">
                <input type="submit" id="saveresume" class="btn btn-primary" value="Save Changes">
            </div>
        </div>
        {{ Form::close() }}
      </div>
    </div>
  </div>
</div>