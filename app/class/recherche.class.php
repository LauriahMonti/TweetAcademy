<?php

	class RechercheClass {

		private $tb = [];
		private $bdd;
		private $get;

		public function __construct () {
			$this->bdd = BddClass::bdd();
		}

		public function recherche() {
			if (!empty($_GET['r'])) {
				$this->get = $_GET['r'];
				$this->explodeGet();
				$r = [];

				if (!empty($this->tb['tags']) AND empty($this->tb['users']) AND empty($this->tb['words'])) {
					$r['tags'] = $this->getByTags();
					return $r;
				}
				else if (empty($this->tb['tags']) AND !empty($this->tb['users']) AND empty($this->tb['words'])) {
					$r['users'] = $this->getByUsers();
					return $r;
				}
			}
			else if (!empty($_GET['hashtag'])) {
				$r = [];
				$this->get = '#' . $_GET['hashtag'];
				$this->explodeGet();
				$r['tags'] = $this->getByTags();
				return $r;
			}
		}

		private function explodeGet () {
			$string = explode(' ', $this->get);
			$tb = [];

			foreach ($string as $key => $value) {
				if (substr ($value, 0, 1) === "#") {
					if (strlen($value) > 2) {
						$tb['tags'][] = substr ($value, 1);
					}
				} else if (substr ($value, 0, 1) === "@") {
					if (strlen($value) > 2) {
						$tb['users'][] = substr ($value, 1);
					}
				} else if (strlen($value) > 2) {
					$tb['words'] = $value;
				}
			}
			$this->tb = $tb;
		}

		public function getByTags () {

			$ids = [];

			foreach ($this->tb['tags'] as $key => $value) {
				$a = TagsClass::listTweet($value);
				if (!empty($a)) {
					$ids = array_merge($a, $ids);
				}
			}

			if (!empty($ids)) {
				$ids = array_unique($ids);

				$sql = "SELECT * FROM tweets LEFT JOIN users ON users.id_user = tweets.id_user WHERE";

				foreach ($ids as $key => $value) {
					if ($key !== 0) $sql .= " OR";
					$sql .= " id_tweet = " . $value;
				}
				$query = $this->bdd->prepare($sql);
				$query->execute();

				return $query->fetchAll(PDO::FETCH_ASSOC);
			} else {
				return $ids;
			}
		}

		public function getByUsers () {
			$sql = "SELECT * FROM users WHERE actif = :activated AND ";
			foreach ($this->tb['users'] as $key => $value) {
				if ($key !== 0) $sql .= " OR";
				$sql .= " user_login LIKE :login" . $key;
			}
			$sql .= " GROUP BY id_user";
			$query = $this->bdd->prepare($sql);
			foreach ($this->tb['users'] as $key => $value) {
				$r = '%'.$value.'%';
				$query->bindParam(':login'.$key, $r);
			}
			$activated = 1;
			$query->bindParam(':activated', $activated);
			$query->execute();

			return $query->fetchAll(PDO::FETCH_ASSOC);
		}
	}