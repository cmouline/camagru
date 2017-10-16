<?php
include('head.php');
include('header.php');
if (isset($_SESSION['logged_on_user'])) {
	?>
	<main class="photo-booth">
		<aside class="filters">
			<header class="top-photo-booth">1.Choisissez votre filtre</header>
			<div class="radio-buttons-group">
				<div class="miniature">
					<input form="no-webcam-file" align="middle" type="radio" name="filter" value="tomb-raider" onclick="filterSelection()" /><img class="filter-miniature" src="img/tomb-raider.png">
				</div>
				<div class="miniature">
					<input form="no-webcam-file" type="radio" name="filter" value="grumpy-cat" onclick="filterSelection()" /><img class="filter-miniature" src="img/grumpy-cat.png">
				</div>
				<div class="miniature">
					<input form="no-webcam-file" type="radio" name="filter" value="glasses" onclick="filterSelection()" /><img class="filter-miniature" src="img/glasses.png">
				</div>
			</div>
		</aside>
		<section id="shot-section">
			<header class="top-photo-booth">2.Selfitez!</header>
			<div id="video-div">
				<video autoplay="true" id="video-element"></video>
				<img id="tomb-raider" class="filter-on-video" src="img/tomb-raider.png">
				<img id="grumpy-cat" class="filter-on-video" src="img/grumpy-cat.png">
				<img id="glasses" class="filter-on-video" src="img/glasses.png">
			</div>
			<?php 
			echo "<button id='startbutton' disabled><span class='shoot'></span></button>";
			?>
			<canvas id="canvas" style="display:none"></canvas>
		</section>
		<aside class="latest-pictures">
			<header class="top-photo-booth">3.Vous voilà dans la galerie</header>
			<div id="id-last-pic-group" class="last-pic-group">
			<?php
			$connexion = connectDB();

			$query = "SELECT * FROM `post` ORDER BY id DESC;";
			$results = requestDB($connexion, $query, "fetchAll");
			foreach ($results as $result) { ?>
				<figure class="last-pic">
					<img src="<?php echo $result['picture']; ?>">
				</figure>
			<?php
			}
			?>
			</div>
		</aside>
	</main>
	<script type="text/javascript" src="js/webcam.js"></script>
	<script type="text/javascript" src="js/filter.js"></script>
	<?php
	include('footer.php');
	include('foot.php');
} else {
	header('Location: /');
}
?>