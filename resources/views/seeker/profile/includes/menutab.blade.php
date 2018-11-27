<ul class="nav nav-tabs">
    <li class="nav-item">
        <a href="{{route('seeker.profile')}}"
        class="nav-link {{Request::path() == 'seeker/profile' ? 'active':''}}">Profile</a>
    </li>
    <li class="nav-item">
        <a href="{{route('seeker.showEduExp')}}"
        class="nav-link {{Request::path() == 'seeker/profile/education-experience' ? 'active':''}}">Education & Work</a>
    </li> 
    <li class="nav-item">
        <a href="{{route('seeker.showMessage')}}"
        class="nav-link {{Request::path() == 'seeker/profile/message' ? 'active':''}}">Messages</a>
    </li>
    <li class="nav-item">
        <a href="{{route('seeker.showEditForm')}}" class="nav-link {{Request::path() == 'seeker/profile/edit' ? 'active':''}}">Edit</a>
    </li>
    <li class="nav-item">
        <a href="{{route('seeker.resume', ['id' => $seek->id])}}" 
           class="nav-link {{Request::path() == 'seeker/profile/resume/'.$seek->id ? 'active':''}}">Resume
        </a>
    </li>
    <li class="nav-item">
		<a href="" data-toggle="tab" class="nav-link btnPrint"><i class="fa fa-print"></i> Profile</a>
    </li>
</ul>