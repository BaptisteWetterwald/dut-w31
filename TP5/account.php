<?php
	session_start();
	if ( empty($_SESSION['user']) )
	{
		header('Location: signin.php');
		exit();
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Account</title>
	</head>
	<body>
		<p>
			Hello <?= $_SESSION['user'] ?> !<br>
			Welcome on your account.
		</p>
		<ul>
			<li><a href="formpassword.php">Change password.</a></li>
			<li><a href="deleteuser.php">Delete my account.</a></li>
		</ul>
		<p><a href="signout.php">Sign out</a></p>
<?php if ( !empty($_SESSION['message']) ) { ?>
		<section>
			<p><?= $_SESSION['message'] ?></p>
		</section>
<?php } ?>
	</body>
</html>
