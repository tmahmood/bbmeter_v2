<div id="primary-navigation">
	<ul>
	@foreach($groups as $group)
		@include ('partials.sidebar_menu', [ 'cgroup'=>  $group ])
	@endforeach
	</ul>
</div>
