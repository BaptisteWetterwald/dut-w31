<?php
	session_start();
	if ($_SERVER['REQUEST_METHOD'] != "POST")
	{
		header("Location: http://localhost:42069/TP2/signin.php");
		exit;
	}
	
	include 'bdd.php';

	$login = htmlentities($_POST['login']);
	if (array_key_exists($login, $users))
	{
		$password = htmlentities($_POST['password']);
		echo "Login = " . $login . ", pass = " . $password;
		if (htmlentities($password) == $users[$login])
		{
			$_SESSION['login'] = $login;
			header("Location: http://localhost:42069/TP2/account.php");
		}
		else
		{
			$_SESSION['message'] = "Wrong password";
			header("Location: http://localhost:42069/TP2/signin.php");
		}
			
	}
	else
	{
		$_SESSION['message'] = "This id does not exist";
		header("Location: http://localhost:42069/TP2/signin.php");
	}
?>