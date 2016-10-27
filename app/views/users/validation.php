<?php if (!empty($_SESSION['errors']['error'])) { ?>
	<div class="flash">
		<p class="danger"><?php echo $_SESSION['errors']['error']; ?></p>
	</div>
<?php } ?>

<?php if (!empty($_SESSION['errors']['flash'])) { ?>
	<div class="flash">
		<p class="success"><?php echo $_SESSION['errors']['flash']; ?></p>
	</div>
<?php } ?>

<form method="get" action ="#">
	<div class="form-group">
		<label>Email</label>
		<input type = "email" name="email" placeholder="Email" value="<?php echo (!empty($_GET['email']) ? $_GET['email'] : ''); ?>" required="required"/>
		<?php if (!empty($_SESSION['errors']['email'])) { ?>
			<p class="danger"><?php echo $_SESSION['errors']['email']; ?></p>
		<?php } ?>
    </div>
	<div class="form-group">
		<label>Token</label>
		<input type ="text" name="token" placeholder="Token"value="<?php echo (!empty($_GET['token']) ? $_GET['token'] : ''); ?>" required="required"/>
		<?php if (!empty($_SESSION['errors']['token'])) { ?>
			<p class="danger"><?php echo $_SESSION['errors']['token']; ?></p>
		<?php } ?>
	</div>
	<div class="form-group">
		<input type= "submit" class="btn-success" value = "Envoyer" />
    </div>
</form>