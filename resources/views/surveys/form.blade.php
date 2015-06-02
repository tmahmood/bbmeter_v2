@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<form class="form" method="POST" action="admin/survey/save">
			<div class="panel panel-default">
				<div class="panel-heading">Survey</div>
				<div class="panel-body">
					<div class="form-group">
						<label for="survey_name">Survey name</label>
						<input id="survey_name" class="form-control"
							type="text" name="survey_name">
					</div>

					<div class="form-group">
						<label for="survey_type_id">Survey Type</label>
						<select id="survey_type_id" class="form-control" name="survey_type_id">
							@foreach(BBMeter\SurveyType::all() as $survey_type)
							<option value="{{$survey_type->id}}">{{$survey_type->survey_type_name}}</option>
							@endforeach
						</select>
					</div>

					<div class="form-group">
						<label for="margin_of_error">Margin of error</label>
						<input id="margin_of_error" class="form-control"
							type="text" name="margin_of_error">
					</div>

					<div class="form-group">
						<label for="participants">Participants</label>
						<input id="participants" class="form-control"
							type="text" name="participants">
					</div>

					<div class="form-group">
						<label for="survey_date">Survey date</label>
						<input id="survey_date" class="form-control"
							type="date" name="survey_date">
					</div>
				</div>

				<div class="panel-footer">
					<input type="hidden" value="{{ csrf_token() }}" name="_token">
					<input class="btn btn-success" type="submit" value="Save">
				</div>


			</div>
		</form>
@endsection

