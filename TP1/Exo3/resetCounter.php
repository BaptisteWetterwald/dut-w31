<?php
	session_start();
	unset($_SESSION['counter']);
	header('Location: http://localhost:42069/TP1/Exo3/counter.php');
?>