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
				</select>
			</div>
		</div>
		<div class="panel-footer">
			<input type="hidden" value="{{ csrf_token() }}" name="_token">
			<input class="btn btn-success" type="submit" value="Save">
		</div>
	</div>
</form>

