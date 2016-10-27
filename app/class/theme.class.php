<?php

	class ThemeClass	{

		private $id_user;
		private $bg_img;
		private $bg_color;
		private $theme_color;
		private $postion;
		private $cover;

		public function getBg_img(){
			return $this->bg_img;
		}

		public function setBg_img($bg_img){
			$this->bg_img = $bg_img;
		}

		public function getBg_color(){
			return $this->bg_color;
		}

		public function setBg_color($bg_color){
			$this->bg_color = $bg_color;
		}

		public function getTheme_color(){
			return $this->theme_color;
		}

		public function setTheme_color($theme_color){
			$this->theme_color = $theme_color;
		}

		public function getPostion(){
			return $this->postion;
		}

		public function setPostion($postion){
			$this->postion = $postion;
		}

		public function __construct($id_user = null) {
            if($id_user != null) {
            	$this->id_user = $id_user;
            	$this->bdd = BddClass::bdd();
                $sql = "SELECT * FROM themes WHERE id_user = :id_user";
                $query = $this->bdd->prepare($sql);
                $query->bindParam(':id_user', $id_user);
                $query->execute();

                $result = $query->fetch();

                $this->bg_img = $result['bg_img'];
                $this->bg_color = $result['bg_color'];
                $this->theme_color = $result['theme_color'];
                $this->postion = $result['postion'];
            }
        }

		public static function create ($id_user) {
			$bg_color = "#2980b9";
			$bg_img = "";
			$theme_color = "";
			$postion = "";
			$bdd = BddClass::bdd();

			$sql = "INSERT INTO themes
			(id_user,
			bg_img,
			bg_color,
			theme_color,
			postion)
			VALUES
			(:id_user,
			:bg_img,
			:bg_color,
			:theme_color,
			:postion)";
			$query = $bdd->prepare($sql);
			$query->bindParam(':id_user', $id_user);
			$query->bindParam(':bg_img', $bg_img);
			$query->bindParam(':bg_color', $bg_color);
			$query->bindParam(':theme_color', $theme_color);
			$query->bindParam(':postion', $postion);
			$query->execute();
		}

		public function checkUpdate () {
			if (!empty($_POST['theme'])) {
				if (empty($_POST['theme']['color'])) {
					$_SESSION['errors']['color'] = "Couleur oublier.";
				}
				else {
					$this->bg_color = $_POST['theme']['color'];
				}
				$this->update();
			} else if (!empty($_FILES['cover'])) {
            if (empty($_FILES['cover'])) {
                $_SESSION['errors']['cover']['cover'] = "Veuillez indiquer ou ce trouve votre image.";
            } else {
                $token = UtilsClass::generator();
                $error = UtilsClass::uploadImage($_FILES['cover'], ROOT . "/upload/covers", $token, [1184, 200]);
                if (!isset($error)) {
                    $_SESSION['errors']['avatar']['cover'] = $error;
                } else {
                    $this->cover = "upload/covers/" . $error['file'];
                    $this->update();
                    $_SESSION['errors']['avatar']['flash'] = "cover modifier";
                }
            }
        }
		}

		public function update () {

			if (empty($_SESSION['errors']) && !empty($_FILES['cover'])) {
				echo "oui";
				$sql = "UPDATE users SET cover = :cover WHERE id_user = :id_user";
		        $query = $this->bdd->prepare($sql);
				$query->bindParam(':cover', $this->cover);
				$query->bindParam(':id_user', $this->id_user);
		        $query->execute();
			}
			else if (empty($_SESSION['errors']) && !empty($_POST['theme'])) {
				$sql = "UPDATE themes SET bg_img = :bg_img,
		        bg_color = :bg_color,
		        theme_color = :theme_color,
		        postion = :postion WHERE id_user = :id_user";
		        $query = $this->bdd->prepare($sql);
				$query->bindParam(':id_user', $this->id_user);
				$query->bindParam(':bg_img', $this->bg_img);
				$query->bindParam(':bg_color', $this->bg_color);
				$query->bindParam(':theme_color', $this->theme_color);
				$query->bindParam(':postion', $this->postion);
		        $query->execute();
			} else {
				echo "test";
			}
		}
	}