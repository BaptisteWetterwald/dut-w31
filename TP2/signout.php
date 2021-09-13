<?php
	session_start();
	session_destroy();
	header('Location: http://localhost:42069/TP2/signin.php');
?>