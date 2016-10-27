<?php
    session_start();
    // Config
    define('ROOT', dirname(dirname(dirname(__FILE__))));
    define('URL', dirname(dirname(dirname($_SERVER['SCRIPT_NAME']))));

    include(ROOT . '/app/class/loader.php');

    UsersClass::isAcces();

    ob_start();
    // Init
    $user = new UsersClass($_SESSION['auth']['id_user']);
    $theme = new ThemeClass($_SESSION['auth']['id_user']);
    $theme->checkUpdate();
    $themeBgColor = $theme->getBg_color();

    // Contenu de la page
    require_once (ROOT . "/app/views/users/editTheme.php");
    unset($_SESSION['errors']);
    $content = ob_get_contents();
    ob_end_clean();

    require_once(ROOT . "/app/includes/theme.php");
?>
