<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Bangladesh Barometer</title>

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

	@section('stylesheets')
	@show

	<link href="{{ asset('assets/css/master.css') }}" rel="stylesheet">

</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="{{ url('/home') }}">
					<img src="{{ asset('assets/imgs/logo.svg')}}">
				</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/home') }}">LONGITUDINAL TRENDS</a></li>
					<li><a href="{{ url('/latest') }}">LATEST SURVEY</a></li>
					<li><a href="{{ url('/archieve') }}">ARCHIVE</a></li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					<li><a href="http://democracyinternational.com/" target="_blank">
						<img src="{{ asset('assets/imgs/di_logo_t.png') }}"
							class="makeitsmall">
					</a></li>
					<li class="wrap">

					<a tabindex="0" data-toggle="popover" id="popover_link_aboutdi"
						data-trigger="focus" title="About Democracy International" data-container="body"
						data-content='
	<div class="col-md-12">
		<b>Democratic Participation and Reform</b>
		<p>Project Duration: April, 2011 - April, 2016</p>
		<p>In Bangladesh, Democracy International is implementing the Democratic Participation and Reform Program, a USAID-funded political party development program designed to</p>
	</div>

	<div class="col-md-4">
		<b>ENHANCING GRASSROOTS PARTICIPATION</b>
		<p>To increase the political engagement of women and youth in political parties and in national political activity, DI has conducted awareness campaigns, including town hall meetings and women’s dialogues, to inform women and youth on ways to participate in political process. DI is also managing a fellowship program for young political party activists aiming to enhance their capacity and give them the opportunity to engage with national and regional party leaders on important political and policy issues.</p>
	</div>
	<div class="col-md-4">
		<b>IMPROVING INFORMATION ACCESS AND UTILIZATION</b>
			<p>To strengthen the capacity of political parties to conduct and utilize research, DI is leading a series of activities to demonstrate the value of public opinion research, develop effective polling and research approaches, and incorporate research findings into policy information and communication strategies. Specific activities include an applied research program, including regional and national surveys; and a targeted research training program.</p>

	</div>
	<div class="col-md-4">
		<b>IMPROVING THE ENVIRONMENT FOR RESPONSIVE POLITICS</b>
		<p>To improve and facilitate coordination on reform initiatives between national party organizations and historically marginalized political groups, particularly women and youth, DI is engaging parties in more sophisticated and strategic constituency outreach. Specific activities include a national conference series, the creation of party web portals, and the funding of specific series party requests for technical assistance.</p>
	</div>'><span class="glyphicon glyphicon-info-sign"></span></a>
					</li>
					<li class="wrap">
					<a tabindex="0" data-toggle="popover" id="popover_link_methodology"
						data-trigger="focus" title="METHODOLOGY" data-container="body"
						data-content="<p>DI utilizes two data collection methodologies to conduct it quantitative research: face-to-face and telephone surveys. DI subcontracts with local vendors to conduct face-to-face surveys, using a nationally representative, multi-stage random sampling technique. For face-to-face surveys, DI generally conducts interviews with between 1,500 and 2,500 adults. The margin of error for face-to-face surveys is generally between +/- 2.0% and 2.5% with a 95% confidence level. DI requires strict quality control protocols from its vendors, demanding at least 30% of all interviews are verified. DI pre-tests its surveys among a wide variety of demographics to assess clarity, comprehension and translation quality.</p>
	<p>DI conducts telephone surveys using its proprietary <b>Computer Assisted Telephone Survey System</b> (CATSS). Samples are drawn by randomly generating mobile phone numbers from all six mobile phone operating companies proportional to market share. For telephone surveys, DI generally conducts interviews with between 800 and 1,500 adults. The margin of error for telephone surveys is generally between +/- 2.5% and 3.5% with a 95% confidence level. Due to disproportionate levels of mobile access between men and women and in urban and rural areas, survey data is weighted to account for under-representation of women and citizens in rural areas. DI conducts internal quality control, verifying 30% of all telephone interviews. It also pretests all questionnaires and provides regular training for its interviewing staff.</p>">
			<span class="glyphicon glyphicon-book"></span></a>

					</li>
					<li><a href="{{ url('auth/logout') }}">Logout</a></li>
				</ul>
			</div>
		</div>
	</nav>

	@yield('content')

	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<script src="{{ asset('assets/js/element.js') }}"></script>
	<script src="{{ asset('assets/js/main.js') }}"></script>

	@section('scripts')
	@show

</body>
</html>
