<html>
    <head>
		<title>@yield('title')</title>
	</head>
    <body>
        @yield('header')
        @section('content')
			<h1>Ma page</h1>
		@endsection
		@show
        @include('shared.message')
    </body>
</html>