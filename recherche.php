<?php

	session_start();
	// Config
    define('ROOT', dirname(__FILE__));
    define('URL', dirname($_SERVER['SCRIPT_NAME']));

	require_once(ROOT . "/app/class/loader.php");
	// Contenu de la page
	ob_start();
	$recherche = new RechercheClass();
	$resulat = $recherche->recherche();

	require_once (ROOT . "/app/views/recherche.php");
	$content = ob_get_contents();
	ob_end_clean ();

	require_once(ROOT . "/app/includes/theme.php");