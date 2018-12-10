<div class="modal fade" id="expModal" tabindex="-1" role="dialog" aria-labelledby="photoModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Experience</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">  
        <label>List Education</label> 
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>#</th>
                <th>Company</th>
                <th>Position</th>
                <th>From - To</th>
                <th>Salary (MYR)</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @php
                $expArr = \App\Model\JobSeeker_Experience::where('seeker_id', '=', Auth::guard('web')->user()->seeker->id)
                                                          ->orderby('exp_toDt', 'DESC')->get();
                $i=1;                 
              @endphp
              @foreach($expArr as $exps)
              <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $exps->exp_company }}</td>
                <td>{{ $exps->exp_position }}</td>
                <td>
                  {{ date('M y', strtotime($exps->exp_fromDt)) }}
                  &nbsp;-&nbsp;
                  @if($exps->exp_toDt == 'Present')
                  {{ $exps->exp_toDt }}
                  @else
                  {{ date('M y', strtotime($exps->exp_toDt)) }}
                  @endif
                </td>
                <td>{{ $exps->exp_salary }}</td>
                <td>
                  <div class="btn-group">
                    <button class="btn btn-sm btn-primary" 
                    onClick="location.href='{{ route('seeker.update_exp', ['id'=>$exps->id]) }}'">Edit</button>
                    
                    <button class="btn btn-sm btn-danger" 
                    onClick="location.href='{{ route('seeker.delete_exp', ['id'=>$exps->id]) }}'">Delete</button>
                    
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <button class="btn btn-md btn-outline-primary my-2" id="expBtn">Add Experience</button>
        <div id="displayAddExp">

          @if(isset($editExp))
              {!! Form::model($editExp,['method'=>'put','id'=>'editprofile']) !!}
          @else
              {{ Form::open(array('route' => 'seeker.create_exp', 'id' => 'editprofile')) }}
          @endif
          
          <div class="form-group row">
              <label class="col-lg-3 col-form-label form-control-label">Company</label>
              <div class="col-lg-9">
                <input class="form-control" type="text" name="company" id="company" value="{{ isset($editExp)? $editExp->exp_company :'' }}"/>
                <span id="error-company" class="invalid-feedback"></span>
              </div>
          </div>
          <div class="form-group row">
              <label class="col-lg-3 col-form-label form-control-label">Position</label>
              <div class="col-lg-9">
                <input class="form-control" type="text" name="position" id="position" value="{{ isset($editExp)? $editExp->exp_position :'' }}"/>
                <span id="error-position" class="invalid-feedback"></span>
              </div>
          </div>
          <div class="form-group row">
              <label class="col-lg-3 col-form-label form-control-label">Last Salary</label>
              <div class="col-lg-9">
                <input class="form-control" type="text" name="last_salary" id="last_salary" value="{{ isset($editExp)? $editExp->exp_salary :'' }}"/>
                <span id="error-last_salary" class="invalid-feedback"></span>
              </div>
          </div>
          <div class="form-group row">
              <label class="col-lg-3 col-form-label form-control-label">Date From</label>
              <div class="col-lg-9">
                <input class="form-control" type="text" name="date_from" id="date_from" value="{{ isset($editExp)? $editExp->exp_fromDt :'' }}"/>
                <span id="error-date_from" class="invalid-feedback"></span>
              </div>
          </div>
          <div class="form-group row">
              <label class="col-lg-3 col-form-label form-control-label">Date To</label>
              <div class="col-lg-9">
                <input class="form-control" type="text" name="date_to" id="date_to" value="{{ isset($editExp)? $editExp->exp_toDt :'' }}"/>
                <span class="input-group-addon" style="text-align:left;">
                  <input class="btn-default" type="checkbox" id="check_date_to" name="check_date_to"/>&nbsp;Present
                </span>
                <span id="error-date_to" class="invalid-feedback"></span>
              </div>
          </div>
          <div class="form-group row">
              <label class="col-lg-12 col-form-label form-control-label">Job Description</label>
              <div class="col-lg-12">
                <textarea class="form-control" name="job_description" id="job_description">{!! isset($editExp)? $editExp->exp_jobd :'' !!}</textarea>
                <span id="error-job_description" class="invalid-feedback"></span>
              </div>
          </div>
          
          <div class="form-group row">
              <label class="col-lg-3 col-form-label form-control-label"></label>
              <div class="col-lg-9">
                  <input type="reset" class="btn btn-secondary" value="Reset" data-dismiss="modal">
                  <input type="submit" class="btn btn-primary" value="Save Changes">
              </div>
          </div>
          {{ Form::close() }}
        </div>  
      </div>
    </div>
  </div>
</div>