<li>
	@if ($cgroup->isLeaf())
		@if ($cgroup->hide_group == 0)
			<a class="groups_link" href="questions/group/{{ $cgroup->id }}">
				{{ $cgroup->group_name }}</a>
		@endif
	@else
	<a class="submenu" href="#">{{ $cgroup->group_name }}</a>
	<ul>
		@for ($i = count($cgroup->children) - 1; $i>= 0; $i--)
			@if($cgroup->children[$i]->hide_group == 0)
				@include ('partials.sidebar_menu', [ 'cgroup'=>  $cgroup->children[$i] ])
			@endif
		@endfor
	</ul>
	@endif
</li>
