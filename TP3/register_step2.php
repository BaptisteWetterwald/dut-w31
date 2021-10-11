<?php
	session_start();
	if ($_SERVER['REQUEST_METHOD'] != "POST")
	{
		header("Location: register.php");
		exit;
	}

	require_once 'bdd.php';

	$request = $pdo->prepare('SELECT login FROM users WHERE login = ?');
	$request->bindValue(1, strtolower(htmlentities($_POST['login'])), PDO::PARAM_STR);
	$request->execute();

	if ($request->fetch() == null)
	{
		$password = htmlentities($_POST['password']);
		$password_bis = htmlentities($_POST['password_bis']);
		if ($password == $password_bis)
		{
			$request = $pdo->prepare('INSERT INTO users(login, password) VALUES(:login, :password)');
			$_POST['login'] = strtolower(htmlentities($_POST['login']));
			$_POST['password'] = htmlentities($_POST['password']);
			$request->bindValue(':login', $_POST['login'], PDO::PARAM_STR);
			$request->bindValue(':password', password_hash($_POST['password'], PASSWORD_DEFAULT), PDO::PARAM_STR);
			$request->execute();
			$_SESSION['message'] = "Account created successfully, please login!";
			header("Location: signin.php");
		}
		else
		{
			$_SESSION['message'] = "Passwords don't match!";
			header("Location: register.php");
		}
	}
	else
	{
		$_SESSION['message'] = "This login is already linked to an account!";
		header("Location: register.php");
	}
?>