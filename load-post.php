<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
include('functions.php');

try {
    $connexion = connectDB();
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Échec lors de la connexion : ' . $e->getMessage();
}

$query = "SELECT * FROM `post` WHERE id < " . $_GET['lastid'] . " ORDER BY id DESC LIMIT 0, 10;";
$results = requestDB($connexion, $query, "fetchAll");
$return = "";
foreach ($results as $result) {

	$commentsQuery = "SELECT * FROM `comments` WHERE `id_post` = " . $result['id'];
	$comments = requestDB($connexion,$commentsQuery, "fetchAll");

	$likesQuery = "SELECT * FROM `likes` WHERE `id_post` = " . $result['id'] . " AND `user` = '" . $_SESSION['logged_on_user'] . "'";
	$likes = requestDB($connexion, $likesQuery, "fetchAll");

	if (isset($_SESSION['logged_on_user'])) {
		
		if (empty($likes)) {
		
			$return .= "<figure class='picture-plus-comments' id='" . $result['id'] . "'><img class='post' src='" . $result['picture'] . "'><figcaption><div class='comments'>Commentaires<span id='reg-like-" . $result['id'] . "' class='heart' onclick='like(this, " . $result['id'] . ", `" . $_SESSION['logged_on_user'] . "`)'>" . $result['likes'] . "</span><ul id='comments-list-" . $result['id'] . "'>";

		} else {

			$return .= "<figure class='picture-plus-comments' id='" . $result['id'] . "'><img class='post' src='" . $result['picture'] . "'><figcaption><div class='comments'>Commentaires<span id='reg-like-" . $result['id'] . "' class='heart-full' onclick='dislike(this, " . $result['id'] . ", `" . $_SESSION['logged_on_user'] . "`)'>" . $result['likes'] . "</span><ul id='comments-list-" . $result['id'] . "'>";

		}

	} else {

			$return .= "<figure class='picture-plus-comments' id='" . $result['id'] . "'><img class='post' src='" . $result['picture'] . "'><figcaption><div class='comments'>Commentaires<span id='reg-like-" . $result['id'] . "' class='heart'>" . $result['likes'] . "</span><ul id='comments-list-" . $result['id'] . "'>";
	}

	foreach ($comments as $comment) {
		$return .= "<li><span class='author'>" . $comment['author'] . "</span> " . $comment['comment'] . "</li>";	
	}
	$return .= "</ul></div>";
	if ( isset($_SESSION['logged_on_user']) ) {
		$return .= `<div class="new-comment">`;
		$return .= "<textarea id='comment-textarea-" . $result['id'] . "'></textarea><span class='send' onclick='addComment(" . $result['id'] . ", \"" . $_SESSION['logged_on_user'] . "\")'></span></div>";
	}
	$return .= "</figcaption></figure>";
}
echo $return;