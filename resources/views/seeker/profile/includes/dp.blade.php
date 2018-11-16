<!--<img src="//placehold.it/150" class="mx-auto img-fluid img-circle d-block" alt="avatar">-->  
@if(file_exists(public_path().'/default_pictures/medium/'.$seek->seeker_profile_photo_loc) AND $seek->seeker_profile_photo_loc != '') 
	<img src="{{asset('public/default_pictures/medium/'.$seek->seeker_profile_photo_loc)}}" class="img-thumbnail text-center" width="150" /> 
@else
	<i class="fas fa-user-circle fa-5x mx-5 mt-4"></i>
@endif
<h6 class="mt-2">Upload a different photo</h6>
<label class="custom-file">
    <input type="file" id="file" class="custom-file-input">
    <span class="custom-file-control">Choose file</span>
</label>