<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
include('functions.php');

$connexion = connectDB();

$loginQuery = "SELECT * FROM `user` WHERE `email` LIKE '" . $_POST["email"] . "';";
$user = requestDB($connexion, $loginQuery, "fetch");

$delay = time() + (60 * 60);
$token = $delay . '-' . hash('whirlpool', $user['login']);

$query = "UPDATE `camagru`.`user` SET `token` = '" . $token . "' WHERE `login` = '". $user['login'] . "';";
$return = requestDB($connexion, $query, "");

if ($return === true) {
	$message = "Bonjour " . $user['login'] . ",<br /><br />Vous avez fait une demande de réinitialisation de votre mot de passe. Pour procéder au changement, veuillez suivre ce lien :<a href='http://camagru/change-pwd.php?token=" . $token . "'>http://camagru/change-pwd.php?token=" . $token . "</a><br /><br />Attention: ce lien n'est valide qu'une heure.<br /><br />A bientôt sur camagru<br /><br />La camateam";

	$headers = 'Content-type: text/html; charset=UTF-8' . "\r\n";

	$worked = mail($_POST["email"], 'Votre demande de réinitialisation de mot de passe', $message, $headers);
	header('Location: /');
}

?>