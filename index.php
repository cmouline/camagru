<?php
include('head.php');
include('header.php');
if (isset($_GET['login']) && $_GET['login'] == 'success') {
	
}
?>
<main class="home">
	<h1>Hot now !</h1>
	<section class="index-mosaic">
	<?php
	$connexion = connectDB();

	$query = "SELECT * FROM `post` ORDER BY `likes` DESC LIMIT 3;";
	$results = requestDB($connexion, $query, "fetchAll");
	foreach ($results as $result) {
	?>
		<figure>
			<img src="<?php echo $result['picture']; ?>">
			<figcaption><?php echo $result['likes'];?><span id='<?php echo "reg-like-" . $result['id'] ;?>' class='heart-full'></span></figcaption>
		</figure>
	<?php } ?>
	</section>
</main>
<?php
include('footer.php');
include('foot.php');
?>