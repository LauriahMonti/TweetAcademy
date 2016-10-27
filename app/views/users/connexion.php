<form method="post" action ="#">
	<div class="form-group">
		<label>Login</label>
		<input type = "text" name="login" placeholder="Votre Login" value="<?php echo (!empty($_POST['login']) ? $_POST['login'] : ''); ?>" required="required"/>
		<?php if (!empty($_SESSION['errors']['login'])) { ?>
			<p class="danger"><?php echo $_SESSION['errors']['login']; ?></p>
		<?php } ?>
    </div>
	<div class="form-group">
		<label>Mot de passe</label>
		<input type ="password" name="password" placeholder="Votre mot de passe" required="required"/>
		<?php if (!empty($_SESSION['errors']['password'])) { ?>
			<p class="danger"><?php echo $_SESSION['errors']['password']; ?></p>
		<?php } ?>
	</div>
	<div class="form-group">
		<input type= "submit" class="btn-success" value = "Connexion" />
    </div>
</form>