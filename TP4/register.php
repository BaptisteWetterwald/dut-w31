<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Auth</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
	<?php
		session_start();
		if (!empty($_SESSION['message']))
			echo "<section>" . $_SESSION['message'] . "</section>";
	?>
	<form action="register_step2.php" method="post">
		<label for="login">Login:</label>
		<input type="text" name="login" id="login" required>
		<br>
		<label for="password">Password:</label>
		<input type="password" name="password" id="password" required>
		<br>
		<label for="password_bis">Password confirmation:</label>
		<input type="password" name="password_bis" id="password_bis" required>
		<br>
		<input id="submit" type="submit" value="Create this account">
	</form>
	Already got an account? <a href="signin.php">Login here!</a>
</body>
</html>