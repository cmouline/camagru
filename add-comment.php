<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
include('functions.php');

$connexion = connectDB();
$query = "INSERT INTO `camagru`.`comments` (`id`, `id_post`, `author`, `comment`) VALUES (NULL, '" . $_GET['id'] . "', '" .  $_SESSION['logged_on_user'] . "', '" . $_GET['comment'] . "');";
requestDB($connexion, $query, false);

$query = "SELECT * FROM `comments` JOIN `post` ON `comments`.`id_post` = `post`.`id` JOIN `user` ON `post`.`user` = `user`.`login` WHERE `comments`.`id_post` = '" . $_GET['id'] . "';";
$user = requestDB($connexion, $query, true);

$message = "Bonjour,<br /><br />Quelqu'un vient de commenter une de vos photos ! Venez vite le voir sur votre galerie perso !<br /><br />A bientôt sur camagru<br /><br />La camateam";
$headers = 'Content-type: text/html; charset=UTF-8' . "\r\n";
mail($user["email"], 'Vous avez un nouveau commentaire !', $message, $headers);
?>