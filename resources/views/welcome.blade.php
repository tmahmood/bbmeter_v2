<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Bangladesh Barometer</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link href='{{ asset('/assets/css/landing.css')}}' rel='stylesheet' type='text/css'>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-5">
				<div class="title"><img src="{{ asset('assets/imgs/logo.svg')}}" class="img-responsive"></div>
			</div>

			<div class="col-md-7">
				<div class="logobar">
					<img src="{{ asset('assets/imgs/logo_bar.png') }}" class="img-responsive">
				</div>
			</div>
		</div>


		<div class="row content">
			@include ('aboutdishort')
		</div>

		<div class="row">
			<div class="col-md-12">
				<a href="{{url('/home')}}" class="btn btn-lg btn-primary">
					<b>Enter main site</b>
				</a>
			</div>
		</div>
	</div>
</body>
</html>
