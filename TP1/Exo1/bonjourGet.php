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
		if (isset($_GET["module"]) && strlen($_GET["module"]) != 0)
		{
			$_GET["module"] = htmlentities($_GET["module"]);
			echo $_GET['module'];
		}
		else
			echo "Pas de param module";
	?>

</body>
</html>