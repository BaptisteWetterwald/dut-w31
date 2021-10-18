<?php
	session_start();
	if ($_SERVER['REQUEST_METHOD'] != "POST")
	{
		header("Location: signin.php");
		exit;
	}
	
	require_once 'models/bdd.php';

	$login = strtolower(htmlentities($_POST['login']));

	$request = $pdo->prepare('SELECT password FROM users WHERE login = ?');
	$request->bindValue(
		1, $login, PDO::PARAM_STR
	);
	$request->execute();
	$real_password = $request->fetch()['password'];
	if (!empty($real_password))
	{
		$password = htmlentities($_POST['password']);
		if (password_verify($password, $real_password))
		{
			$_SESSION['login'] = $login;
			$_SESSION['message'] = "Successfully logged in!";
			header("Location: account.php");
		}
		else
		{
			$_SESSION['message'] = "Wrong password";
			header("Location: signin.php");
		}
	}
	else
	{
		$_SESSION['message'] = "This id does not exist";
		header("Location: signin.php");
	}
?>