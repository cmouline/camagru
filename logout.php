<?PHP
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
unset($_SESSION["logged_on_user"]);
header('Location:  /index.php');
?>