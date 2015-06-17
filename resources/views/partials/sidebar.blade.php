<div id="primary-navigation">
	<ul>
	@foreach($groups as $group)
		@if($group->hide_group == 0)
			@include ('partials.sidebar_menu', [ 'cgroup'=>  $group ])
		@endif
	@endforeach
	</ul>
</div>
