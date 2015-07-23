<div id="primary-navigation">
	<ul>
	@while(($group =  $groups->pop()) != null)
		@if($group->hide_group == 0)
			@include ('partials.sidebar_menu', [ 'cgroup'=>  $group ])
		@endif
	@endwhile
	</ul>
</div>
