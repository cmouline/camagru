<?php
include('head.php');
include('header.php');
if (isset($_SESSION['logged_on_user'])) {
?>
<main class="account">
	<header class="account-header">
		<figure>
			<img src="img/default-user.png">
			<figcaption class="user-login"><?php echo $_SESSION['logged_on_user']; ?></figcaption>
		</figure>
		<p>Pour supprimer une de vos images, cliquez simplement dessus</p>
	</header>
	<section class="account-body">
		<?php
		$connexion = connectDB();

		$query = "SELECT * FROM `post` WHERE `user` LIKE '" . $_SESSION['logged_on_user'] . "' ORDER BY `id` DESC";
		$results = requestDB($connexion, $query, "fetchAll");

		foreach ($results as $result) {

		$commentsQuery = "SELECT * FROM `comments` WHERE `id_post` = ". $result['id'];
		$comments = requestDB($connexion, $commentsQuery, "fetchAll");
		?>
		<figure class="picture-plus-comments" id="<?php echo $result['id']; ?>">
			<?php
			echo "<img src='" . $result['picture'] . "' onclick='deletePicture(this," .  $result['id'] . ")'>";
			?>
			<figcaption>
				<div class="comments">
					Commentaires
					<?php 
					echo "<span id='reg-like-" . $result['id'] . "' class='heart'>" . $result['likes'] . "</span>";
					?>
					<ul id="comments-list">
					<?php
					foreach ($comments as $comment) {
						echo "<li><span class='author'>" . $comment['author'] . "</span> " . htmlspecialchars($comment['comment']) . "</li>";	
					}
					?>
					</ul>
				</div>
			</figcaption>
		</figure>	
		<?php
		}
		?>
	</section>
</main>
<script type="text/javascript" src="js/delete-picture.js"></script>
<?php
include('footer.php');
include('foot.php');
} else {
	header('Location: /');
}
?>