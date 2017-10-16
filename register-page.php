<?php
include('head.php');
include('header.php');
?>
<main class="register">
	<?php 
	if ( isset($_SESSION['access-denied']) ) {
		echo "<p class='access-denied'>Merci de vous connecter avant de pouvoir prendre des selfies !</p>";
		unset($_SESSION['access-denied']);
	}
	if ( isset($_GET['registration']) ) {
		if ( $_GET['registration'] == 'success') {
			echo "<div style=\"text-align:center;\"><span class='success-msg'>Votre inscription a bien été prise en compte !</span></div>";
		} else if ( $_GET['registration'] == 'failure') {
			echo "<div style=\"text-align:center;\"><span class='failure-msg'>Oups une erreur s'est produite lors de votre inscription... Réessayez !</span></div>";
		} else if ( $_GET['registration'] == 'user_already_exists') {
			echo "<div style=\"text-align:center;\"><span class='failure-msg'>Ce nom d'utilisateur existe déjà, merci d'en choisir un autre</span></div>";
		}

	}
	?>
	<section class="register-form-section">
		<form method="post" action="register.php">
			<span id="login-icon" class="user"></span><input id="login" type="text" name="login" placeholder="Identifiant" onkeyup="isLoginValid(this.value)" required/>
			<span id="email-icon" class="email"></span><input id="email" type="text" name="email" placeholder="Email" onkeyup="isEmailValid(this.value)" required/>
			<span id="password-icon" class="unlock"></span><input id="original-password" type="password" name="password" placeholder="Mot de passe" onkeyup="isPwdValid(this.value)" required/>
			<span class="instruction">Votre mot de passe doit contenir au moins 8 caractères dont au moins un chiffre</span>
			<span id="check-password-icon" class="unlock"></span><input id="check-password" type="password" name="check_password" placeholder="Vérification mot de passe" onkeyup="isPwdMatching(this.value)" required/>
			<input id="register-validate" class="validate" type="submit" name="submit" value="S'enregistrer" disabled/>
		</form>
		<form method="post" action="login.php">
			<span class="user"><input type="text" name="login" placeholder="Identifiant"/>
			<span class="lock"><input type="password" name="password" placeholder="Mot de passe"/>
			<input class="validate" type="submit" name="submit" value="Se connecter"  />
		</form>
		<a class="instruction" href="forgotten-pwd.php">Oups! J'ai oublié mon mot de passe...</a>
	</section>
</main>
<script type="text/javascript" src="js/password.js"></script>
<?php
include('footer.php');
include('foot.php');
?>