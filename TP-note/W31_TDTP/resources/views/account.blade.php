<!DOCTYPE html>
<html>

	@extends('layouts.app')

	<head>
		<meta charset="utf-8">
		<title>Account</title>
	</head>
	<body>
		<h1>Account</h1>
		<p>
			Hello {{ $user->user }} !<br>
			Welcome on your account.
		</p>
		<ul>
			<li><a href="{{ route('profile') }}">My profile</a></li>
			<li><a href="{{ route('formrank') }}">Change my rank</a></li>
			<li><a href="{{ route('formRecipe') }}">Add recipe</a></li>

			<li><a href="{{ route('formpassword') }}">Change password.</a></li>
			<li><a href="{{ route('deleteuser') }}">Delete my account.</a></li>
		</ul>
		<p><a href="{{ route('signout') }}">Sign out</a></p>
	</body>
</html>
