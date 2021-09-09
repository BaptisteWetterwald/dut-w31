<?php
	if ($_SERVER['REQUEST_METHOD'] != "POST")
	{
		header("Location: http://localhost:42069/TP1/Exo1/formulaire.html");
		exit;
	}
?>
<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Titre de la page</title>
	<link rel="stylesheet" href="style.css">
	<script src="script.js"></script>
</head>
<body>
	<?php
		if (isset($_POST['firstname']) && isset($_POST['lastname'])
		&& !empty($_POST['firstname']) && !empty($_POST['lastname']))
		{
			$_POST['firstname'] = htmlentities($_POST['firstname']);
			$_POST['lastname'] = htmlentities($_POST['lastname']);

			echo "Hi " . $_POST['firstname'] . " " . $_POST['lastname'] . "!";
		}
		else
			echo "Who are you?"
	?>
</body>
</html>