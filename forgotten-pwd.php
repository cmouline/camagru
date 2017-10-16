<?php
include('head.php');
include('header.php');
?>
<main class="register">
	<p>Entrez votre adresse email pour recevoir un lien vous permettant de réinitialiser votre mot de passe</p>
	<section class="register-form-section">
		<form method="post" action="reset-pwd.php">
			<span id="email-icon" class="email"></span><input type="text" name="email" placeholder="Email" required />
			<input id="register-validate" class="validate" type="submit" name="submit" value="Réinitialiser" />
		</form>
	</section>
</main>
<script type="text/javascript" src="js/password.js"></script>
<?php
include('footer.php');
include('foot.php');
?>