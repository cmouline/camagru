<?php
include('functions.php');

$connexion = connectDB();

$query = "DELETE FROM `post` WHERE `id` = " .  $_GET['id'] . "";
requestDB($connexion, $query, false);

$query = "DELETE FROM `likes` WHERE `id_post` = " .  $_GET['id'] . "";
requestDB($connexion, $query, false);
