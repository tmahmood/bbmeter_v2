@extends('app')

@section('stylesheets')
<link href="{{ asset('assets/libs/infinitypush/jquery.ma.infinitypush.css') }}" rel="stylesheet">
@stop

@section('content')
<div class="container-fluid">
	<div class="row">
		<div>@include('partials.sidebar', [ 'groups' => $groups ])</div>

		<div id="questions_list"></div>

		<div id="graph_content">

			<h1 id="page-header">
				<strong>Please select question from the side bar</strong>
			</h1>

			<div id="chart"></div>

			<div id="optionGroups"></div>

		</div>
	</div>
</div>
@endsection

@section('scripts')
<script src="http://code.highcharts.com/highcharts.js" type="text/javascript" charset="utf-8"></script>
<script src="{{ asset('assets/libs/infinitypush/jquery.ma.infinitypush.js') }}"></script>
<script src="{{ asset('assets/js/graph.js') }}"></script>
<script src="{{ asset('assets/js/home.js') }}"></script>
@stop

