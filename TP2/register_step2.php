<?php
	session_start();
	if ($_SERVER['REQUEST_METHOD'] != "POST")
	{
		header("Location: http://localhost:42069/TP2/register.php");
		exit;
	}
	
	include 'bdd.php';

	$login = htmlentities($_POST['login']);
	if (!array_key_exists($login, $users))
	{
		$password = htmlentities($_POST['password']);
		$password_bis = htmlentities($_POST['password_bis']);
		if ($password == $password_bis)
		{
			$fullString = htmlentities(file_get_contents("bdd.php"));
			$cutString = mb_substr($fullString, 0, strlen($fullString) - 10);
			$cutString = $cutString . htmlspecialchars(",\n\t\t" . "'" . $login . "' => '" . $password . "'\n\t];\n?>");
			file_put_contents("bdd.php", htmlspecialchars_decode($cutString));
			$_SESSION['message'] = "Account created successfully, please login!";
			header("Location: http://localhost:42069/TP2/signin.php");
		}
		else
		{
			$_SESSION['message'] = "Passwords don't match!";
			header("Location: http://localhost:42069/TP2/register.php");
		}
	}
	else
	{
		$_SESSION['message'] = "This login is already linked to an account!";
		header("Location: http://localhost:42069/TP2/register.php");
	}
?>