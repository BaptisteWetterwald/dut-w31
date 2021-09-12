<?php
	setcookie('counter', 0, time()-3600);
	header('Location: http://localhost:42069/TP1/Exo4/counter.php');
?>