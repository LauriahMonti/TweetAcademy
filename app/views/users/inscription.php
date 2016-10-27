<form method="post" action = "#">
    <div class="form-group">
        <label>Votre nom de compte: </label>
        <input type="text" name = "nickname" placeholder = "Votre nom de compte" value="<?php echo (!empty($_POST['nickname']) ? $_POST['nickname'] : ''); ?>" required="required"/>
        <?php if (!empty($_SESSION['errors']['nickname'])) { ?>
            <p class="danger"><?php echo $_SESSION['errors']['nickname']; ?></p>
        <?php } ?>
    </div>
    <div class="form-group">
        <label for ="log_birthdate">Votre date de naissance : </label>
        <input type="date" name = "birthdate" value="<?php echo (!empty($_POST['birthdate']) ? $_POST['birthdate'] : ''); ?>"/>
        <?php if (!empty($_SESSION['errors']['birthdate'])) { ?>
            <p class="danger"><?php echo $_SESSION['errors']['birthdate']; ?></p>
        <?php } ?>
    </div>
    <div class="form-group">
        <label>Choisissez votre login</label>
        <input type= "text" name = "username" placeholder = "Choisissez votre login" value="<?php echo (!empty($_POST['username']) ? $_POST['username'] : ''); ?>" required="required"/>
        <?php if (!empty($_SESSION['errors']['username'])) { ?>
            <p class="danger"><?php echo $_SESSION['errors']['username']; ?></p>
        <?php } ?>
    </div>
    <div class="form-group">
        <label>Votre numero de telephone</label>
        <input type= "text" name = "phone" placeholder="Votre numero de telephone" value="<?php echo (!empty($_POST['phone']) ? $_POST['phone'] : ''); ?>" required="required"/>
        <?php if (!empty($_SESSION['errors']['phone'])) { ?>
            <p class="danger"><?php echo $_SESSION['errors']['phone']; ?></p>
        <?php } ?>
    </div>
    <div class="form-group">
        <label>Votre adresse</label>
        <input type = "text" name = "location" placeholder = "Votre adresse" value="<?php echo (!empty($_POST['location']) ? $_POST['location'] : ''); ?>" required="required"/>
        <?php if (!empty($_SESSION['errors']['location'])) { ?>
            <p class="danger"><?php echo $_SESSION['errors']['location']; ?></p>
        <?php } ?>
    </div>
    <div class="form-group">
        <label>Votre Email</label>
        <input type = "email" name = "email" placeholder = "Votre Email" value="<?php echo (!empty($_POST['email']) ? $_POST['email'] : ''); ?>" required="required"/>
        <?php if (!empty($_SESSION['errors']['email'])) { ?>
            <p class="danger"><?php echo $_SESSION['errors']['email']; ?></p>
        <?php } ?>
    </div>
    <div class="form-group">
        <label>Confirmer votre Email</label>
        <input type = "email" name = "validateMail" placeholder = "Confirmer votre Email" value="<?php echo (!empty($_POST['validateMail']) ? $_POST['validateMail'] : ''); ?>" required="required" />
        <?php if (!empty($_SESSION['errors']['validateMail'])) { ?>
            <p class="danger"><?php echo $_SESSION['errors']['validateMail']; ?></p>
        <?php } ?>
    </div>
    <div class="form-group">
        <label>Votre mot de passe</label>
        <input type = "password" name = "password" placeholder = "Votre mot de passe" required="required"/>
        <?php if (!empty($_SESSION['errors']['password'])) { ?>
            <p class="danger"><?php echo $_SESSION['errors']['password']; ?></p>
        <?php } ?>
    </div>
    <div class="form-group">
        <label>Confirmer votre mot de passe</label>
        <input type = "password" name = "passwordConfirm" placeholder = "Confirmer votre mot de passe" required="required" />
        <?php if (!empty($_SESSION['errors']['passwordConfirm'])) { ?>
            <p class="danger"><?php echo $_SESSION['errors']['passwordConfirm']; ?></p>
        <?php } ?>
    </div>
    <div class="form-group">
        <input type = "submit" class="btn-success" value = "S'inscrire" />
    </div>
</form>