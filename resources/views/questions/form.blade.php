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
				<input id="group_id" class="form-control"
					type="text" name="group_id">
			</div>

		<div class="panel-footer">
			<input type="hidden" value="{{ csrf_token() }}" name="_token">
			<input class="btn btn-success" type="submit" value="Save">
		</div>
	</div>
</form>

