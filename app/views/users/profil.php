<div class="cover">
    <div class="image" style="background-image: url('<?php echo URL . '/' . $user->getCover();?>')"></div>
</div>

<div id="profil-bar">
    <div class="me">
        <?php if ($user->getId_user() === $_SESSION['auth']['id_user']) { ?>
            <a href="editProfil.php" class='btn btn-warning'><i class="fa fa-pencil"></i> Editer profil</a>
            <a href="editTheme.php" class = 'btn btn-success'><i class="fa fa-cog"></i> Editer theme</a>
            <a href="followers.php" class="btn btn-info"><i class="fa fa-users"></i> Follows</a>
        <?php } ?>
    </div>
    <div class="other">
        <?php if ($user->getId_user() !== $_SESSION['auth']['id_user'] && Follow::checkFollow($user->getId_user(), $_SESSION['auth']['id_user']) === false) { 
            ?>
            <a href="profil.php?follow=true&amp;username=<?php echo $user->getUsername();?>" class = 'btn btn-info'><i class="fa fa-user-plus"></i> Suivre</a>
        <?php }
            else if ($user->getId_user() !== $_SESSION['auth']['id_user']) {
                 ?>
            <a href="profil.php?follow=true&amp;username=<?php echo $user->getUsername();?>" class = 'btn btn-info'><i class="fa fa-user-plus"></i> Ne plus suivre</a>
            <?php } ?>
    </div>
</div>

<div id="profil">
    <div id="user">
        <div class='avatar' style="background-image: url('<?php echo URL . '/' . $user->getAvatar();?>')"></div>
            <h3>
                <?php echo $user->getNickname(); ?>
            </h3>
            <span>
                <?php echo '@'.$user->getUsername(); ?>
            </span>
            <span>
                <i class="fa fa-envelope-o"></i> <?php echo $user->getEmail() ?>
            </span>
            <span>
                <i class="fa fa-mobile"></i> <?php echo $user->getPhone() ?>
            </span>
            <?php if (!empty($user->getWebsite())) { ?>
                <span>
                    <i class="fa fa-globe"></i> <?php echo $user->getWebsite(); ?>
                </span>
            <?php } ?>
        </div>
        <div class="timeline">
            <div class="page-title">
                <h3>Tweets</h3>
            </div>
                <?php
                foreach (Tweet::profilTweet($user->getNickname()) as $key => $value) {
                    ?>
                        <div class='tweets'>
                            <p class='userLink'><a href="<?php echo URL . '/pages/users/profil.php?username=' . $value['username']; ?>"><?php echo $value['nickname']; ?> <small><?php echo "@".$value['username']?></small></a></p>
                            <p class='tweetContent'><?php echo TagsClass::replaceTags($value['content'])?></p>
                            <span class='tweetDate'><?php echo $value['creation_date']?></span>
                        </div>
                    <?php
                }
            ?>
        </div>
    </div>