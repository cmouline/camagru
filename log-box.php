<div class="log-box">
	<?php
		if ( !isset($_SESSION['logged_on_user']) ) { ?>
		<form class="log-form" method="post" action="login.php">
			<input type="text" name="login" placeholder="Identifiant"/>
			<input type="text" name="password" placeholder="Mot de passe"/>
			<input type="submit" name="submit" value="Se connecter" />
		</form>
		<a href="register-page.php">S'enregistrer</a>
	<?php
		} else { ?>
		<form method="post" action="logout.php">
			<input type="submit" name="submit" value="Se déconnecter" />
		</form>
	<?php
		}
	?>
</div>