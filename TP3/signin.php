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
	<form action="authenticate.php" method="post">
		<label for="login">Login:</label>
		<input type="text" name="login" id="login" required>

		<label for="password">Password:</label>
		<input type="password" name="password" id="password" required>

		<input id="submit" type="submit" value="Go">
	</form>
	You still don't have an account? <a href="register.php">Register here!</a>
</body>
</html>