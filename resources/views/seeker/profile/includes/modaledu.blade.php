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
              @php 
                $i=1; 
                $arr_lvl = array();
              @endphp
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
                    onClick="location.href='{{ route('seeker.update_edu', ['id'=>$edu->id]) }}'">Edit</button>
                    @if($edu->level !== 1)
                    <button class="btn btn-sm btn-danger" 
                    onClick="location.href='{{ route('seeker.delete_edu', ['id'=>$edu->id]) }}'">Delete</button>
                    @endif
                  </div>
                </td>
              </tr>
                @php  $arr_lvl[] = $edu->level; @endphp
              @endforeach
            </tbody>
          </table>
        </div>
        <button class="btn btn-md btn-outline-primary my-2" id="eduBtn">Add Education</button>
        <div id="displayAddEdu">

          @if(isset($editEdu))
              {!! Form::model($editEdu,['method'=>'put','id'=>'editprofile']) !!}
          @else
              {{ Form::open(array('route' => 'seeker.create_edu', 'id' => 'editprofile')) }}
          @endif
          
          <div class="form-group row">
              <label class="col-lg-3 col-form-label form-control-label">Level</label>
              <div class="col-lg-9">
                {{ in_array('1', $arr_lvl) ? '1st Education Level' : '' }}
                {{ in_array('2', $arr_lvl) ? '2nd Education Level' : '' }}
                {{ in_array('3', $arr_lvl) ? '3rd Education Level' : '' }}
                {{ in_array('4', $arr_lvl) ? '4th Education Level' : '' }}
                {{ in_array('5', $arr_lvl) ? '5th Education Level' : '' }}
              </div>
          </div>
          <div class="form-group row">
              <label class="col-lg-3 col-form-label form-control-label">Education</label>
              <div class="col-lg-9">
                <select class="form-control" name="highEdu" id="highEdu">
                  <option value="" disabled selected>Select one...</option>
                  @php
                    $edulvls = ['SPM' => 'SPM', 'STPM' => 'STPM', 'Diploma' => 'Diploma', 'Degree' => 'Bachelor Degree', 'Master' => 'Master Degree', 'PHD' => 'Doctor of Philosophy Degree'];
                  @endphp
                  @foreach($edulvls as $key => $edulvl)
                    <option value="{{$key}}" {{ isset($editEdu)? $editEdu->highest_education == $key?'selected':'' :''}}>{{$edulvl}}</option>
                  @endforeach
                </select>
                <span id="error-education" class="invalid-feedback"></span>
              </div>
          </div>
          <div class="form-group row">
              <label class="col-lg-3 col-form-label form-control-label">Field of study</label>
              <div class="col-lg-9">
                <select class="form-control" name="fos" id="fos">
                  <option value="" disabled selected>Select one...</option>
                  @foreach($fos as $study)
                    <option value="{{$study->category_Name}}" {{ isset($editEdu)? $editEdu->field_of_study == $study->category_Name?'selected':'' :''}}>
                      {{$study->category_Name}}
                    </option>
                  @endforeach
                </select>
                <span id="error-fos" class="invalid-feedback"></span>
              </div>
          </div>
          <div class="form-group row">
              <label class="col-lg-3 col-form-label form-control-label">Major</label>
              <div class="col-lg-9">
                <input class="form-control" type="text" name="major" id="major" value="{{ isset($editEdu)? $editEdu->major_study :'' }}"/>
                <span id="error-major" class="invalid-feedback"></span>
              </div>
          </div>
          <div class="form-group row">
              <label class="col-lg-3 col-form-label form-control-label">Institute</label>
              <div class="col-lg-9">
                <select class="form-control" name="institute" id="institute">
                  <option value="" disabled selected>Select one...</option>
                  @foreach($institutes as $institute)
                    <option value="{{$institute->uni_name}}"{{$study->category_Name}}" {{ isset($editEdu)? $editEdu->institute == $institute->uni_name?'selected':'' :''}}>
                      {{$institute->uni_name}}
                    </option>
                  @endforeach
                </select>
                <span id="error-institute" class="invalid-feedback"></span>
              </div>
          </div>
          <div class="form-group"> 
            <div class="row"> 
              <div class="col-xs-12 col-sm-12 col-md-12"> 
                <label class="col-form-label form-control-label d-block">Achievement</label> 
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" id="grade" name="achieve" value="Grade" 
                    {{ isset($editEdu)? $editEdu->qualification == 'Grade'?'checked':'' :''}}/>
                    <label class="custom-control-label" for="grade">Grade</label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" id="cgpa" name="achieve" value="CGPA" 
                    {{ isset($editEdu)? $editEdu->qualification == 'CGPA'?'checked':'' :''}}/>
                    <label class="custom-control-label" for="cgpa">CGPA</label>
                  </div> 
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" id="class" name="achieve" value="Class" 
                    {{ isset($editEdu)? $editEdu->qualification == 'Class'?'checked':'' :''}}/>
                    <label class="custom-control-label" for="class">Class</label>
                  </div> 
                  
                <input type="text" name="achievement_grade" id="achievement_grade" class="form-control input-lg" tabindex="3" placeholder="Grade" value="{{ isset($editEdu) ? $editEdu->grade_achievement :''  }}"> 
                <input type="text" name="achievement_cgpa" id="achievement_cgpa" class="form-control input-lg" tabindex="3" placeholder="CGPA" value="{{ isset($editEdu) ? $editEdu->grade_achievement :''  }}"> 
                <input type="text" name="achievement_class" id="achievement_class" class="form-control input-lg" tabindex="3" placeholder="Class" value="{{ isset($editEdu) ? $editEdu->grade_achievement :''  }}">

                <span id="error-achievement_grade" class="invalid-feedback"></span>  
                <span id="error-achievement_cgpa" class="invalid-feedback"></span> 
                <span id="error-achievement_class" class="invalid-feedback"></span> 
              </div>
            </div>
          </div>
          <div class="form-group row">
              <label class="col-lg-3 col-form-label form-control-label">Status</label>
              <div class="col-lg-9">
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" class="custom-control-input" id="status1" name="status" value="1" 
                  {{ isset($editEdu)? $editEdu->status_study == '1'?'checked':'' :''}}/>
                  <label class="custom-control-label" for="status1">Currently study</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" class="custom-control-input" id="status2" name="status" value="0" 
                  {{ isset($editEdu)? $editEdu->status_study == '0'?'checked':'' :''}}/>
                  <label class="custom-control-label" for="status2">End of study</label>
                </div>
                
                <span id="error-status" class="invalid-feedback"></span>
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