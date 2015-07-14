@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<form class="form" method="POST" action="{{ url('admin/groups/save') }}">

			<div class="panel panel-default">
				<div class="panel-heading">
					Group
				</div>
				<div class="panel-body">
					<div class="form-group">
						<label for="group">Group Path</label>
						<input id="group" class="form-control"
							type="text" name="group">
					</div>
				</div>
				<div class="panel-footer">
					<input type="hidden" value="{{ csrf_token() }}" name="_token">
					<input class="btn btn-success" type="submit" value="Save">
				</div>
			</div>
		</form>
	</div>
</div>
@endsection

