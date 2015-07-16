<li>
	@if ($cgroup->isLeaf())
		@if ($cgroup->hide_group == 0)
			<a class="groups_link" href="questions/group/{{ $cgroup->id }}">
				{{ $cgroup->group_name }}</a>
		@endif
	@else
	<a class="submenu" href="#">{{ $cgroup->group_name }}</a>
	<ul>
		@foreach($cgroup->children as $cg)
			@if($cg->hide_group == 0)
				@include ('partials.sidebar_menu', [ 'cgroup'=>  $cg ])
			@endif
		@endforeach
	</ul>
	@endif
</li>
