<div class="col-sm-6 col-md-3"> 
  <div class="input-group">
      <div class="input-group-prepend">
        <button class="btn btn-sm btn-secondary border-right-0 border" type="submit" onclick="ajaxLoad('{{url('jposts')}}?search='+$('#search').val()+'&emptype='+$('#emp_type').val())">
          <span class="fa fa-search"></span>
        </button>
      </div>
    <input class="form-control form-control-sm py-2 border-left-0 border" type="text" placeholder="Search Jobs..." name="search" id="search" value="{{ request()->session()->get('search') }}" onkeydown="if (event.keyCode == 13) ajaxLoad('{{url('jposts')}}?search='+this.value)"/> 
  </div> 
</div> 
<div class="col-sm-6 col-md-3">  
  <select class="form-control form-control-sm border" name="job_cat" id="job_cat">
    <option value="" selected="">Job Category</option> 
    @foreach($jobCats as $jobCat)
      <option value="{{$jobCat->category_name}}" {{request()->session()->get('searchJobCat')==$jobCat->category_name? 'selected':''}}>{{$jobCat->category_name}}</option>
    @endforeach 
  </select>
</div> 
<div class="col-sm-6 col-md-3">  
  <select class="form-control form-control-sm border" name="state" id="state">
    <option value="" selected="">Entire Malaysia</option>
    @foreach($state_array as $state)  
          <option value="{{$state->state_name}}" {{request()->session()->get('searchState')==$state->state_name? 'selected':''}}>{{$state->state_name}}</option>
    @endforeach
  </select>
</div> 

<div class="col-sm-6 col-md-3">  
  <select class="form-control form-control-sm border" name="emp_type" id="emp_type">
    <option value="" selected>Employment Type</option>
    @foreach($empType_array as $empType)  
          <option value="{{$empType->emp_type}}" {{request()->session()->get('emptype')==$empType->emp_type? 'selected':''}}>{{$empType->emp_type}}</option>
    @endforeach
  </select>
</div> 