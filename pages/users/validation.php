<?php
    session_start();
    // Config
    define('ROOT', dirname(dirname(dirname(__FILE__))));
    define('URL', dirname(dirname(dirname($_SERVER['SCRIPT_NAME']))));

    include(ROOT . '/app/class/loader.php');

    UsersClass::isAuth();

    ob_start();
    // Init
    $user = new UsersClass();
    $user->validateAccount();

    // Contenu de la page
    require_once (ROOT . "/app/views/users/validation.php");
    $content = ob_get_contents();
    unset($_SESSION['errors']);
    ob_end_clean();

    // Theme
    require_once(ROOT . "/app/includes/theme.php");