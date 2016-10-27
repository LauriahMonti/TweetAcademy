<?php

    class Tweet
    {

        private $content;
        private $creation_date;
        private $deleted;
        private $id_tweet;
        private $id_user;
        private $is_origin;
        private $is_reply;
        private $location;
        private $media;
        private $bdd;

        public function __construct($id_tweet = null)
        {
            $this->bdd = BddClass::bdd();
            if($id_tweet != null)
            {
                $sql = "SELECT * FROM tweets WHERE id_tweet = :id";
                $query = $this->bdd->prepare($sql);
                $query->bindParam(':id', $id_tweet);
                $query->execute();

                $result = $query->fetch();

                $this->content = $result['content'];
                $this->creation_date = $result['creation_date'];
                $this->deleted = $result['deleted'];
                $this->id_tweet = $result['id_tweet'];
                $this->id_user = $result['id_user'];
                $this->is_origin = $result['is_origin'];
                $this->is_reply = $result['is_reply'];
                $this->location = $result['location'];
                $this->media = $result['media'];
            }
        }

        static function createTweet()
        {
            $bdd = BddClass::bdd();
            if (!empty($_POST))
            {
                if (!empty($_POST['tweet']))
                {
                    $content = $_POST['tweet'];
                    $creation_date = date('Y-m-d');

                    if (strlen($_POST['tweet']) <= 140 && !empty($content)) 
                    {
                        $sql = "INSERT INTO tweets
                                (content,
                                creation_date,
                                id_user)
                                VALUES
                                (:content,
                                :creation_date,
                                :id_user)";
                        $query = $bdd->prepare($sql);
                        $query->bindParam(':content', $content);
                        $query->bindParam(':creation_date', $creation_date);
                        $query->bindParam(':id_user', $_SESSION['auth']['id_user']);
                        $query->execute();
                        $id = $bdd->lastInsertId();

                        TagsClass::foundHashtags($content, $id);
                        header('location:'. URL . "/index.php");
                    }
                    else
                    {
                        $_SESSION['errors']['tweet'] = "Votre tweet doit faire au maximum 140 caractères !";
                    }
                }
                else
                {
                    $_SESSION['errors']['tweet'] = "Un tweet vide ? Vraiment ?";
                }
            }
        }

        static function displayTweet()
        {
            $bdd = BddClass::bdd();
            $sql = "SELECT * FROM tweets LEFT JOIN users ON users.id_user = tweets.id_user GROUP BY id_tweet DESC";
            $query = $bdd->prepare($sql);
            $query->execute();
            return $query->fetchAll();
        }

        static function profilTweet($login) {
            $bdd = BddClass::bdd();
            $sql = "SELECT * FROM tweets LEFT JOIN users ON users.id_user = tweets.id_user WHERE nickname = :nickname GROUP BY id_tweet DESC";
            $query = $bdd->prepare($sql);
            $query->bindParam(':nickname', $login);
            $query->execute();
            return $query->fetchAll();
        }
    }
?>