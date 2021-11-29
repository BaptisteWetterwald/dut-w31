<?php
	if ( empty($_SESSION['user']) )
	{
		header('Location: signin');
		exit();
	}
?>
<!DOCTYPE html>
<html>

	@extends('layouts.app')

	<head>
		<meta charset="utf-8">
		<title>Account</title>
	</head>
	<body>
		<p>
			Hello {{ $user }} !<br>
			Welcome on your account.
		</p>
		<ul>
			<li><a href="formpassword">Change password.</a></li>
			<li><a href="deleteuser">Delete my account.</a></li>
		</ul>
		<p><a href="signout">Sign out</a></p>
	</body>
</html>
