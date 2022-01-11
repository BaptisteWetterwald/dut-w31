<!DOCTYPE html>
<html>

	@extends('layouts.app')

	<head>
		<meta charset="utf-8">
		<title>New recipe</title>
	</head>
	<body>
		<h1>New recipe</h1>
		<form action="{{ route('addRecipe') }}" method="post">
			@csrf
			<label for="name">Name:</label><input type="text" id="name" name="name" required autofocus>
			<label for="timetoprepare">Preparation time</label><input type="number" id="timetoprepare" name="timetoprepare" required>
			<label for="ingredients">Ingredients</label><input type="textbox" id="ingredients" name="ingrediens" required>
			<label for="instructions">Instructions</label><input type="textbox" id="instructions" name="instructions" required>
			
			<input type="submit" value="Add">
		</form>
		<p>
			Go back to <a href="{{ route('account') }}">Home</a></li>
		</p>
	</body>
</html>
