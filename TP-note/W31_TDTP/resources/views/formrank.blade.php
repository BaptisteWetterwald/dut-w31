<!DOCTYPE html>
<html>
	@extends('layouts.app')

	<head>
		<meta charset="utf-8">
		<title>Change rank</title>
	</head>
	<body>
		<h1>Change rank</h1>
		<form action="{{ route('changerank') }}" method="post">
			@csrf
			<label for="rank">New rank:</label>

			@include('shared.rank')

			<input type="submit" value="Change my rank">
		</form>
		<p>
			Go back to <a href="{{ route('account') }}">Home</a></li>
		</p>
	</body>
</html>
