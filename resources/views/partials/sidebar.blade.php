<div id="primary-navigation">
	@if (isset($latest) && $latest === true)
	<ul id="slideshow_items">
		<li>
			<a>
				<strong>TIMELINE</strong>
			</a>
		</li>
	    <li>
	    	<a class="question_link"
				href="{{ url('question/207') }}">Direction in which Bangladesh is moving</a>
	    </li>
	    <li>
			<a class="question_link" href="{{ url('question/208') }}">Likely vote for?</a>
	    </li>
		<li>
			<a>
				<strong>LATEST QUESTIONS</strong>
			</a>
		</li>
		@foreach ($questions as $question)
		<li>
			<a class="question_link"
				href="{{ url('question/' . $question->id) }}">{{ $question->key }}</a>
		</li>
		@endforeach
	</ul>
	@else
	<ul>
	@foreach($groups as $group)
		@if($group->hide_group == 0)
			@include ('partials.sidebar_menu', [ 'cgroup'=>  $group ])
		@endif
	@endforeach
	</ul>
	@endif
</div>
