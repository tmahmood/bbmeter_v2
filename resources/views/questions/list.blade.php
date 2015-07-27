@extends('app')

@section('content')
<div class="container">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h2>Questions</h2>
			@if (isset($frontpage_questions))
			<div class="row">
				<form class="form" method="POST" action="{{url('admin/questions') }}">
					<input type="hidden" value="{{ csrf_token() }}" name="_token">
					<div class="col-lg-6">
						<div class="input-group">
							<input type="text" class="form-control" value="{{ $frontpage_questions->var_value }}" id="frontpage_questions" name="var_value">
							<input type="hidden" value="list" name="var_type">
							<span class="input-group-btn">
								<input class="btn btn-default" type="submit" value="update">
							</span>
						</div>
				  </div>
				</form>
			</div>
			@endif
		</div>
		<div class="panel-body">
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Question</th>
						<th>Group</th>
						<th>Graph type</th>
						<th>Has Crosstab</th>
						<th>Extra Info</th>
						@if (isset($frontpage_questions))
						<th>ACT</th>
						@endif
					</tr>
				</thead>
				<tbody>
					@foreach($questions as $item)
					<tr>
						<td>{{ $item->key }}</td>
						<td>{{ $item->group->group_name }}</td>
						<td>{{ $item->graph_type }}</td>
						<td>{{ $item->has_crosstabs }}</td>
						<td>{{ $item->extra_info }}</td>
						@if (isset($frontpage_questions))
						<td>
							<div class="btn-group">
								<button type="button" class="btn btn-sm btn-success btn_fp"
									data-toggle="button" aria-pressed="false" id="q_{{ $item->id }}"
									autocomplete="off"><span class="glyphicon glyphicon-home"></span>
								</button>
							</div>
						</td>
						@endif
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script type="text/javascript" src="{{asset('assets/js/questions.js')}}"></script>
@endsection
