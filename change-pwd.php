<?php
include('head.php');
include('header.php');
?>
<main class="register">
<?php
$connexion = connectDB();

$url_info = explode('-', $_GET['token']);
$timestamp = $url_info[0];

$query = "SELECT * FROM `user` WHERE `token` LIKE '" . $_GET['token'] . "';";
$user = requestDB($connexion, $query, true);

if ( $timestamp > time() && $user !== false ) {
?>
		<p>Choisissez votre nouveau mot de passe</p>
		<section class="register-form-section">
			<form method="post" action="register-new-pwd.php">
				<span class="instruction">Votre mot de passe doit contenir au moins 8 caractères dont au moins un chiffre</span>
				<span id="password-icon" class="unlock"></span><input id="original-password" type="password" name="password" placeholder="Mot de passe" onkeyup="isPwdValid(this.value)" required/>
				<span id="check-password-icon" class="unlock"></span><input id="check-password" type="password" name="check_password" placeholder="Vérification mot de passe" onkeyup="isPwdMatching(this.value)" required/>
				<input type="hidden" name="login" value="<?php echo $user['login'] ?>">
				<input id="register-validate" class="validate" type="submit" name="submit" value="Valider" disabled/>
			</form>
		</section>
	</main>
	<script type="text/javascript" src="js/password.js"></script>
<?php	
} else {
	?>
	<p>Ce lien a expiré ou est invalide. Si vous souhaitez réinitialiser votre mot de passe, faites une nouvelle demande.</p>
	</main>
	<?php
}
?>
<?php
include('footer.php');
include('foot.php');
?>