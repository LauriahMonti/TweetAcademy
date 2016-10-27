<?php if (empty("Config oublier !")) {
    die("Erreur 500");
} ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>TwittaWac</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>/assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>/assets/css/reset.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>/assets/css/style.css">
</head>
<body>
    <div id="wrap">
        <header>
            <div class="content">
                <div class="title">
                    <a href="<?php echo URL; ?>">
                        <div id="logo"></div>
                        <h1>TwittaWac</h1>
                    </a>
                </div>
                <div class="menu">
                    <?php if (empty($_SESSION['auth'])) { ?>
                        <a type="button" class="btn btn-success" href="<?php echo URL; ?>/pages/users/connexion.php">Connexion</a>
                        <a type="button" class="btn btn-warning" href="<?php echo URL; ?>/pages/users/inscription.php">Inscripion</a>
                    <?php } else { ?>
                        <div id="recherche">
                          <form action="<?php echo URL; ?>/recherche.php" method="GET">
                            <input type="text" name="r" required="required" value="<?php echo (!empty($_GET['r'])) ? $_GET['r'] : ''; ?>" />
                            <button type="submit" class="btn btn-success" title="Recherche" ><i class="fa fa-search"></i></button>
                          </form>
                        </div>
                        <a href="<?php echo URL ; ?>/pages/users/profil.php" title="Mon profil" class="btn btn-info"><i class="fa fa-user"></i></a>
                        <a href="<?php echo URL ; ?>/pages/users/deconnexion.php?disconnect=1" title="Deconnexion" class="btn btn-danger"><i class="fa fa-sign-out"></i></a>
                    <?php } ?>
                </div>
            </div>
        </header>
        <div id="page" style="<?php echo (!empty($themeBgColor)) ? 'background-color: '. $themeBgColor : ''; ?>">
            <div class="content">
                <?php if(!empty($content)) {
                    echo $content;
                }?>
            </div>
        </div>
        <footer>
            <p>Made by SAMSUNG CAMPUS | &copy; vilard_s - bensam_v - monti_l</p>
        </footer>
    </div>
</body>
</html>
