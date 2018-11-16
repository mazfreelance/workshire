<main class="py-0"> 
  <div class="row mt-1 py-2 pl-sm-4 mr-2 mx-0"> 
    <div class="col-sm-8">
      <a class="btn btn-sm btn-danger" href="javascript:ajaxLoad('{{ url('jposts') }}')">Back</a>
      <h2>{{ $post->jobpost_position }}</h2>
      <div class="row">   
          <div class="col-sm-12"> 
            <div  class="d-inline" style="margin-top:-1em;">
              {{ $post->jobpost_emp_type }}
            </div> 
          <div class="d-sm-inline float-sm-right">  
            MYR&nbsp; {{number_format($post->jobpost_minSalary,2)}} - {{number_format($post->jobpost_maxSalary,2)}} / month
          </div> 
          </div>  
      </div><!--row--> 
      <hr class="mb-2" style="margin-top:0.5em;border-color: #000;">
      <div class="row">  
        <div class="col-sm-3">    
          @if (file_exists('images/default_pic/'.$post->employerDetailBySeq->emp_logo_loc) and $post->employerDetailBySeq->emp_logo_loc != '')
          <img src="{{ url('images/default_pic/'.$post->employerDetailBySeq->emp_logo_loc) }}" class="img-fluid img-rounded border border-dark" style="height:150px;width:304px;"/> 
          @else
          <img src="https://www.w3schools.com/bootstrap/cinqueterre.jpg" class="img-fluid img-rounded border border-dark" style="height:150px;width:304px;" />
          @endif
        </div>
        <div class="col-sm"> 
          <h3 class="font-weight-bold text-dark">{!!$post->employerDetailBySeq->emp_name!!}</h3>
          <h5 class="font-weight-bold text-dark">
            <scan class="d-block"><i class="fa fa-map-marker"></i>&nbsp;&nbsp;&nbsp;  
              {{$post->jobpost_loc_city}}, {{$post->jobpost_loc_state}}
            </scan>  
            @if($post->employerDetailBySeq->emp_website != '')
            <scan class="d-block"><i class="fa fa-globe"></i>&nbsp;&nbsp;  
              <a href="http://{{$post->employerDetailBySeq->emp_website}}" target="_blank">
                {!!$post->employerDetailBySeq->emp_name!!}&#39;s website
              </a>
            </scan>  
            @endif
            @if($post->employerDetailBySeq->emp_facebook != '')
            <scan class="d-block"><i class="fa fa-facebook"></i>&nbsp;&nbsp;&nbsp;  
              <a href="{!!$post->employerDetailBySeq->emp_facebook!!}" target="_blank">
                {!!$post->employerDetailBySeq->emp_name!!}&#39;s facebook
              </a>
            </scan>  
            @endif  
            <scan class="d-inline">
              <i class="fa fa-briefcase"></i>&nbsp;  
              No. of vacancy:&nbsp;{!!$post->job_noofvacancy!!}
            </scan> 
          </h5>
        </div> 
      </div>
      <hr class="mb-2" style="margin-top:0.5em;background-color: #bcbcbc;height:1px;border:0;">
      <div class="row">   
        <h3 class="font-weight-bold text-info mx-3">Job scope</h3>  
        <div class="col-sm-12 mt-1 ml-3"> 
            <scan class="text-justify">
              <scan class="text-justify"> 
                {!!html_entity_decode(stripslashes($post->jobpost_desc))!!} 
              </scan>
              <div class="d-block" style="margin-top:-1em;"> 
              <u class="font-weight-bold mx-4">Detail scope:</u> 
              <ul style="list-style:none;"> 
                @if($post->jobpost_exp != '')
                <li class="ml-3 text-justify">
                  {!!html_entity_decode(stripslashes($post->jobpost_exp))!!}   
                </li>  
                @endif
                @if($post->jobpost_allowance != '')
                <li class="ml-3">
                  Allowances: {!!html_entity_decode(stripslashes($post->jobpost_allowance))!!} 
                </li>  
                @endif
                @if($post->jobpost_skill != '')
                <li class="ml-3">
                  Skills: {!!html_entity_decode(stripslashes($post->jobpost_skill))!!} 
                </li>  
                @endif
                @if($post->jobpost_education != '')
                <li class="ml-3">
                  Education level: {!!html_entity_decode(stripslashes($post->jobpost_education))!!} 
                </li> 
                @endif
                @if($post->jobpost_field_study != '')
                <li class="ml-3">
                  Field of study: {!!html_entity_decode(stripslashes($post->jobpost_field_study))!!} 
                </li>
                @endif
                @if($post->jobpost_years_exp != '')
                <li class="ml-3">
                  No. of years: {!!html_entity_decode(stripslashes($post->jobpost_years_exp))!!} 
                </li>
                @endif 
              </ul> 
            </div>
            </scan>
          </div> 

          @if($post->emp_aboutus != '')
        <h4 class="font-weight-bold text-info mx-3 mt-2">Company Overview</h4>
          <div class="col-sm-12"> 
            <scan class="text-justify d-block">  
              {!!html_entity_decode(stripslashes($post->emp_aboutus))!!} 
            </scan>
          </div> 
          @endif
      </div>   
    </div>
  </div>
</main> 