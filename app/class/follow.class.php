<?php
    class Follow
    {
        private $follower;
        private $followed;
        private $date_follow;
        private $bdd;

        public function __construct($follower, $followed)
        {
            $this->follower = $follower;
            $this->followed = $followed;
            $this->date_follow = date('Y-m-d');
            $this->bdd = BddClass::bdd();
        }

        public function getFollower()
        {
            return $this->follower;
        }

        public function getFollowed()
        {
            return $this->followed;
        }

        public function getDate_follow()
        {
            return $this->date_follow;
        }

        static function checkFollow($follower, $followed)
        {
            $bdd = BddClass::bdd();
            $sql = "SELECT count(*) FROM followers WHERE id_user = :followed AND id_follower = :follower";
            $query = $bdd->prepare($sql);
            $query->bindParam(':followed', $followed);
            $query->bindParam(':follower', $follower);
            $query->execute();

            if ($query->fetchColumn() > 0)
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        public function follow($follower, $followed)
        {
            if (Follow::checkFollow($follower, $followed) === false)
            {
                $sql = "INSERT INTO followers
                                    (date_follow,
                                    id_follower,
                                    id_user)
                        VALUES (:date_follow,
                                :id_follower,
                                :id_user)";
                $query = $this->bdd->prepare($sql);
                $query->bindParam(':date_follow', $this->date_follow);
                $query->bindParam(':id_follower', $follower);
                $query->bindParam(':id_user', $followed);
                $query->execute();
            }
            elseif (Follow::checkFollow($follower, $followed) === true)
            {
                $sql = "DELETE FROM followers WHERE id_user = :followed AND id_follower = :follower";
                $query = $this->bdd->prepare($sql);
                $query->bindParam(':follower', $follower);
                $query->bindParam(':followed', $followed);
                $query->execute();
            }
        }

        static function displayFollowing($id_user)
        {
            $bdd = BddClass::bdd();
            $sql = "SELECT avatar, users.username, users.nickname FROM users INNER JOIN followers ON users.id_user = followers.id_follower WHERE followers.id_user = :id_user ";
            $query = $bdd->prepare($sql);
            $query->bindParam(':id_user', $id_user);
            $query->execute();
            $result = $query->fetchAll();

            return $result;
        }

        static function displayFollowers($id_user)
        {
            $bdd = BddClass::bdd();
            $sql =  "SELECT avatar, users.username, users.nickname FROM users INNER JOIN followers ON users.id_user = followers.id_user WHERE followers.id_follower = :id_user ";
            $query = $bdd->prepare($sql);
            $query->bindParam(':id_user', $id_user);
            $query->execute();
            $result = $query->fetchAll();

            return $result;
        }
    }
?>