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
