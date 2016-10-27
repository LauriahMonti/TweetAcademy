<div id="avatar">
	<div class="page-title">
		<h3>Avatar</h3>
	</div>

	<?php if (!empty($_SESSION['errors']['avatar']['flash'])) { ?>
		<div class="flash">
			<p class="success"><?php echo $_SESSION['errors']['avatar']['flash']; ?></p>
		</div>
	<?php } ?>

	<form action="#avatar" method="POST" enctype="multipart/form-data">
		<div class="form-group">
			<div class="avatar" style="background-image: url(<?php echo URL . "/".$user->getAvatar(); ?>);"></div>
	        <label>Changer: Type : jpeg ou png et de taille 172px x 183px</label>
		    <input name="avatar" type="file" required="required"/>
		   	<?php if (!empty($_SESSION['errors']['avatar']['avatar'])) { ?>
	            <p class="danger"><?php echo $_SESSION['errors']['avatar']['avatar']; ?></p>
	        <?php } ?>
		</div>
		<div class="form-group">
			<input type="submit" value="Envoyer" class="btn-success" />
		</div>
	</form>
</div>

<div id="personal">
	<div class="page-title">
		<h3>Mes informations</h3>
	</div>
		<?php if (!empty($_SESSION['errors']['personal']['flash'])) { ?>
		<div class="flash">
			<p class="success"><?php echo $_SESSION['errors']['personal']['flash']; ?></p>
		</div>
	<?php } ?>
	<form action="#personal" method="POST">
		<div class="form-group">
	        <label>Votre nom de compte :</label>
			<input name="personal[nickname]" type="text" placeholder="Votre nom de compte" value="<?php echo (!empty($_POST['personal']['nickname']) ? $_POST['personal']['nickname'] : $user->getNickname()); ?>" required="required"/>
	        <?php if (!empty($_SESSION['errors']['personal']['nickname'])) { ?>
	            <p class="danger"><?php echo $_SESSION['errors']['personal']['nickname']; ?></p>
	        <?php } ?>
		</div>
		<div class="form-group">
			<label>Birthdate :</label>
			<input name="personal[birthdate]" type="date" value="<?php echo (!empty($_POST['personal']['birthdate']) ? $_POST['personal']['birthdate'] : $user->getBirthdate()); ?>" required="required" />
	        <?php if (!empty($_SESSION['errors']['personal']['birthdate'])) { ?>
	            <p class="danger"><?php echo $_SESSION['errors']['personal']['birthdate']; ?></p>
	        <?php } ?>
		</div>
		<div class="form-group">
			<label for="location">Adresse :</label>
			<input name="personal[location]" type="text" placeholder="Votre adresse" value="<?php echo (!empty($_POST['personal']['location']) ? $_POST['personal']['location'] : $user->getLocation()); ?>" required="required" />
	        <?php if (!empty($_SESSION['errors']['personal']['location'])) { ?>
	            <p class="danger"><?php echo $_SESSION['errors']['personal']['location']; ?></p>
	        <?php } ?>
		</div>
		<div class="form-group">
			<label>Website :</label>
			<input name="personal[website]" type="text" placeholder="http://" value="<?php echo (!empty($_POST['personal']['website']) ? $_POST['personal']['website'] : $user->getWebsite()); ?>" />
	        <?php if (!empty($_SESSION['errors']['personal']['website'])) { ?>
	            <p class="danger"><?php echo $_SESSION['errors']['personal']['website']; ?></p>
	        <?php } ?>
		</div>
		<div class="form-group">
			<label>Biography :</label>
			<textarea name="personal[biography]"><?php echo (!empty($_POST['personal']['biography']) ? $_POST['personal']['biography'] : $user->getBiography()); ?></textarea>
	        <?php if (!empty($_SESSION['errors']['personal']['biography'])) { ?>
	            <p class="danger"><?php echo $_SESSION['errors']['personal']['biography']; ?></p>
	        <?php } ?>
		</div>
		<div class="form-group">
			<input type="submit" value="Envoyer" class="btn-success" />
		</div>
	</form>
</div>

<div id="pwd">

	<div class="page-title">
		<h3>Changement de mot de passe</h3>
	</div>

	<?php if (!empty($_SESSION['errors']['pwd']['flash'])) { ?>
		<div class="flash">
			<p class="success"><?php echo $_SESSION['errors']['pwd']['flash']; ?></p>
		</div>
	<?php } ?>

	<form action="#pwd" method="POST">
		<div class="form-group">
			<label>Mot de passe actuel :</label>
			<input name="pwd[currentPassword]" type="password" placeholder="Password" required="required"/>
	        <?php if (!empty($_SESSION['errors']['pwd']['currentPassword'])) { ?>
	            <p class="danger"><?php echo $_SESSION['errors']['pwd']['currentPassword']; ?></p>
	        <?php } ?>
		</div>
		<div class="form-group">
			<label>Password: </label>
			<input name="pwd[password]" type="password" placeholder="Password" required="required"/>
	        <?php if (!empty($_SESSION['errors']['pwd']['password'])) { ?>
	            <p class="danger"><?php echo $_SESSION['errors']['pwd']['password']; ?></p>
	        <?php } ?>
		</div>
		<div class="form-group">
			<label>Confirm password : </label>
			<input name="pwd[passwordConfirm]" type="password" placeholder="Confirm password" required="required"/>
	        <?php if (!empty($_SESSION['errors']['pwd']['passwordConfirm'])) { ?>
	            <p class="danger"><?php echo $_SESSION['errors']['pwd']['passwordConfirm']; ?></p>
	        <?php } ?>
		</div>
		<div class="form-group">
			<input type="submit" value="Envoyer" class="btn-danger" />
		</div>
	</form>

</div>

<div id="email">

	<div class="page-title">
		<h3>Changement d'email</h3>
	</div>

	<?php if (!empty($_SESSION['errors']['email']['flash'])) { ?>
		<div class="flash">
			<p class="success"><?php echo $_SESSION['errors']['email']['flash']; ?></p>
		</div>
	<?php } ?>

	<form action="#email" method="POST">
		<div class="form-group">
			<label>Email :</label>
			<input name="email[email]" type="email" placeholder="<?php echo $user->getEmail(); ?>" value="<?php echo (!empty($_POST['email']['email']) ? $_POST['email']['email'] : ''); ?>" required="required"/>
	        <?php if (!empty($_SESSION['errors']['email']['email'])) { ?>
	            <p class="danger"><?php echo $_SESSION['errors']['email']['email']; ?></p>
	        <?php } ?>
		</div>
		<div class="form-group">
			<label>Confirmation d'Email : </label>
			<input name="email[validateMail]" type="email" placeholder="<?php echo $user->getEmail(); ?>" value="<?php echo (!empty($_POST['email']['validateMail']) ? $_POST['email']['validateMail'] : ''); ?>" required="required"/>
	        <?php if (!empty($_SESSION['errors']['email']['validateMail'])) { ?>
	            <p class="danger"><?php echo $_SESSION['errors']['email']['validateMail']; ?></p>
	        <?php } ?>
		</div>
		<div class="form-group">
			<label>Mot de passe actuel :</label>
			<input name="email[password]" type="password" placeholder="*****" required="required"/>
	        <?php if (!empty($_SESSION['errors']['email']['password'])) { ?>
	            <p class="danger"><?php echo $_SESSION['errors']['email']['password']; ?></p>
	        <?php } ?>
		</div>
		<div class="form-group">
			<input type="submit" value="Envoyer" class="btn-warning" />
		</div>
	</form>
</div>