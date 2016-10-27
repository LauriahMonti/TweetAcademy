<form method='post' action='#'>
	<div class="form-group">
	    <label><?php echo "@".$user->getUsername();?> Tweetez ! (140 caractères)</label>
	    <textarea name='tweet'></textarea>
	</div>
	<div class="form-group">
	    <input type='submit' value="envoyer" class="btn-success">
	</div>
</form>
<?php
    foreach (Tweet::displayTweet() as $key => $value) {
        ?>
            <div class='tweets'>
                <p class='userLink'><a href="<?php echo URL . '/pages/users/profil.php?username=' . $value['username']; ?>"><?php echo $value['nickname']; ?> <small><?php echo "@".$value['username']?></small></a></p>
                <p class='tweetContent'><?php echo TagsClass::replaceTags($value['content'])?></p>
                <span class='tweetDate'><?php echo $value['creation_date']?></span>
            </div>
        <?php
    }
?>