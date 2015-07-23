@extends('app')

@section('stylesheets')
<link href="{{ asset('assets/libs/infinitypush/jquery.ma.infinitypush.css') }}" rel="stylesheet">
@stop

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-3">
			<ul id="slideshow_items" >
				<li>
					<a><strong>LATEST SURVEY</strong></a>
				</li>
				<li>
					<a class="question_link" href="{{ url('question/4') }}">Voting behavior</a>
				</li>
				<li>
					<a class="question_link"
						href="{{ url('question/3') }}">Country's Direction</a>
				</li>
				@foreach ($questions as $question)
				<li>
					<a class="question_link" href="{{ url('question/' . $question->id) }}">{{ $question->key }}</a>
				</li>
				@endforeach
			</ul>
		</div>
		<div id="graph_content" class="col-md-7 col-md-offset-1">
			<h1 id="page-header"></h1>
			<div id="chart">
				<div class="pushdown">
					<h4>Opinion expressed in this portal do not necessarily
					reflect the views of the United States Agency for International Development
					or the United States Government.
					</h4>
				</div>
			</div>
			<div id="optionGroups">
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script src="http://code.highcharts.com/highcharts.js" type="text/javascript" charset="utf-8"></script>
<script src="{{ asset('assets/js/graph.js') }}"></script>
<script src="{{ asset('assets/js/home.js') }}"></script>
@stop


