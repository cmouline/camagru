<?php
include('head.php');
include('header.php');
?>
<main class="gallery">
	<section id="gallery-mosaic">
		<?php
		$connexion = connectDB();

		$postQuery = "SELECT * FROM `post` ORDER BY `id` DESC LIMIT 0, 10;";
		$results = requestDB($connexion, $postQuery, "fetchAll");
		foreach ($results as $result) { 

		$commentsQuery = "SELECT * FROM `comments` WHERE `id_post` = " . $result['id'];
		$comments = requestDB($connexion, $commentsQuery, "fetchAll");

		if (isset($_SESSION['logged_on_user'])) {

			$likesQuery = "SELECT * FROM `likes` WHERE `id_post` = " . $result['id'] . " AND `user` = '" . $_SESSION['logged_on_user'] . "'";
			$likes = requestDB($connexion, $likesQuery, "fetchAll");
		}
		?>
		<figure class="picture-plus-comments" id="<?php echo $result['id']; ?>">
			<img class="post" src="<?php echo $result['picture']; ?>">
			<figcaption>
				<div class="comments">
					Commentaires
					<?php
					if (isset($_SESSION['logged_on_user'])) {
						
						if (empty($likes)) { ?>

							<span id='<?php echo "reg-like-" . $result['id'] ;?>' class='heart' onclick="like(this, <?php echo $result['id'] ;?>, '<?php echo $_SESSION['logged_on_user'] ;?>')"><?php echo $result['likes'];?></span>

						<?php } else { ?>
							
							<span id='<?php echo "reg-like-" . $result['id'] ;?>' class='heart-full' onclick="dislike(this, <?php echo $result['id'] ;?>, '<?php echo $_SESSION['logged_on_user'] ;?>')"><?php echo $result['likes'];?></span>
							
						<?php }

					} else {

						echo "<span id='reg-like-" . $result['id'] . "' class='heart'>" . $result['likes'] . "</span>";

					}
					?>
					<ul id="comments-list-<?php echo $result['id']; ?>">
					<?php
					foreach ($comments as $comment) {
						echo "<li><span class='author'>" . $comment['author'] . "</span> " . htmlspecialchars($comment['comment']) . "</li>";	
					}?>
					</ul>
				</div>
				<?php
				if ( isset($_SESSION['logged_on_user']) ) { ?>
					<div class="new-comment">
					<?php
						echo "<textarea id='comment-textarea-" . $result['id'] . "'></textarea><span class='send' onclick='addComment(" . $result['id'] . ", \"" . $_SESSION['logged_on_user'] . "\")'></span>";
					?>
					</div>
				<?php } ?>
			</figcaption>
		</figure>			
		<?php
		}
		?>
	</section>
</main>
<script type="text/javascript" src="js/comments.js"></script>
<script type="text/javascript" src="js/scroll.js"></script>
<?php
include('footer.php');
include('foot.php');
?>