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
		if (empty($_SESSION['login']))
		{
			header('Location: signin.php');
			exit;
		}
		else if (!empty($_SESSION['message']))
			echo "<section>" . $_SESSION['message'] . "</section>";
	?>
	<form action="changepassword.php" method="post">
		<label for="new_password">New password:</label>
		<input type="password" name="new_password" id="new_password" required>

		<label for="new_password_bis">Password confirmation:</label>
		<input type="password" name="new_password_bis" id="new_password_bis" required>

		<input id="submit" type="submit" value="Go">
	</form>
	Changed your mind?<a href="account.php">Click here!</a>
</body>
</html>