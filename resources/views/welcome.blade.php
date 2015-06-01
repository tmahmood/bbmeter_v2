<html>
	<head>
		<title>Bangladesh Barometer</title>
		<link href='{{ asset('/css/app.css')}}' rel='stylesheet' type='text/css'>

		<style>
			body {
				margin: 0;
				padding: 0;
				width: 100%;
				height: 100%;
				color: #555;
				display: table;
				font-weight: bold;
				font-family: 'Lato';
				background: url({{ asset('assets/imgs/bg.jpg') }}) no-repeat;
				background-size: cover;
			}

			.container {
				text-align: center;
				display: table-cell;
				vertical-align: middle;
			}

			.content {
				text-align: center;
				display: inline-block;
			}

			.title {
				font-size: 96px;
				margin-bottom: 40px;
			}

			.quote {
				font-size: 24px;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<div class="content">

				<div class="logobar">
					<img src="{{ asset('assets/imgs/logo_bar.png') }}">
				</div>

				<div class="title">Bangladesh Barometer</div>


				<div>
					<a href="{{url('/home')}}" class="btn btn-lg btn-primary">
						<b>Enter main site</b>
					</a>
				</div>
			</div>
		</div>
	</body>
</html>
