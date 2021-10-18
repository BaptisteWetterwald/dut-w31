<?php
/******************************************************************************
 * Initialisation.
 */

session_start();
unset($_SESSION['message']);

/******************************************************************************
 * Traitement des données de la requête
 */

// 1. On vérifie que la méthode HTTP utilisée est bien POST
if ( $_SERVER['REQUEST_METHOD'] != 'POST' )
{
	header('Location: signin.php');
	exit();
}

// 2. On vérifie que les données attendues existent
if ( empty($_POST['login']) || empty($_POST['password']) )
{
	$_SESSION['message'] = "Some POST data are missing.";
	header('Location: signin.php');
	exit();
}

// 3. On sécurise les données reçues
$login = htmlspecialchars($_POST['login']);
$password = htmlspecialchars($_POST['password']);

/******************************************************************************
 * Chargement du model
 */

require_once('models/User.php');

/******************************************************************************
 * Authentification
 */

// 1. On crée l'utilisateur avec les identifiants passés en POST
$user = new User($login,$password);

// 2. On vérifie qu'il existe dans la BDD
try {
	if ( !$user->exists() )
	{
		$_SESSION['message'] = 'Wrong login/password.';
		header('Location: signin.php');
		exit();
	}
}
catch (PDOException $e) {
	// Si erreur lors de la création de l'objet PDO
	// (déclenchée par MyPDO::pdo())
	$_SESSION['message'] = $e->getMessage();
	header('Location: signin.php');
	exit();
}
catch (Exception $e) {
	// Si erreur durant l'exécution de la requête
	// (déclenchée par le throw de $user->exists())
	$_SESSION['message'] = $e->getMessage();
	header('Location: signin.php');
	exit();
}

// 3. On sauvegarde le login dans la session
$_SESSION['user'] = $login;

// 4. On sollicite une redirection vers la page du compte
header('Location: account.php');
exit();
