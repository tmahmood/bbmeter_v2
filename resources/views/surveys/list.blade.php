@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>Survey</th>
					<th>Date Started</th>
					<th>Date Ended</th>
					<th>Participants</th>
					<th>Extra Info</th>
					<th>Margin of Error</th>
				</tr>
			</thead>
			<tbody>
				@foreach($surveys as $item)
				<tr>
					<td>{{ $item->survey_name }}</td>
					<td>{{ $item->date_started }}</td>
					<td>{{ $item->date_ended }}</td>
					<td>{{ $item->participants }}</td>
					<td>{{ $item->extra_info }}</td>
					<td>{{ $item->margin_of_error }}</td>
					<td>
						<div class="btn-group">
							<a href="{{ url("/admin/surveys/edit/{$item->id}") }}"
								class="btn btn-success btn-sm"><span class="glyphicon glyphicon-edit"></span>
							</a>
							<a href="{{ url("/admin/surveys/delete/{$item->id}")}}"
								class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span>
							</a>
							<a href="{{ url("/admin/questions/list_by_survey/{$item->id}")}}"
								class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-play"></span>
							</a>
						</div>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection

