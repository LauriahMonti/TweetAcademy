<?php

	class TagsClass {

		private static $errors = [];

		public static function getErrors () {
			return SELF::$errors;
		}

		public static function isExistHashtags ($tag) {
			$bdd = BddClass::bdd();
			$sql = "SELECT id_tag FROM tags WHERE tag = :tag";
			$req = $bdd->prepare($sql);
			$req->bindParam(':tag', $tag);
			$req->execute();
			$result = $req->fetch(PDO::FETCH_ASSOC);

			if ($result) {
				return intval($result["id_tag"]);
			} else {
				return false;
			}
		}

		public static function createTag ($tag) {
			$isExist = TagsClass::isExistHashtags($tag);

			if (!$isExist) {
				$bdd = BddClass::bdd();
				$sql = "INSERT INTO tags(tag) VALUES (:tag)";
				$req = $bdd->prepare($sql);
				$req->bindParam(':tag', $tag, PDO::PARAM_STR);
				$req->execute();
				$id = $bdd->lastInsertId();
				return $id;
			} else {
				SELF::$errors[] = "Le Tag '" . $tag . "' (id:" . $isExist . ") existe deja !";
				return $isExist;
			}
		}

		public static function createHashtag ($idTag, $idTweet) {
			$bdd = BddClass::bdd();
			$sql = "INSERT INTO hashtags(id_tag, id_tweet) VALUES (:id_tag, :id_tweet)";
			$req = $bdd->prepare($sql);
			$req->bindParam(':id_tag', $idTag, PDO::PARAM_INT);
			$req->bindParam(':id_tweet', $idTweet, PDO::PARAM_INT);
			$req->execute();
		}

		public static function foundHashtags ($string, $idTweet) {
			if (is_string($string)) {
				$list = [];
				preg_match_all("/#([a-zA-Z0-9]{2,})/", $string, $list);
				foreach ($list[1] as $v) {
					$idTag = TagsClass::createTag($v);
					TagsClass::createHashtag($idTag, $idTweet);
				}
			} else {
				SELF::$errors[] =  $string . " n'est pas un string !";
				return false;
			}
		}

		public static function replaceTags ($string) {
			$string = preg_replace("/#([a-zA-Z0-9]{2,})/", '<a href="' . URL . '/recherche.php?hashtag=$1">$0</a>', $string);
			$string = preg_replace("/@([a-zA-Z0-9]{2,})/", '<a href="' . URL . '/pages/users/profil.php?user=$1">$0</a>', $string);
			return $string;
		}

		public static function listTweet ($tag) {
			$isExist = TagsClass::isExistHashtags($tag);
			if ($isExist) {
				$bdd = BddClass::bdd();
				$sql = "SELECT hashtags.id_tweet FROM hashtags INNER JOIN tags ON hashtags.id_tag = tags.id_tag WHERE tag = :tag";
				$req = $bdd->prepare($sql);
				$req->bindParam(':tag', $tag, PDO::PARAM_STR);
				$req->execute();
				$result = $req->fetchAll(PDO::FETCH_ASSOC);

				$r = [];
				foreach ($result as $key => $value) {
					$r[] = $value['id_tweet'];
				}
				return $r;
			} else {
				SELF::$errors[] = "Le Tag '" . $tag . "' (id:" . $isExist . ") n'existe pas !";
				return false;
			}
		}
	}