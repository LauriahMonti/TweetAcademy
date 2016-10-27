<?php
    session_start();
    // Config
    define('ROOT', dirname(dirname(dirname(__FILE__))));
    define('URL', dirname(dirname(dirname($_SERVER['SCRIPT_NAME']))));

    include(ROOT . '/app/class/loader.php');

    // Rediction si connecter ou pas
    UsersClass::isAcces();

    ob_start();
    // Init
    $user = new UsersClass();
    $user->disconnectUser();

    header('location:'. URL .'/index.php');
?>