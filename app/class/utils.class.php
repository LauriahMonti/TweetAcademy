<?php

	class UtilsClass	{

		public static function generator ($length = 8) {
		    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		    $pass = [];
		    $alphaLength = strlen($alphabet) - 1;
		    for ($i = 0; $i < $length; $i++) {
		        $n = rand(0, $alphaLength);
		        $pass[] = $alphabet[$n];
		    }
		    return implode($pass);
		}

		public static function hash ($pwd) {
			$salt = "si tu aimes la wac tape dans tes mains";
			return hash("ripemd160", $salt . $pwd . $salt);
		}

		public static  function sendMail($destinataire, $message) {
			$expediteur = 'contact@twittawac.com';
			$objet = 'TwittaWac : Actication du compte';
			$headers  = 'MIME-Version: 1.0' . "\n";
			$headers .= 'Content-type: text/html; charset=ISO-8859-1'."\n";
			$headers .= 'Reply-To: '.$expediteur."\n";
			$headers .= 'From: "TwittaWac"<'.$expediteur.'>'."\n";
			$headers .= 'Delivered-to: '.$destinataire."\n";
			if (mail($destinataire, $objet, $message, $headers)) {
			    return true;
			} else {
			    return false;
			}
		}

	    public static function uploadImage($file, $dir, $name, $size = [64, 64], $formats = [IMAGETYPE_PNG, IMAGETYPE_JPEG]) {
	        if (!empty($file) && !empty($dir) && !empty($name) && !empty($size)) {
	            $tmp_file = $file['tmp_name'];
	            if (!is_uploaded_file($tmp_file)) {
	                return "Fichier introuvable.";
	            }
	            $infosImg = getimagesize($file['tmp_name']);
	            if (($infosImg[0] !== $size[0]) || ($infosImg[1] !== $size[1])) {
	            	return "L'image n'est pas a la bonne taille.";
	            }
	            $type_file = exif_imagetype($file['tmp_name']);
	            if (!in_array($type_file, $formats)) {
	                return "Le fichier n'a pas un format d'image valide.";
	            }
	            if (!move_uploaded_file($tmp_file, $dir . '/' . $name . image_type_to_extension($type_file))) {
	                return "impossible d'uploader l'image.";
	            } else {
	            	return ['file' => $name . image_type_to_extension($type_file)];
	            }
	        } else {
	            return "Information incorrect.";
	        }
	    }
	}