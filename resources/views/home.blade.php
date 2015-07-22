@extends('app')

@section('stylesheets')
<link href="{{ asset('assets/libs/infinitypush/jquery.ma.infinitypush.css') }}" rel="stylesheet">
@stop

@section('content')
<div class="container-fluid" id="archive">
	<div class="row">
		<div>@include('partials.sidebar', [ 'groups' => $groups ])</div>
		<div id="questions_list">
 			<strong>◀ Please select an option from the side bar</strong>
		</div>
		<div id="graph_content">
			<h1 id="page-header">
			</h1>
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
<script src="{{ asset('assets/libs/infinitypush/jquery.ma.infinitypush.js') }}"></script>
<script src="{{ asset('assets/js/graph.js') }}"></script>
<script src="{{ asset('assets/js/home.js') }}"></script>
@stop

