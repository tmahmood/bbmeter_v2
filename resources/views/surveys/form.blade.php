@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<form class="form" method="POST" action="{{ url('admin/surveys/save/') }}/{{ $survey->id or ''  }}">
			<div class="panel panel-default">
				<div class="panel-heading">Survey</div>
				<div class="panel-body">

					<div class="form-group">
						<label for="survey_name">Survey name</label>
						<input id="survey_name" class="form-control"
							type="text" name="survey_name" value="{{ isset($survey) ? $survey->survey_name : '' }}">
					</div>

					<div class="form-group">
						<label for="survey_type_id">Survey Type</label>
						<select id="survey_type_id" class="form-control" name="survey_type_id">
							@foreach(BBMeter\SurveyType::all() as $survey_type)
							<option value="{{$survey_type->id}}"
								@if(isset($survey))
									{{ $survey->survey_type_id == $survey_type->id ? "selected" : "" }}
								@endif
								>{{$survey_type->survey_type_name}}</option>
							@endforeach
						</select>
					</div>

					<div class="form-group">
						<label for="margin_of_error">Margin of error</label>
						<input id="margin_of_error" class="form-control"
							type="text" name="margin_of_error" value="{{ isset($survey) ? $survey->margin_of_error : "" }}">
					</div>

					<div class="form-group">
						<label for="participants">Participants</label>
						<input id="participants" class="form-control"
							type="text" name="participants" value="{{ isset($survey) ? $survey->participants : "" }}">
					</div>

					<div class="form-group">
						<label for="survey_date">Survey date</label>
						<input id="survey_date" class="form-control datepicker"
							type="date" name="survey_date" value="{{ isset($survey) ? $survey->survey_date : "" }}">
					</div>

					<div class="form-group">
						<label for="date_ended">Survey Ended</label>
						<input id="date_ended" class="form-control datepicker"
							type="date" name="date_ended" value="{{ isset($survey) ? $survey->date_ended : "" }}">
					</div>


					<div class="form-group">
						<label for="extra_info">Extra info</label>
						<input id="extra_info" class="form-control"
							type="text" name="extra_info" value="{{ isset($survey) ? $survey->extra_info : "" }}">
					</div>

					<div class="form-group">
						<label for="survey_guid">Survey GUID</label>
						<input id="survey_guid" class="form-control" readonly
							type="text" name="survey_guid" value="{{ isset($survey) ? $survey->survey_guid : "" }}">
					</div>
				</div>

				<div class="panel-footer">
					<input type="hidden" value="{{ csrf_token() }}" name="_token">
					<input class="btn btn-success" type="submit" value="Save Survey">
				</div>


			</div>
		</form>
@endsection

