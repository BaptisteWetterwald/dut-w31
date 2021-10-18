<?php
/******************************************************************************
 * Initialisation.
 */

session_start();
unset($_SESSION['message']);

/******************************************************************************
 * Vérification de la session
 */

// 1. On vérifie que l'utilisateur est connecté
if ( empty($_SESSION['user']) )
{
	header('Location: signin.php');
	exit();
}

// 2. On récupère le login dans une variable
$login = $_SESSION['user'];

/******************************************************************************
 * Chargement du model
 */

require_once('models/User.php');

/******************************************************************************
 * Suppression de l'utilisateur
 */

// 1. On crée l'utilisateur avec les identifiants passés en POST
$user = new User($login);

// 2. On détruit l'utilisateur dans la BDD
try {
	$user->delete();
}
catch (PDOException $e) {
	// Si erreur lors de la création de l'objet PDO
	// (déclenchée par MyPDO::pdo())
	$_SESSION['message'] = $e->getMessage();
	header('Location: account.php');
	exit();
}
catch (Exception $e) {
	// Si erreur durant l'exécution de la requête
	// (déclenchée par le throw de $user->create())
	$_SESSION['message'] = $e->getMessage();
	header('Location: account.php');
	exit();
}

// 3. On détruit la session
session_destroy();

// 4. On crée une nouvelle session
session_start();

// 5. On indique que le compte a bien été supprimé
$_SESSION['message'] = "Account successfully deleted.";

// 6. On sollicite une redirection vers la page d'accueil
header('Location: signin.php');
exit();
