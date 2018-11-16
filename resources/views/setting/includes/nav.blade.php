<nav>
	<div class="nav flex-column nav-tabs nav-fill" id="nav-tab" role="tablist_vertical">
		@if(Auth::guard('employer')->check())
			<a class="text-left nav-item nav-link {{Request::path() == 'employer/setting' ? 'active':''}}" id="nav-account-tab" href="{{route('employer.setting')}}" role="tab" aria-controls="nav-home" aria-selected="true">Account</a>
			<a class="text-left nav-item nav-link  {{Request::path() == 'employer/setting/password' ? 'active':''}}" id="nav-password-tab" href="{{route('employer.setting.password')}}" role="tab" aria-controls="nav-home" aria-selected="true">Password</a>
			<a class="text-left nav-item nav-link  {{Request::path() == 'employer/setting/notification' ? 'active':''}}" id="nav-notification-tab" href="{{route('employer.setting.notification')}}" role="tab" aria-controls="nav-notification" aria-selected="false">Notification</a>

			@if(Auth::user()->role->id ==  2)
			<a class="text-left nav-item nav-link {{Request::path() == 'employer/setting/plan' ? 'active':''}}" id="nav-plan-billing-tab" href="{{route('employer.setting.plan')}}" role="tab" aria-controls="nav-plan-billing" aria-selected="false">Plans & Billing</a> 
			@endif
		@else
			<a class="text-left nav-item nav-link {{Request::path() == 'seeker/setting' ? 'active':''}}" id="nav-account-tab" href="{{route('seeker.setting')}}" role="tab" aria-controls="nav-home" aria-selected="true">Account</a>
			<a class="text-left nav-item nav-link  {{Request::path() == 'seeker/setting/password' ? 'active':''}}" id="nav-password-tab" href="{{route('seeker.setting.password')}}" role="tab" aria-controls="nav-home" aria-selected="true">Password</a>
			<a class="text-left nav-item nav-link  {{Request::path() == 'seeker/setting/notification' ? 'active':''}}" id="nav-notification-tab" href="{{route('seeker.setting.notification')}}" role="tab" aria-controls="nav-notification" aria-selected="false">Notification</a>
		@endif
	</div>
</nav>