<?php

	require_once('bdd.php');
	$request = $pdo->prepare("SELECT * FROM users WHERE login = 'chevre'");
	$request->execute();
	print("PDO::FETCH_BOTH: ");
	print("Retourne la ligne suivante en tant qu'un tableau indexé par le nom et le numéro de la colonne\n");
	$result = $request->fetch(PDO::FETCH_BOTH);
	print_r($result);
?>