<?php
	session_start();
	if (empty($_SESSION['login']))
	{
		header('Location: signin.php');
		exit;
	}
	if (!empty($_SESSION['message']))
		echo "<section>" . $_SESSION['message'] . "</section>";
	
	if ($_SERVER['REQUEST_METHOD'] != "POST")
	{
		header('Location: formpassword.php');
		exit;
	}

	require_once 'models/bdd.php';
	$new_password = htmlentities($_POST['new_password']);
	$new_password_bis = htmlentities($_POST['new_password_bis']);
	if ($new_password == $new_password_bis)
	{
		$request = $pdo->prepare('UPDATE users SET password = ? WHERE login = ?');
		$ok = $request->bindValue(1, password_hash($new_password, PASSWORD_DEFAULT), PDO::PARAM_STR);
		$ok &= $request->bindValue(2, $_SESSION['login'], PDO::PARAM_STR);
		$ok &= $request->execute();
		if ($ok)
		{
			$_SESSION['message'] = "Password changed successfully!";
			header('Location: account.php');
		}
		else
		{
			$_SESSION['message'] = "There was an error while updating your password.";
			header('Location: formpassword.php');
		}
	}
	else
	{
		$_SESSION['message'] = "Passwords don't match!";
		header('Location: formpassword.php');
	}
?>