<?php if (!empty($resulat['users'])) { ?>

<div class="page-title">
	<h2>Recherche d'utilisateurs</h2>
</div>
<?php
	foreach ($resulat['users'] as $key => $value) { ?>
		<div class="block">Username : <a href="<?php echo URL; ?>/pages/users/profil.php?username=<?php echo $value['username']; ?>"><?php echo $value['username']; ?></a></div>
	<?php }
} ?>

<?php if (!empty($resulat['tags'])) { ?>

<div class="page-title">
	<h2>Recherche d'utilisateurs</h2>
</div>
<?php
	foreach ($resulat['tags'] as $key => $value) { ?>
            <div class='tweets'>
                <p class='userLink'><a href="<?php echo URL . '/pages/users/profil.php?username=' . $value['username']; ?>"><?php echo $value['nickname']; ?> <small><?php echo "@".$value['username']?></small></a></p>
                <p class='tweetContent'><?php echo TagsClass::replaceTags($value['content'])?></p>
                <span class='tweetDate'><?php echo $value['creation_date']?></span>
            </div>
	<?php }
} ?>