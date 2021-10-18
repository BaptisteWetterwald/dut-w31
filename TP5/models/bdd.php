<?php

// Nom du fichier du fichier de BDD SQLite sur le serveur
$sqliteFile = $_SERVER['DOCUMENT_ROOT'].'/models/tp4.db';

// Exception si le fichier n'existe pas
if (!file_exists($sqliteFile))
    throw new PDOException("DB file '".$sqliteFile."' doesn't exist");

// Variable contenant le DSN de la BDD SQLite
$SQL_DSN = 'sqlite:'.$sqliteFile;
