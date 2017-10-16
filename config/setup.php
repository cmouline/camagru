<?php
include('database.php');

try {
	$new_db = new PDO('mysql:host=localhost', $DB_USER, $DB_PASSWORD);
	
	$create_db = $new_db->prepare("CREATE DATABASE IF NOT EXISTS camagru;");

	$create_db->execute();
} catch (PDOException $exception) {
	echo 'Connection failed : ' . $exception->getMessage();
}

try {
	$connexion = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
} catch (PDOException $exception) {
	echo 'Connection failed : ' . $exception->getMessage();
}

$create_user_table = $connexion->prepare("CREATE TABLE IF NOT EXISTS user (
	id int PRIMARY KEY AUTO_INCREMENT NOT NULL,
	login varchar(255) NOT NULL,
	password varchar(255) NOT NULL,
	email varchar(100) NOT NULL,
	token varchar(1000)
);"
);

$create_user_table->execute();

$create_post_tables = $connexion->prepare("CREATE TABLE IF NOT EXISTS post (
	id int PRIMARY KEY AUTO_INCREMENT NOT NULL,
	published TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	user varchar(255) NOT NULL,
	picture varchar(255) NOT NULL,
	likes int NOT NULL
);"
);

$create_post_tables->execute();

$create_comments_tables = $connexion->prepare("CREATE TABLE IF NOT EXISTS comments (
	id int PRIMARY KEY AUTO_INCREMENT NOT NULL,
	id_post int NOT NULL,
	author varchar(100) NOT NULL,
	comment varchar(1000) NOT NULL
);"
);

$create_comments_tables->execute();

$create_likes_tables = $connexion->prepare("CREATE TABLE IF NOT EXISTS likes (
	id int PRIMARY KEY AUTO_INCREMENT NOT NULL,
	user varchar(255) NOT NULL,
	id_post int NOT NULL
);"
);

$create_likes_tables->execute();
?>