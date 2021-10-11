<?php
	session_start();
	if (empty($_SESSION['login']))
	{
		header('Location: signin.php');
		exit;
	}
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Salut mon pote !</title>
  <link rel="stylesheet" href="style.css">
  <script src="script.js"></script>
</head>
<body>
	<h1>Ca dit quoi <?php echo $_SESSION['login']?> ?</h1>
	<h2>Si tu veux te déco, <a href="signout.php">clique ici</a></h1>
</body>
</html>