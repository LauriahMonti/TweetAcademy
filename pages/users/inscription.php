<?php
    session_start();
    // Config
    define('ROOT', dirname(dirname(dirname(__FILE__))));
    define('URL', dirname(dirname(dirname($_SERVER['SCRIPT_NAME']))));

    include(ROOT . '/app/class/loader.php');

    // Rediction si connecter ou pas
    UsersClass::isAuth();

    ob_start();
    // Init
    $user = new UsersClass();
    $user->newUser();

    // Contenu de la page
    require_once (ROOT . "/app/views/users/inscription.php");
    unset($_SESSION['errors']);
    $content = ob_get_contents();
    ob_end_clean();

    // Theme
    require_once(ROOT . "/app/includes/theme.php");