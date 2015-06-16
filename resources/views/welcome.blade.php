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
			<div class="col-md-12">
		Bangladesh Barometer is the website for the Public Opinion Analysis in Bangladesh. Bangladesh Barometer was established in 2014, and since then it has been monitoring the evolution of public opinion in Bangladesh on a range of politically- and policy-relevant issues. Our surveys address major topics concerning Bangladeshi politics such as: political and economic change, elections, citizens’ democratic participation with a focus on women and youth, political parties’ role in aggregating and representing citizens’ interests, etc.
			</div>
		</div>

		<hr>

		<div class="row">
			<div class="col-md-12 col-md-offset-5">
				<a href="{{url('/home')}}" class="btn btn-lg btn-primary">
					<b>Enter main site</b>
				</a>
			</div>
		</div>
	</div>
</body>
</html>
