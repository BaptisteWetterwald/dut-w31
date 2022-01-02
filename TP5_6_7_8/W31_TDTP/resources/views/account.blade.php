<!DOCTYPE html>
<html>

	@extends('layouts.app')

	<head>
		<meta charset="utf-8">
		<title>Account</title>
	</head>
	<body>
		<p>
			Hello {{ $user->user }} !<br>
			Welcome on your account.
		</p>
		<ul>
			<li><a href="{{ route('formpassword') }}">Change password.</a></li>
			<li><a href="{{ route('deleteuser') }}">Delete my account.</a></li>
		</ul>
		<p><a href="{{ route('signout') }}">Sign out</a></p>
	</body>
</html>
