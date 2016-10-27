<?php

class UsersClass {

    private $avatar = "assets/images/avatar_by_default.png";
    private $cover = "assets/images/cover_by_default.png";
    private $biography;
    private $birthdate;
    private $email;
    private $id_user;
    private $nickname;
    private $location;
    private $password;
    private $creation_date;
    private $registration_token;
    private $activated;
    private $phone;
    private $token_cookie;
    private $username;
    private $website;
    private $bdd;

    public function __construct ($id_user = null) {
        $this->bdd = BddClass::bdd();

        if (!empty($id_user)) {
            $sql = "SELECT * FROM users WHERE id_user = :login OR username = :login";
            $query = $this->bdd->prepare($sql);
            $query->bindParam(':login', $id_user, PDO::PARAM_INT);
            $query->execute();
            $result = $query->fetch();

            if (!empty($result)) {
                $this->avatar = $result['avatar'];
                $this->cover = $result['cover'];
                $this->biography = $result['biography'];
                $this->birthdate = $result['birthdate'];
                $this->email = $result['email'];
                $this->id_user = $result['id_user'];
                $this->location = $result['location'];
                $this->password = $result['password'];
                $this->creation_date = $result['creation_date'];
                $this->registration_token = $result['registration_token'];
                $this->activated = $result['activated'];
                $this->phone = $result['phone'];
                $this->token_cookie = $result['token_cookie'];
                $this->username = $result['username'];
                $this->website = $result['website'];
                $this->nickname = $result['nickname'];
            }
        }
    }

    // Getters / Setters
    public function getAvatar () {
        return $this->avatar;
    }

    public function setAvatar ($avatar) {
        $this->avatar = $avatar;
    }

    public function getCover (){
        return $this->cover;
    }

    public function setCover ($cover) {
        $this->cover = $cover;
    }

    public function getBiography () {
        return $this->biography;
    }

    public function setBiography ($biography) {
        $this->biography = $biography;
    }

    public function getBirthdate () {
        return $this->birthdate;
    }

    public function setBirthdate ($birthdate) {
        $this->birthdate = $birthdate;
    }

    public function getEmail () {
        return $this->email;
    }

    public function setEmail ($email) {
        $this->email = $email;
    }

    public function getFollowers () {
        return $this->followers;
    }

    public function setFollowers ($followers) {
        $this->followers = $followers;
    }

    public function getFollows () {
        return $this->follows;
    }

    public function setFollows ($follows) {
        $this->follows = $follows;
    }

    public function getId_user () {
        return $this->id_user;
    }

    public function setId_user ($id_user) {
        $this->id_user = $id_user;
    }

    public function getNickname () {
        return $this->nickname;
    }

    public function setNickname ($nickname) {
        $this->nickname = $nickname;
    }

    public function getLocation () {
        return $this->location;
    }

    public function setLocation ($location) {
        $this->location = $location;
    }

    public function getPassword () {
        return $this->password;
    }

    public function setPassword ($password) {
        $this->password = $password;
    }

    public function getCreation_date () {
        return $this->creation_date;
    }

    public function setCreation_date ($creation_date) {
        $this->creation_date = $creation_date;
    }

    public function getRegistration_token () {
        return $this->registration_token;
    }

    public function setRegistration_token ($registration_token) {
        $this->registration_token = $registration_token;
    }

    public function getActivated () {
        return $this->activated;
    }

    public function setActivated ($activated) {
        $this->activated = $activated;
    }

    public function getPhone () {
        return $this->phone;
    }

    public function setPhone ($phone) {
        $this->phone = $phone;
    }

    public function getToken_cookie () {
        return $this->token_cookie;
    }

    public function setToken_cookie ($token_cookie) {
        $this->token_cookie = $token_cookie;
    }

    public function getUsername () {
        return $this->username;
    }

    public function setUsername ($username) {
        $this->username = $username;
    }

    public function getWebsite () {
        return $this->website;
    }

    public function setWebsite ($website) {
        $this->website = $website;
    }

    //Verification du mail à l'inscription
    static function checkMail ($mail) {
        // securisation du mail
        $mail = htmlentities ($mail);

        $bdd = BddClass::bdd();
        $sql = "SELECT count(*) FROM users WHERE :email = email";
        $query = $bdd->prepare($sql);
        $query->bindParam(':email', $mail);
        $query->execute();

        if ($query->fetchColumn() > 0) {
            return true;
        } else {
            return false;
        }
    }

    //Verification du login à l'inscription
    static function checkLogin ($login, $activated = false) {
        // Securisation du login
        $login = htmlentities($login);

        $bdd = BddClass::bdd();
        $sql = "SELECT activated FROM users WHERE :login = username OR :mail = email";
        $query = $bdd->prepare($sql);
        $query->bindParam(':login', $login);
        $query->bindParam(':mail', $login);
        $query->execute();

        $r = $query->fetch();

        if ($activated) {
            if ($r && $r['activated'] === '1') {
                return true;
            } else {
                return false;
            }
        }
        else if ($r) {
            return true;
        }
        else {
            return false;
        }
    }

    //Verification du Mot de pass à la connexion
    private function checkPassword ($password, $login) {
        $login = htmlentities($login);
        $password = htmlentities($password);
        $password = UtilsClass::hash($password);

        $sql = "SELECT password FROM users WHERE :login = username OR :mail = email";
        $query = $this->bdd->prepare($sql);
        $query->bindParam(':login', $login);
        $query->bindParam(':mail', $login);
        $query->execute();
        $result = $query->fetch();

        if (!empty($result) && $result['password'] === $password) {
            return true;
        } else {
            return false;
        }
    }

    /*
        Inscription de l'utilisateur
    */

    // Verification des champs du formulaire
    private function checkSignIn () {

        if (!empty($_POST)) {
            if (!isset($_POST['nickname']) || empty($_POST['nickname'])) {
                $_SESSION['errors']['nickname'] = "Veuillez remplir le champ 'nickname' pour finaliser votre inscription.";
            }
            else {
                $this->nickname = htmlentities($_POST['nickname']);
            }

            if (!isset($_POST['birthdate']) || empty($_POST['birthdate'])) {
                $_SESSION['errors']['birthdate'] = "Veuillez indiquez votre dâte de naissance pour finaliser votre inscription.";
            }
            else {
                $this->birthdate = htmlentities($_POST['birthdate']);
            }

            if (!isset($_POST['email']) || empty($_POST['email'])) {
                $_SESSION['errors']['email'] = "Veuillez indiquez une adresse e-mail pour finaliser votre inscription.";
            }
            else if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
                $_SESSION['errors']['validateMail'] = "Veuillez indiquez une adresse e-mail au format e-mail tel que : 'exemple@exemple.com' pour finaliser votre inscription.";
            }
            else if ($this->checkMail($_POST['email'])) {
                $_SESSION['errors']['email'] = "L'adresse e-mail indiquée est déjà utilisé par un autre utilisateur. Veuillez en choisir une autre pour finaliser votre inscription.";
            }
            else if (empty($_POST['validateMail'])) {
                $_SESSION['errors']['validateMail'] = "Veuillez indiquez votre adresse e-mail une seconde fois pour finaliser votre inscription.";
            }
            else if ($_POST['email'] !== $_POST['validateMail']) {
                $_SESSION['errors']['validateMail'] = "Veuillez indiquez deux adresse e-mail identiques pour finaliser votre inscription.";
            }
            else {
                $this->email = htmlentities($_POST['email']);
            }

            if (empty($_POST['location'])) {
                $_SESSION['errors']['location'] = "Veuillez indiquez votre adresse pour finaliser l'inscription.";
            } else {
                $this->location = htmlentities($_POST['location']);
            }

            if (empty($_POST['phone'])) {
                $_SESSION['errors']['phone'] = "Veuillez indiquez votre numero de phone pour finaliser l'inscription.";
            }
            else {
                $this->phone = htmlentities($_POST['phone']);
            }

            if (empty($_POST['password'])) {
                $_SESSION['errors']['password'] = "Veuillez indiquez un mot de passe pour finaliser votre inscription";
            }
            else if (strlen($_POST['password']) < 8) {
                $_SESSION['errors']['password'] = "Votre mot de passe doit contenir au minimum 8 caractères pour finaliser votre inscription.";
            }
            else if (empty($_POST['passwordConfirm'])) {
                $_SESSION['errors']['passwordConfirm'] = "Veuillez indiquez un mot de passe pour finaliser votre inscription";
            }
            else if ($_POST['password'] != $_POST['passwordConfirm']) {
                $_SESSION['errors']['password'] = "Veuillez indiquez deux mots de passes identiques pour finaliser votre inscription.";
            }
            else {
                $this->password = UtilsClass::hash($_POST['password']);
            }

            if (empty($_POST['username'])) {
                $_SESSION['errors']['username'] = "Veuillez remplir le champs login pour poursuivre votre inscription";
            }
            else if (UsersClass::checkLogin($_POST['username'])) {
                $_SESSION['errors']['username'] = "Le login indiqué est déjà utilisé par un autre utilisateur. Veuillez en choisir un autre pour finaliser votre inscription.";
            }
            else {
                $this->username = htmlentities($_POST['username']);
            }
        }
    }

    // Ajout de l'utilisateur dans la BDD
    public function newUser () {
        if (!empty($_POST)) {
            $this->checkSignIn();

            if (empty($_SESSION['errors'])) {
                $date = date('Y-m-d');
                $bytes = openssl_random_pseudo_bytes(20);
                $this->registration_token = UtilsClass::generator(10);
                $sql = "INSERT INTO users (avatar,
                cover,
                birthdate,
                email,
                nickname,
                location,
                password,
                creation_date,
                registration_token,
                activated,
                phone,
                username)
                VALUES (:avatar,
                :cover,
                :birthdate,
                :email,
                :nickname,
                :location,
                :password,
                :creation_date,
                :registration_token,
                0,
                :phone,
                :username)";
                $query = $this->bdd->prepare($sql);
                $query->bindParam(':avatar', $this->avatar);
                $query->bindParam(':cover', $this->cover);
                $query->bindParam(':birthdate', $this->birthdate);
                $query->bindParam(':email', $this->email);
                $query->bindParam(':nickname', $this->nickname, PDO::PARAM_STR);
                $query->bindParam(':location', $this->location, PDO::PARAM_STR);
                $query->bindParam(':password', $this->password, PDO::PARAM_STR);
                $query->bindParam(':creation_date', $date);
                $query->bindParam(':registration_token', $this->registration_token, PDO::PARAM_STR);
                $query->bindParam(':phone', $this->phone, PDO::PARAM_STR);
                $query->bindParam(':username', $this->username, PDO::PARAM_STR);
                $query->execute();
                $id = $this->bdd->lastInsertId();
                ThemeClass::create($id);

                $message = "<!DOCTYPE html>
                    <html>
                    <head>
                        <title>Mail confirmation TwittaWac</title>
                    </head>
                    <body>
                        <p>Bonjour, voici le lien d'activation pour votre compte TweetaWac : </p>
                        <a href='http://".$_SERVER['HTTP_HOST'].URL."/users/validation.php?token=$this->registration_token&email=".$this->email."'>Activer votre compte</a>
                    </body>
                    </html>";
                UtilsClass::sendMail($this->email, $message);
            }
        }
    }

    /*
        Modification de l'utiliateur
    */

    //Update utilisateur
    private function updateUser () {
        $sql = "UPDATE users SET avatar = :avatar,
        biography = :biography,
        birthdate = :birthdate,
        email = :email,
        nickname = :nickname,
        location = :location,
        password = :password,
        activated = :activated,
        phone = :phone,
        username = :username,
        website = :website WHERE id_user = :id_user";
        $query = $this->bdd->prepare($sql);
        $query->bindParam(':avatar', $this->avatar);
        $query->bindParam(':biography', $this->biography);
        $query->bindParam(':birthdate', $this->birthdate);
        $query->bindParam(':email', $this->email);
        $query->bindParam(':nickname', $this->nickname);
        $query->bindParam(':location', $this->location);
        $query->bindParam(':password', $this->password);
        $query->bindParam(':phone', $this->phone);
        $query->bindParam(':username', $this->username);
        $query->bindParam(':website',$this->website);
        $query->bindParam(':activated',$this->activated);
        $query->bindParam(':id_user',$_SESSION['auth']['id_user']);
        $query->execute();
    }

    public function editUser () {

        if (!empty($_FILES['avatar'])) {
            if (empty($_FILES['avatar'])) {
                $_SESSION['errors']['avatar']['avatar'] = "Veuillez indiquer ou ce trouve votre image.";
            } else {
                $token = UtilsClass::generator();
                $error = UtilsClass::uploadImage($_FILES['avatar'], ROOT . "/upload/avatars", $token, [180, 190]);
                if (!isset($error)) {
                    $_SESSION['errors']['avatar']['avatar'] = $error;
                } else {
                    $_SESSION['errors']['avatar']['flash'] = "avatar modifier";
                    $this->avatar = "upload/avatars/" . $error['file'];
                    $this->updateUser();
                }
            }
        }
        else if (!empty($_POST['personal'])) {
            if (empty($_POST['personal']['nickname'])) {
                $_SESSION['personal']['nickname'] = "Veuillez remplir le champ 'nickname'";
            } else {
                $this->nickname = $_POST['personal']['nickname'];
            }

            if (empty($_POST['personal']['birthdate'])) {
                $_SESSION['personal']['birthdate'] = "Veuillez indiquez votre dâte de naissance pour finaliser votre inscription.";
            } else {
                $this->birthdate = $_POST['personal']['birthdate'];
            }

            if (empty($_POST['personal']['location'])) {
                $_SESSION['personal']['location'] = "Veuillez indiquez votre adresse.";
            } else {
                $this->location = $_POST['personal']['location'];
            }

            if (isset($_POST['personal']['website'])) {
                $this->website = htmlentities($_POST['personal']['website']);
            }

            if (isset($_POST['personal']['biography'])) {
                $this->biography = htmlentities($_POST['personal']['biography']);
            }

            if (empty($_SESSION['errors'])) {
                $_SESSION['errors']['personal']['flash'] = "Informations modifier";
                $this->updateUser();
            }
        } else if (!empty($_POST['pwd'])) {
            if (empty($_POST['pwd']['currentPassword'])) {
                $_SESSION['errors']['pwd']['currentPassword'] = "Veuillez indiquez votre mot de passe.";
            }
            else if (UtilsClass::hash($_POST['pwd']['currentPassword']) !== $this->password) {
                $_SESSION['errors']['pwd']['currentPassword'] = "Veuillez indiquez votre mot de passe correctement.";
            }
            else if (empty($_POST['pwd']['password'])) {
                $_SESSION['errors']['pwd']['password'] = "Veuillez indiquez votre nouveau mot de passe.";
            }
            else if (strlen($_POST['pwd']['password']) < 8) {
                $_SESSION['errors']['pwd']['password'] = "Votre nouveau mot de passe doit contenir au minimum 8 caractères.";
            }
            else if (empty($_POST['pwd']['passwordConfirm'])) {
                $_SESSION['errors']['pwd']['passwordConfirm'] = "Veuillez confirmer votre nouveau mot de passe.";
            }
            else if ($_POST['pwd']['password'] !== $_POST['pwd']['passwordConfirm']) {
                $_SESSION['errors']['pwd']['password'] = "Veuillez indiquez les deux mots de passes identiques.";
            }
            else {
                $_SESSION['errors']['pwd']['flash'] = "Mot de passe modifier correctement.";
                $this->password = UtilsClass::hash($_POST['pwd']['password']);
                $this->updateUser();
                unset($_POST['pwd']);
            }
        }
        else if (!empty($_POST['email'])) {
            if (empty($_POST['email']['email'])) {
                $_SESSION['errors']['email']['email'] = "Veuillez indiquez une adresse e-mail.";
            }
            else if ($_POST['email']['email'] === $this->email) {
                $_SESSION['errors']['email']['email'] = "Veuillez indiquez une autre adresse e-mail";
            }
            else if (filter_var($_POST['email']['email'], FILTER_VALIDATE_EMAIL) === false) {
                $_SESSION['errors']['email']['email'] = "Veuillez indiquez une adresse e-mail au format e-mail tel que : 'exemple@exemple.com'";
            }
            else if ($this->checkMail($_POST['email']['email'])) {
                $_SESSION['errors']['email']['email'] = "L'adresse e-mail indiquée est déjà utilisé par un autre utilisateur. Veuillez en choisir une autre.";
            }
            else if (empty($_POST['email']['validateMail'])) {
                $_SESSION['errors']['validateMail'] = "Veuillez indiquez votre adresse e-mail une seconde foi.";
            }
            else if ($_POST['email']['email'] !== $_POST['email']['validateMail']) {
                $_SESSION['errors']['email']['validateMail'] = "Veuillez indiquez deux adresse e-mail identiques.";
            }
            else if (empty($_POST['email']['password'])) {
                $_SESSION['errors']['email']['password'] = "Veuillez indiquez votre mot de passe.";
            }
            else if (UtilsClass::hash($_POST['email']['password']) !== $this->password) {
                $_SESSION['errors']['email']['password'] = "Veuillez indiquez votre mot de passe correctement.";
            }
            else {
                $_SESSION['errors']['email']['flash'] = "Email modifier correctement.";
                $this->email = htmlentities($_POST['email']['email']);
                $this->updateUser();
                unset($_POST['email']);
            }
        }
    }

    //Validation du compte par mail
    public function validateAccount () {

        if (empty($_GET['token'])) {
            $_SESSION['errors']['token'] = "Token oublier.";
        }
        if (empty($_GET['email'])) {
            $_SESSION['errors']['email'] = "Email oublier.";
        }

        if (empty($_SESSION['errors'])) {
            $sql = "SELECT count(*) FROM users WHERE registration_token = :tok AND activated = 0";
            $query = $this->bdd->prepare($sql);
            $query->bindParam(':tok', $_GET['token']);
            $query->execute();
            $result = $query->fetchColumn();

            if ($result > 0) {
                $activated = 1;
                $sql = "UPDATE users SET activated = :activated WHERE registration_token = :registration_token AND email = :email";
                $query = $this->bdd->prepare($sql);
                $query->bindParam(':registration_token', $_GET['token']);
                $query->bindParam(':email', $_GET['email']);
                $query->bindParam(':activated', $activated);
                $query->execute();
                $_SESSION['errors']['flash'] = "compte activer.";
            } else {
                $_SESSION['errors']['error'] = "Une erreur est survenue lors de la validation de votre compte, votre compte est soit déjà activé, soit le token de validation est incorrect.";
            }
        }
    }

    /*
        Ajout du check dans le checkLogs
        On verifi si $_POST exist
    */
    //Connexion utilisateur
    public function connectUser () {

        if (!empty($_POST)) {
            // Suppresion du isset et mis du 2eme if en else if
            if (empty($_POST['login'])) {
                $_SESSION['errors']['login'] = "Veuillez indiquez votre login ou votre adresse mail pour vous connecter.";
            } else if (UsersClass::checkLogin($_POST['login'], true) === false) {
                $_SESSION['errors']['login'] = "Le login ou l'adresse e-mail indiqué n'existe pas. Il se peut aussi qu'il n'est pas encore activé.";
            } else if (empty($_POST['password'])) {
                $_SESSION['errors']['password'] = "Veuillez indiquez votre mot de passe pour vous connecter.";
            } else if ($this->checkPassword($_POST['password'], $_POST['login']) === false) {
                $_SESSION['errors']['password'] = "Le mot de passe indiqué est éronné, veuillez entrer le bon mot de passe pour vous connecter.";
            } else {
                $login = htmlentities($_POST['login']);
                $sql = "SELECT * FROM users WHERE :login = username OR :login = email AND activated = 1";
                $query = $this->bdd->prepare($sql);
                $query->bindParam(':login', $_POST['login']);
                $query->execute();
                $result = $query->fetch();

                $_SESSION['auth']['id_user'] = $result['id_user'];
                header('Location: ' . URL . '/pages/users/profil.php');
            }
        }
    }

    //Deconnexion utilisateur
    public function disconnectUser () {
        unset($_SESSION['auth']);
        unset($_SESSION['errors']);
        header('Location: ' . URL . '/');
    }

    //Suppression utilisateur
    public function deleteUser ($id) {
        if (empty($_SESSION['errors'])) {
            $sql = "UPDATE users SET activated = 2 WHERE id_user = :id";
            $query = $this->bdd->prepare($sql);
            $query->bindParam(':id', $id, PDO::PARAM_INT, 1);
            $query->execute();
        }
    }

    static function isAuth () {
        if (!empty($_SESSION['auth'])) {
            header('Location: ' . URL . '/pages/users/profil.php');
        }
    }

    static function isAcces () {
        if (empty($_SESSION['auth'])) {
            header('Location: ' . URL . '/pages/users/connexion.php');
        }
    }
}