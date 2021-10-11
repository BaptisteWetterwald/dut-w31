<?php
	$sqliteFile = $_SERVER['DOCUMENT_ROOT'] . '/TP3/tp3.db';
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