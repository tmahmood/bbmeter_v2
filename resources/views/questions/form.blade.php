@extends('app')

@section('content')
<div class="container">
	<form class="form" method="POST" action="admin/questions/save">
		<div class="panel panel-default">
			<div class="panel-heading">
				Question
			</div>
			<div class="panel-body">

				<div class="form-group">
					<label for="question">Question</label>
					<input id="question" class="form-control"
						type="text" name="question">
				</div>

				<div class="form-group">
					<label for="group_id">Group</label>
					<input id="group_path" class="form-control"
						type="text" name="group_path">
				</div>

				<div class="form-group">
					<label for="graph_type">Graph Type</label>
					<select id="graph_type" class="form-control" name="graph_type">
						<option value="Pie">Pie</option>
						<option value="Pie">DiscreteBar</option>
						<option value="Pie">GroupedMultiBar</option>
						<option value="Pie">SimpleLine</option>
					</select>
				</div>

				<div class="form-group">
					<label for="graph_data">Graph data</label>
					<textarea id="graph_data" class="form-control" name="graph_data"></textarea>
				</div>
			</div>

			<div class="panel-footer">
				<input type="hidden" value="{{ csrf_token() }}" name="_token">
				<input class="btn btn-success" type="submit" value="Save">
			</div>
		</div>
	</form>
</div>
@endsection

