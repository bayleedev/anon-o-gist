<!DOCTYPE HTML>
<html>
	<head>
		<title>Hello world</title>
	</head>
	<body>
		@section('sidebar')
			This is the master sidebar.
		@show

		<div class="container">
			@if(Session::has('message'))
				<div class="alert-box message">
					<h2>{{ Session::get('message') }}</h2>
				</div>
			@endif
			@yield('content')
		</div>
	</body>
</html>