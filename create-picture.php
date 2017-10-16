<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
include('functions.php');

$connexion = connectDB();

$x = 500;
$y = 375;

$final_img = imagecreatetruecolor($x, $y);

imagealphablending($final_img, true);
imagesavealpha($final_img, true);

if ($_POST['from'] == 'form') {

	$picture = $_SERVER['DOCUMENT_ROOT'] . '/img/' . uniqid( $_SESSION['logged_on_user'] ) . '-' . $_FILES['upload-pic']['name'];
	$return = move_uploaded_file($_FILES['upload-pic']['tmp_name'], $picture);
	$filter = 'img/' . $_POST['filter'] . '.png';

	$image_1 = imagecreatefrompng( $picture );
	$image_2 = imagecreatefrompng( $filter );

	$size = getimagesize($picture);

} else if ($_POST['from'] == 'camera') {

	$base64str = explode(",", $_POST['img']);
	$picture = 'img/' . uniqid( $_SESSION['logged_on_user'] ) .'.png';

	file_put_contents($picture, base64_decode($base64str[1]));

	$image_1 = imagecreatefrompng( $picture );
	$image_2 = imagecreatefrompng( $_POST['filter'] );

	$size = array($x, $y);

}

imagecopyresampled($final_img, $image_1, 0, 0, 0, 0, $x, $y, $size[0], $size[1]);

imagecopy($final_img, $image_2, 0, 0, 0, 0, $x, $y);

$img_path = 'img/'.uniqid( $_SESSION['logged_on_user'] ).'.png';
imagepng($final_img, $img_path);

$query = "INSERT INTO `camagru`.`post` (`id`, `published`, `user`, `picture`, `likes`) VALUES (NULL, CURRENT_TIMESTAMP, '" .  $_SESSION['logged_on_user'] . "', '" . $img_path . "', '0');";
requestDB($connexion, $query, false);

if ($_POST['from'] == 'form') {
	header('Location: ' . $_SERVER['HTTP_REFERER']);
} else if ($_POST['from'] == 'camera') {
	$return = "<figure class=\"last-pic\"><img src=\"" . $img_path . "\"></figure>";
	echo $return;
}
?>