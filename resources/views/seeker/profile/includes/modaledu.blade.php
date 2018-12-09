<div class="modal fade" id="eduModal" tabindex="-1" role="dialog" aria-labelledby="photoModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Education</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{ Form::open(array('route' => 'seeker.upload_photo', 'id' => 'uploadphoto' , 'enctype' => 'multipart/form-data')) }}
        <div class="form-group">
          <label>List Education</label> 
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Education</th>
                  <th>Field of study (Major)</th>
                  <th>Institute</th>
                  <th>Grade</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @php $i=1; @endphp
                @foreach($seek->education as $edu)
                <tr>
                  <td>{{ $i++ }}</td>
                  <td>{{ $edu->highest_education }}</td>
                  <td>{{ $edu->field_of_study }} ({{ $edu->major_study }})</td>
                  <td>{{ $edu->institute }}</td>
                  <td>{{ $edu->grade_achievement }}</td>
                  <td>
                    <div class="btn-group">
                      <button class="btn btn-sm btn-primary" 
                      onClick="location.href=''">Edit</button>
                      <button class="btn btn-sm btn-danger" 
                      onClick="location.href=''">Delete</button>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <button class="btn btn-md btn-outline-primary mt-2" id="eduBtn">Add Education</button>
          <div id="displayAddEdu">
            {!! Form::open(['id' => 'editprofile', 'route' => 'seeker.account.complete.post']) !!}
            <div class="form-group row">
                <label class="col-lg-3 col-form-label form-control-label">Type</label>
                <div class="col-lg-9">
                    <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" class="custom-control-input" id="seektype1" name="seektype" value="FRESH" 
                  {{$seek->seeker_type == 'FRESH'? ' checked':''}}/>
                  <label class="custom-control-label" for="seektype1">Fresh Graduate</label>
                </div>
                    <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" class="custom-control-input" id="seektype2" name="seektype" value="EXPERIENCE" 
                  {{$seek->seeker_type == 'EXPERIENCE'? ' checked':''}}/>
                  <label class="custom-control-label" for="seektype2">Experience</label>
                </div>
              <span id="error-seektype" class="invalid-feedback"></span>
                </div>
            </div>
            {!! Form::close() !!}
          </div>
        </div>  
 
        <div class="form-group row">
            <label class="col-lg-3 col-form-label form-control-label"></label>
            <div class="col-lg-9">
                <input type="reset" class="btn btn-secondary" value="Reset" data-dismiss="modal">
                <input type="submit" id="savephoto" class="btn btn-primary" value="Save Changes">
            </div>
        </div>
        {{ Form::close() }}
      </div>
    </div>
  </div>
</div>