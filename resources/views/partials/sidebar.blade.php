<div id="primary-navigation">

	<ul>
	@foreach($groups as $group)
		@if($group->hide_group == 0)
			@include ('partials.sidebar_menu', [ 'cgroup'=>  $group ])
		@endif
	@endforeach
	</ul>
	@if (isset($latest) && $latest === true)
	<ul id="slideshow_items">
		<li>
			<a>
				<strong>SLIDES</strong>
			</a>
		</li>
	    <li>
	    	<a class="question_link"
				href="{{ url('question/207') }}">Direction in which Bangladesh is moving</a>
	    </li>
	    <li>
			<a class="question_link" href="{{ url('question/208') }}">Likely vote for?</a>
	    </li>
	</ul>
	@endif
</div>
