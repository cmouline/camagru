<?php
include('functions.php');

if (isset($_GET['action'])) {
	$connexion = connectDB();
	$currentLikeQuery = "SELECT `likes` FROM `post` WHERE `id` = " . $_GET['id'] . ";";
	$like_numbers = requestDB($connexion, $currentLikeQuery, "fetch");

	if ($_GET['action'] == 'like') {
		$like_plus_one = (int)$like_numbers[0] + 1;
		$query = "UPDATE `camagru`.`post` SET `likes` = '" . $like_plus_one . "' WHERE `post`.`id` = '" . $_GET['id'] . "';";
		requestDB($connexion, $query, "");

		$query = "INSERT INTO `camagru`.`likes` (`id`, `user`, `id_post`) VALUES (NULL, '" . $_GET['user'] . "', " . $_GET['id'] . ");";
		requestDB($connexion, $query, "");
		
		echo $like_plus_one;		
	} else if ($_GET['action'] == 'dislike') {
		$like_minus_one = (int)$like_numbers[0] - 1;
		$query = "UPDATE `camagru`.`post` SET `likes` = '" . $like_minus_one . "' WHERE `post`.`id` = '" . $_GET['id'] . "';";
		requestDB($connexion, $query, "");

		$query = "DELETE FROM `camagru`.`likes` WHERE user='" . $_GET['user'] . "' AND id_post='" . $_GET['id'] . "';";
		requestDB($connexion, $query, "");

		echo $like_minus_one;
	}
}
?>