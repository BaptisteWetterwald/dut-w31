<?php
	session_start();
	if (empty($_SESSION['login']))
	{
		header('Location: signin.php');
		exit;
	}
	if (!empty($_SESSION['message']))
		echo "<section>" . $_SESSION['message'] . "</section>";
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Hey you!</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
	<h1>How are you  <?php echo $_SESSION['login']?> ?</h1>
	<h2><a href="signout.php">Log out</a></h1>
	<h2>Wanna change your password? <a href="formpassword.php">Click here!</a></h2>
</body>
</html>