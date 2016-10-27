<?php
    session_start();
    include('../class/user.class.php');
    $currentUser->deleteUser();
    header('location: ../../index.php');
?>