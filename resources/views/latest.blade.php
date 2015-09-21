@extends('app')

@section('stylesheets')
<link href="{{ asset('assets/libs/infinitypush/jquery.ma.infinitypush.css') }}" rel="stylesheet">
@stop

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-3">
			@if (isset($survey))
			<h4>{{$survey->survey_name}}</h4>
			@endif
			<ul id="slideshow_items" >
				@foreach ($questions as $question)
				<li>
					<a class="question_link" href="{{ url('question/' . $question->id) }}"
						>{{ $question->key }}</a>
				</li>
				@endforeach
			</ul>
		</div>
		<div id="graph_content" class="col-md-7 col-md-offset-1">
			<h1 id="page-header"></h1>
			<div id="chart">
				<div class="pushdown">
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


