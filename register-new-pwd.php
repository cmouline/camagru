<?PHP
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
include('functions.php');

$connexion = connectDB();

$query = "SELECT * FROM `user` WHERE `login` LIKE '" . $_POST["login"] . "';";
$users = requestDB($connexion, $query, "fetch");

$query = "UPDATE `camagru`.`user` SET `password` = '" . hash("whirlpool", $_POST["password"]) . "' WHERE `login` LIKE '" . $_POST['login'] . "';";
$return = requestDB($connexion, $query, "fetch");

if ( $return !== false ) {
	
	header('Location: http://camagru/my-account.php');

} else {

	var_dump('error');

}

?>