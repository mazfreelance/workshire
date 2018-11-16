<hr>
<h6 class="font-weight-normal">Education category</h6> 
<ul class="small" style="list-style:none;"> 
 	<li class="{{request()->session()->get('search_eduCate')==''? 'active':''}}">
		<a href="" class="edu_category" data="">All</a>
	</li>
	@foreach($eduCats as $number)
	<li class="{{request()->session()->get('search_eduCate')==$number->name? 'active':''}}">
		<a href="" class="edu_category" data="{{$number->name}}">
			{{$number->name}}
			<span class="badge badge-primary">{{$number->total}}</span>
		</a>
	</li>
	@endforeach 
</ul>
<h6 class="font-weight-normal">Gender</h6> 
<ul class="small" style="list-style:none;">
	<li class="{{request()->session()->get('search_gender')==''? 'active':''}}">
		<a href="" class="gender" data="">All</a>
	</li>
	<li class="{{request()->session()->get('search_gender')=='M'? 'active':''}}">
		<a href="" class="gender" data="M">Male</a> 
	</li>
	<li class="{{request()->session()->get('search_gender')=='F'? 'active':''}}"> 
		<a href="" class="gender" data="F">Female</a>
	</li>
</ul> 