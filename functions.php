<?php

	function connectDB() {
		include('config/setup.php');
		$connexion = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		return($connexion);
	}

	function requestDB($connexion, $query, $fetch) {
		$request = $connexion->prepare($query);
		$isExecuted = $request->execute();
		if ($fetch == "fetch") {
			return($request->fetch());
		} elseif ($fetch == "fetchAll") {
			return($request->fetchAll());
		}
		return($isExecuted);
	}

?>