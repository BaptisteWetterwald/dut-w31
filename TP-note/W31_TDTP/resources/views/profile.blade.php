<!DOCTYPE html>
<html>

	@extends('layouts.app')

	<head>
		<meta charset="utf-8">
		<title>My profile</title>
	</head>
	<body>
		<h1>My Profile</h1>
		<p>
			Hello!<br>
			Your informations:
			<ul>
				<li>Login: {{ $user->user }}</li>
				<li>Rank: {{ $user->rank }}</li>
			</ul>
			Go back to <a href="{{ route('account') }}">Home</a></li>
		</p>
	</body>
</html>
