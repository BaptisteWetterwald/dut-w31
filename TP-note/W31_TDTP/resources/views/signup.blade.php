<!DOCTYPE html>
<html>

	@extends('layouts.app')

	<head>
		<meta charset="utf-8">
		<title>Signup</title>
	</head>
	<body>
		<h1>Signup</h1>
		<form action="{{ route('adduser') }}" method="post">
			@csrf
			<label for="login">Login</label>             <input type="text"     id="login"    name="login"    required autofocus>
			<label for="password">Password</label>       <input type="password" id="password" name="password" required>
			<label for="confirm">Confirm password</label><input type="password" id="confirm"  name="confirm"  required>
			
			<label for="rank">Cooker rank:</label>
			@include('shared.rank')

			<input type="submit" value="Signup">
		</form>
		<p>
			If you already have an account, <a href="{{ route('signin') }}">signin</a>.
		</p>
	</body>
</html>
