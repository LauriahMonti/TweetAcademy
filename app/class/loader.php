<?php

	require_once("bdd.class.save");
	// Initialisation de la bdd
    BddClass::int();

    if (!empty(BddClass::error())) {
    	die("Connexion a la bdd impossible");
    }

	require_once("utils.class.php");
	require_once("users.class.php");
	require_once("tags.class.php");
    require_once("tweet.class.php");
    require_once("recherche.class.php");
    require_once("theme.class.php");
    require_once("follow.class.php");