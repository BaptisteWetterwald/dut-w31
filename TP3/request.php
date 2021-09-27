<?php

	$SQL_DSN = 'sqlite:/home/baptistew/W31/TP4/bdd.db';
	try {
		$pdo = new PDO($SQL_DSN);
	}
	catch( PDOException $e ) {
		echo 'Erreur : '.$e->getMessage();
		exit;
	}

	
?>