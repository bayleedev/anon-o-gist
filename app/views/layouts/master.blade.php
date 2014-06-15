<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<title>@yield('title')</title>
		@section('head')
			<link rel="stylesheet" href="/css/bootstrap.css">
			<link rel="stylesheet" href="/css/form.css">
			<link rel="stylesheet" href="/css/codemirror/codemirror.css">
			<script src="/js/codemirror/codemirror.js"></script>
			<script src="/js/codemirror/mime/htmlmixed.js"></script>
			<script src="/js/codemirror/mime/xml.js"></script>
			<script src="/js/codemirror/mime/javascript.js"></script>
			<script src="/js/codemirror/mime/css.js"></script>
			<script src="/js/codemirror/mime/clike.js"></script>
			<script src="/js/codemirror/mime/php.js"></script>
			<link rel="stylesheet" href="/css/codemirror/monokai.css">
			<style type="text/css">
				.CodeMirror {border-top: 1px solid black; border-bottom: 1px solid black;}
			</style>
			<link rel="stylesheet" href="/css/codemirror/docs.css">
		@show
	</head>
	<body>
		@section('sidebar')
		@show

		<div class="container">
			@if(Session::has('message'))
				<div class="alert-box message">
					<h2>{{ Session::get('message') }}</h2>
				</div>
			@endif
			@yield('content')
		</div>
		@section('foot')
			<script>
			var editor = CodeMirror.fromTextArea(document.getElementById("code"),
			{
				lineNumbers:    true,
				matchBrackets:  true,
				mode:           "application/x-httpd-php",
				indentUnit:     4,
				indentWithTabs: true,
				enterMode:      "keep",
				tabMode:        "shift"
			});
			editor.setOption("theme", "monokai");
			</script>
		@show
	</body>
</html>
