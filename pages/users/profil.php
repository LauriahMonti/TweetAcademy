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
    if (empty($_GET['username'])) {
        $login = $_SESSION['auth']['id_user'];
    } else {
        $login = $_GET['username'];
    }
    $user = new UsersClass($login);

    $theme = new ThemeClass($user->getId_user());
    $themeBgColor = $theme->getBg_color();

    if (!empty($_GET['follow']) && $_GET['follow'] == true)
    {
        $follow = new Follow($user->getId_user(), $_SESSION['auth']['id_user']);
        $follow->follow($follow->getFollower(), $follow->getFollowed());
    }

    // Contenu de la page
    require_once (ROOT . "/app/views/users/profil.php");
    $content = ob_get_contents();
    ob_end_clean();

    // Theme
    require_once(ROOT . "/app/includes/theme.php");