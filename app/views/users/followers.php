<div class="cover">
    <div class="image" style="background-image: url('<?php echo URL . '/' . $user->getCover();?>')"></div>
</div>

<div id="profil-bar">
    <div class="me">
        <?php if ($user->getId_user() === $_SESSION['auth']['id_user']) { ?>
            <a href="editProfil.php" type="button" class='btn btn-warning'><i class="fa fa-pencil"></i> Editer profil</a>
            <a href="editTheme.php" type= "button" class = 'btn btn-success'><i class="fa fa-cog"></i> Editer theme</a>
        <?php } ?>
    </div>
</div>
<div id='followers-list'>
    <div id="followers">
        <ul>
        <li>Personnes qui vous suivent :</li>
        <?php
            $result = Follow::displayFollowers($_SESSION['auth']['id_user']);
            foreach ($result as $key => $value)
            {
                ?>
                   <li><img class="mini_avatar" src="<?php echo URL."/".$value['avatar']?>"><a href="profil.php?username=<?php echo $value['username']?>"><?php echo $value['username']; ?></a></li>
                <?php
            }
        ?>
        </ul>
    </div>
    <div id="following">
        <ul>
        <li>Personnes suivies :</li>
        <?php
            $result = Follow::displayFollowing($_SESSION['auth']['id_user']);
            foreach ($result as $key => $value)
            {
                ?>
                    <li><img class="mini_avatar" src="<?php echo URL."/".$value['avatar']?>"><a href="profil.php?username=<?php echo $value['username']?>"><?php echo $value['username']; ?></a></li>
                <?php
            }
        ?>
        </ul>
    </div>
</div>