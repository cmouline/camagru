<header class="main-header">
	<img class="logo" src="img/minion-logo.png">
	<h1>CAMA-GRUUUUU</h1>
</header>
<nav class="main-nav">
	<ul>
		<li><a href="/index.php">Accueil</a></li>
		<li><a href="/gallery.php">Galerie</a></li>
		<?php 
		if ( !isset($_SESSION['logged_on_user']) ) {
			echo "<li><a href='/register-page.php'>Connexion</a></li>";
		} else {
			echo "<li><a href='/photo-booth.php'>Photo Booth</a></li>";
			echo "<li><a href='/my-account.php'>Mon compte</a></li>";
			echo "<li><a href='/logout.php'>Déconnexion</a></li>";
		}
		?>
	</ul>
</nav>