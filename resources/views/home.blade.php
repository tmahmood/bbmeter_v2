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
				<strong></strong>
			</h1>

			<div role="tabpanel" id="tabpanel">

			  <ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active">
					<a href="#all" aria-controls="all" role="tab" data-toggle="tab">All</a>
				</li>
			  </ul>

			  <div class="tab-content">
				<div role="tabpanel" class="tab-pane" id="all">
					<div id="chart">
					</div>
				</div>

			  </div>

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

