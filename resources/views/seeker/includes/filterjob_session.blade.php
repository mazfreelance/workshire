@if(request()->session()->get('search') != '' or request()->session()->get('emptype') != '' or request()->session()->get('searchState') != '' or request()->session()->get('searchJobCat') != '' or request()->session()->get('srch_poslvl') != '' or request()->session()->get('srch_years') != '')
  <div class="row pl-sm-5 mt-3">
    <div class="col-sm col-md mx-3 py-2">
      <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
        @if(request()->session()->get('search') != '')
        <div class="input-group input-group-sm mx-2">
          <span class="py-0 px-1 border border-dark">{{ request()->session()->get('search') }}</span>
          <div class="input-group-prepend">
              <div class="input-group-text" id="btnGroupAddon">
                <a href="" class="select_job_remove"><i class="fa fa-times text-danger"></i></a>
              </div>
          </div>
        </div>
        @endif 
        @if(request()->session()->get('emptype') != '')
        <div class="input-group input-group-sm mx-2">
          <span class="py-0 px-1 border border-dark">{{ request()->session()->get('emptype') }}</span>
          <div class="input-group-prepend">
              <div class="input-group-text" id="btnGroupAddon">
                <a href="" class="select_emptype_remove"><i class="fa fa-times text-danger"></i></a>
              </div>
          </div>
        </div>
        @endif 
        @if(request()->session()->get('searchState') != '')
        <div class="input-group input-group-sm mx-2">
          <span class="py-0 px-1 border border-dark">{{ request()->session()->get('searchState') }}</span>
          <div class="input-group-prepend">
              <div class="input-group-text" id="btnGroupAddon">
                <a href="" class="select_searchState_remove"><i class="fa fa-times text-danger"></i></a>
              </div>
          </div>
        </div>
        @endif 
        @if(request()->session()->get('searchJobCat') != '')
        <div class="input-group input-group-sm mx-2">
          <span class="py-0 px-1 border border-dark">{{ request()->session()->get('searchJobCat') }}</span>
          <div class="input-group-prepend">
              <div class="input-group-text" id="btnGroupAddon">
                <a href="" class="select_jobCat_remove"><i class="fa fa-times text-danger"></i></a>
              </div>
          </div>
        </div>
        @endif 
        @if(request()->session()->get('srch_poslvl') != '')
        <div class="input-group input-group-sm mx-2">
          <span class="py-0 px-1 border border-dark">{{ request()->session()->get('srch_poslvl') }}</span>
          <div class="input-group-prepend">
              <div class="input-group-text" id="btnGroupAddon">
                <a href="" class="select_post_level_remove"><i class="fa fa-times text-danger"></i></a>
              </div>
          </div>
        </div>
        @endif  
        @if(request()->session()->get('srch_years') != '')
        <div class="input-group input-group-sm mx-2">
          <span class="py-0 px-1 border border-dark">{{ request()->session()->get('srch_years') }}</span>
          <div class="input-group-prepend">
              <div class="input-group-text" id="btnGroupAddon">
                <a href="" class="select_years_exp_remove"><i class="fa fa-times text-danger"></i></a>
              </div>
          </div>
        </div>
        @endif 
      </div>
    </div>
  </div>
@endif