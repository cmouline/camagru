<?PHP
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

$query = "SELECT * FROM `user` WHERE `login` LIKE '" . $_POST["login"] . "';";
$users = requestDB($connexion, $query, "fetchAll");

$user_exists = false;
foreach ( $users as $user ) {
	if ( $user['login'] == $_POST["login"] ) {
		$user_exists = true;
	}
}

if ( !$user_exists ) {
	$query = "INSERT INTO `camagru`.`user` (`id`, `login`, `password`, `email`, `token`) VALUES (NULL, '" . $_POST["login"] . "', '" . hash("whirlpool", $_POST["password"]) . "', '" . $_POST["email"] . "', NULL);";

	$return = requestDB($connexion, $query, "");

	if ($return === true) {

		$_SESSION['user_already_exists'] = false;

		$message = "Bienvenue sur camagru !<br /><br />Votre inscription a bien été prise en compte. Vous pouvez maintenant commencez à selfiter avec nos supers filtres yeay !<br /><br />A bientôt sur camagru<br /><br />La camateam";

		$headers = 'Content-type: text/html; charset=UTF-8' . "\r\n";

		mail($_POST["email"], 'Votre inscription a bien été prise en compte !', $message, $headers);

		header('Location: http://camagru/register-page.php?registration=success');

	} else {

		header('Location: http://camagru/register-page.php?registration=failure');

	}

} else {

	$_SESSION['user_already_exists'] = true;
	header('Location: http://camagru/register-page.php?registration=user_already_exists');

}

?>