<?php

	session_start();
	// Config
    define('ROOT', dirname(__FILE__));
    define('URL', dirname($_SERVER['SCRIPT_NAME']));

	require_once(ROOT . "/app/class/loader.php");

	if (!empty($_SESSION['auth'])) {
		$user = new UsersClass($_SESSION['auth']['id_user']);
		$page = 'tweet/accueil.php';
		Tweet::createTweet();
	} else {
		$page = 'accueil.php';
	}

	// Contenu de la page
	ob_start();
	require_once (ROOT . "/app/views/" . $page);
	$content = ob_get_contents();
	ob_end_clean ();

	require_once(ROOT . "/app/includes/theme.php");