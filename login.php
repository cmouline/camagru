<?PHP
session_start();

function auth($login, $passwd)
{
	include('functions.php');

	$connexion = connectDB();

	$query = "SELECT * FROM `user` WHERE `login` LIKE '" . $login . "';";
	$user = requestDB($connexion, $query, "fetch");
	
	$crypt_pwd = hash("whirlpool", $passwd);
	if ($user["password"] == $crypt_pwd) {
		return (true);
	} else {
		return (false);
	}
}

if (auth($_POST["login"], $_POST["password"]) === true) {
	$_SESSION["logged_on_user"] = $_POST["login"];
	header('Location:  /index.php?login=success');
} else {
	header('Location:  /index.php?login=fail');
}

?>