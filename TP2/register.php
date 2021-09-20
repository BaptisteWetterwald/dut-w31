<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Auth</title>
  <link rel="stylesheet" href="style.css">
  <script src="script.js"></script>
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

		<label for="password">Password:</label>
		<input type="password" name="password" id="password" required>

		<label for="password_bis">Password confirmation:</label>
		<input type="password" name="password_bis" id="password_bis" required>

		<input id="submit" type="submit" value="Create this account">
	</form>

	You already have an account? <a href="signin.php">Login here!</a>
</body>
</html>