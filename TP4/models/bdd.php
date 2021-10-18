<?php
	$sqliteFile = $_SERVER['DOCUMENT_ROOT'] . '/TP4/models/tp4.db';
	var_dump($_SERVER['DOCUMENT_ROOT']);
	var_dump($sqliteFile);
	$SQL_DSN = 'sqlite:' . $sqliteFile;

	if (!file_exists($sqliteFile))
		throw new Exception("Erreur : Le fichier de BDD n'existe pas !");

	try {
		$pdo = new PDO($SQL_DSN);
	}
	catch( PDOException $e ) {
		echo 'Erreur : '.$e->getMessage();
		exit;
	}
?>