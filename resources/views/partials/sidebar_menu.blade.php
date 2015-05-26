<li>
	@if ($cgroup->isLeaf())
	<a class="questions_link" href="questions/{{ $cgroup->id }}">{{ $cgroup->group_name }}</a>
	@else
	<a class="submenu" href="#">{{ $cgroup->group_name }}</a>
	<ul>
		@foreach($cgroup->children as $cg)
			@include ('partials.sidebar_menu', [ 'cgroup'=>  $cg ])
		@endforeach
	</ul>
	@endif
</li>
