@extends('app')

@section('content')
<div class="container">
	<form class="form" method="POST" action="{{ url('admin/questions/save') }}">
		<div class="panel panel-default">
			<div class="panel-heading">
				Question
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label for="survey_id">Survey</label>
					<select id="survey_id" class="form-control" name="survey_id">
						<option> --------- </option>
						@foreach(BBMeter\Survey::all() as $survey)
						<option value="{{$survey->id}}">{{$survey->survey_name}}</option>
						@endforeach
					</select>
				</div>

				<div class="form-group">
					<label for="key">Question</label>
					<input id="key" class="form-control"
						type="text" name="key">
				</div>

				<div class="form-group">
					<label for="group_path">Group</label>
					<select id="group_id" class="form-control"
						type="text" name="group_id">
						<option> ------------- </option>
						@foreach($groups as $group)
						<option value="{{ $group[0] }}">{{$group[1]}}</option>
						@endforeach
					</select>
					<a  href="{{ url('admin/groups/create') }}"
						class="btn btn-sm btn-primary" target="_blank">
						add group
					</a>
				</div>

				<div class="form-group">
					<label for="type">Graph Type</label>
					<select id="graph_type" class="form-control" name="graph_type">
						<option> ------------- </option>
						<option>Pie</option>
						<option>DiscreteBar</option>
						<option>GroupedMultiBar</option>
						<option>SimpleLine</option>
						<option>VStackedBar</option>
						<option>HStackedBar</option>
					</select>
				</div>

				<div class="form-group">
					<label for="option_group">Option group</label>
					<input id="option_group" class="form-control"
						type="text" name="option_group">
				</div>

				<div class="form-group">
					<label for="graph_data">Graph data</label>
					<textarea id="graph_data" class="form-control" name="graph_data" rows="10"></textarea>
				</div>

				<div class="form-group">
					<label for="guid">GUID</label>
					<input id="guid" class="form-control"
						type="text" name="guid">
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

