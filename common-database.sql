-- phpMyAdmin SQL Dump
-- version 4.2.12deb2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Dim 14 Février 2016 à 23:29
-- Version du serveur :  5.6.25-0ubuntu0.15.04.1
-- Version de PHP :  5.6.4-4ubuntu6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `common-database`
--

-- --------------------------------------------------------

--
-- Structure de la table `followers`
--

CREATE TABLE IF NOT EXISTS `followers` (
  `id_user` int(11) NOT NULL COMMENT 'ID de l''utilisateur',
  `id_follower` int(11) NOT NULL COMMENT 'ID de follower',
  `date_follow` datetime NOT NULL COMMENT 'Date et heure du follow'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `followers`
--

INSERT INTO `followers` (`id_user`, `id_follower`, `date_follow`) VALUES
(30, 35, '2016-02-14 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `hashtags`
--

CREATE TABLE IF NOT EXISTS `hashtags` (
  `id_tweet` int(11) NOT NULL COMMENT 'Id du tweeter',
  `id_tag` int(11) NOT NULL COMMENT 'tag'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `hashtags`
--

INSERT INTO `hashtags` (`id_tweet`, `id_tag`) VALUES
(6, 1),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(13, 2),
(14, 2),
(15, 3),
(16, 2),
(17, 2),
(18, 2),
(19, 2),
(20, 2),
(21, 2),
(22, 2),
(23, 2),
(24, 2),
(25, 2),
(26, 4),
(27, 4),
(28, 4),
(29, 4),
(30, 4),
(31, 4),
(32, 4),
(33, 4),
(34, 4),
(35, 4),
(36, 4),
(37, 4),
(38, 4),
(52, 5),
(53, 1),
(54, 6),
(57, 7),
(57, 8),
(59, 9),
(60, 10),
(61, 11);

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

CREATE TABLE IF NOT EXISTS `likes` (
  `id_user` int(11) NOT NULL COMMENT 'Id de l''utilisateur qui like',
  `id_tweet` int(11) NOT NULL COMMENT 'id du tweet qui like'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
`id_mess` int(11) NOT NULL COMMENT 'Id du message',
  `id_sender` int(11) NOT NULL COMMENT 'Id de l''émetteur',
  `id_receiver` int(11) NOT NULL COMMENT 'id du destinataire',
  `content` text NOT NULL COMMENT 'contenue',
  `date` datetime NOT NULL COMMENT 'date',
  `sender_deleted` tinyint(1) NOT NULL COMMENT 'Si le sender delete le msg',
  `receiver_deleted` tinyint(1) NOT NULL COMMENT 'si le destinataire delete le message',
  `read` tinyint(1) NOT NULL COMMENT 'Si le message est lu par le destinataire'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
`id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL COMMENT 'ID utilisateur',
  `type` int(11) NOT NULL COMMENT 'type de la notif',
  `id_notif` int(11) NOT NULL COMMENT 'id du tweet retweet ou like en fonction du type de la notif',
  `status` tinyint(1) NOT NULL COMMENT 'si vue ou non',
  `date_notif` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `short_links`
--

CREATE TABLE IF NOT EXISTS `short_links` (
  `token` varchar(255) NOT NULL COMMENT 'Lien raccourcis',
  `path` text NOT NULL COMMENT 'Chemin du fichier'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
`id_tag` int(11) NOT NULL COMMENT 'Id du tag',
  `tag` text NOT NULL COMMENT 'nom du hastag'
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `tags`
--

INSERT INTO `tags` (`id_tag`, `tag`) VALUES
(1, 'mabite'),
(2, 'holidays'),
(3, 'boulet'),
(4, 'debilus'),
(5, 'tweeter'),
(6, 'baston'),
(7, 'team'),
(8, 'samsung'),
(9, 'TIG'),
(10, 'Fayot'),
(11, 'doubleTIG');

-- --------------------------------------------------------

--
-- Structure de la table `themes`
--

CREATE TABLE IF NOT EXISTS `themes` (
  `id_user` int(11) NOT NULL COMMENT 'ID de l''utilisateur',
  `bg_img` text NOT NULL COMMENT 'Image de background',
  `bg_color` varchar(255) NOT NULL COMMENT 'couleur de background',
  `theme_color` varchar(255) NOT NULL COMMENT 'Couleur du theme',
  `postion` varchar(255) NOT NULL COMMENT 'Position du background'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `themes`
--

INSERT INTO `themes` (`id_user`, `bg_img`, `bg_color`, `theme_color`, `postion`) VALUES
(33, '', '#2980b9', '', ''),
(34, '', '#2980b9', '', ''),
(35, '', '#2980b9', '', ''),
(36, '', '#2980b9', '', ''),
(37, '', '#2980b9', '', ''),
(38, '', '#2980b9', '', ''),
(39, '', '#2980b9', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `tweets`
--

CREATE TABLE IF NOT EXISTS `tweets` (
`id_tweet` int(11) NOT NULL COMMENT 'id du tweet',
  `id_user` int(11) NOT NULL COMMENT 'id de l''utilisateur',
  `content` text NOT NULL COMMENT 'contenue',
  `creation_date` datetime NOT NULL COMMENT 'Date de création',
  `media` text NOT NULL COMMENT 'Media',
  `deleted` tinyint(1) NOT NULL COMMENT 'Statut de la suppression',
  `is_origin` int(11) NOT NULL COMMENT 'Parent(Si définis retweet)',
  `is_reply` tinyint(1) NOT NULL COMMENT 'Si definis alors c''est un réponse',
  `location` text NOT NULL COMMENT 'Localisation'
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `tweets`
--

INSERT INTO `tweets` (`id_tweet`, `id_user`, `content`, `creation_date`, `media`, `deleted`, `is_origin`, `is_reply`, `location`) VALUES
(1, 30, 'Voici un super tweet de test !', '2016-02-12 00:00:00', '', 0, 0, 0, ''),
(6, 30, 'Ceci est un superbe tweet de test ! #mabite', '2016-02-12 00:00:00', '', 0, 0, 0, ''),
(15, 30, 'oki doki #boulet @samuel', '2016-02-12 00:00:00', '', 0, 0, 0, ''),
(25, 30, '@valentin est en vacances #holidays', '2016-02-12 00:00:00', '', 0, 0, 0, ''),
(38, 30, 'oki doki c''est kiki mon parti ! #debilus', '2016-02-12 00:00:00', '', 0, 0, 0, ''),
(54, 36, 'Du sang de la chic et du molard ! #baston ', '2016-02-14 00:00:00', '', 0, 0, 0, ''),
(56, 36, 'Et si on mettais quelques TIG @pangolin2 ?', '2016-02-14 00:00:00', '', 0, 0, 0, ''),
(57, 36, 'Allez une belle TIG pour valentin pour avoir décider de refaire le projet de zero avec @samuel et @laura !#team #samsung', '2016-02-14 00:00:00', '', 0, 0, 0, ''),
(58, 37, 'Sa me parait une bonne idée @pangolin ! Des idées farfelues ?', '2016-02-14 00:00:00', '', 0, 0, 0, ''),
(59, 37, 'Intense réfléxion ... #TIG', '2016-02-14 00:00:00', '', 0, 0, 0, ''),
(60, 38, 'Oh non pas de TIG je suis un élève model ! #Fayot', '2016-02-14 00:00:00', '', 0, 0, 0, ''),
(61, 36, '@samuel On ne négocie pas devant la suprémacie d''un pangolin !!! #doubleTIG', '2016-02-14 00:00:00', '', 0, 0, 0, '');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id_user` int(11) NOT NULL COMMENT 'ID utilisateur',
  `username` varchar(255) NOT NULL COMMENT 'nom de l''utilsateur',
  `nickname` varchar(255) NOT NULL COMMENT 'Pseudo de la personne(Nom complet sur tweeter)',
  `password` text NOT NULL COMMENT 'Mot de passe',
  `avatar` text NOT NULL COMMENT 'avatar',
  `email` text NOT NULL COMMENT 'email',
  `cover` text NOT NULL COMMENT 'image de banniere',
  `phone` text NOT NULL COMMENT 'numéro de téléphone',
  `website` text NOT NULL COMMENT 'url du site web lié au compte',
  `registration_token` text NOT NULL COMMENT 'token pour l''activation par mail',
  `birthdate` date NOT NULL COMMENT 'date de naissance',
  `private` tinyint(1) NOT NULL COMMENT 'status du compte si privée ou non',
  `token_cookie` text NOT NULL COMMENT 'token pour la fonction : se souvenir de moi (afin d''éviter la reconnexion)',
  `location` text NOT NULL COMMENT 'Lieu',
  `activated` tinyint(1) NOT NULL COMMENT 'statut de l''activation',
  `biography` text NOT NULL COMMENT 'Biographie',
  `creation_date` date NOT NULL COMMENT 'Date et heure de la création du compte'
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id_user`, `username`, `nickname`, `password`, `avatar`, `email`, `cover`, `phone`, `website`, `registration_token`, `birthdate`, `private`, `token_cookie`, `location`, `activated`, `biography`, `creation_date`) VALUES
(30, 'valentin', 'valentin', '87dee4f04c69590a58db504d9ab565f105003779', 'assets/images/avatar_by_default.png', 'bensam_v@epitech.eu', 'assets/images/avatar_by_default.png', '0782456325', '', '44caba73ad2647b2d6da773277822b75adb0f0bb', '0000-00-00', 0, '', '28 avenue jean jaures', 1, '', '2016-02-03'),
(36, 'pangolin', 'pangolin', 'e1084c1fd680ecae1c7c088dcad8683608f8d686', 'assets/images/avatar_by_default.png', 'dasilv_b@epitech.eu', 'assets/images/cover_by_default.png', '0123456789', 'https://campus.samsung.fr/', '8WUgFJUOOk', '1994-05-22', 0, '', '14 rue fructidor', 1, 'Un super pangolin qui s''ennui en soutenance de my tweeter ! Un passif difficile maltrait&eacute; par quelques pixels pendant sa jeunesse, il &agrave; su les ma&icirc;triser au fil du temps pour en faire de fid&egrave;les amis !', '2016-02-14'),
(37, 'pangolin2', 'pangolin2', 'e1084c1fd680ecae1c7c088dcad8683608f8d686', 'assets/images/avatar_by_default.png', 'primo_j@epitech.eu', 'assets/images/cover_by_default.png', '0123456789', '', 'VIwtnMo76y', '1994-05-22', 0, '', '14 rue fructidor', 1, '', '2016-02-14'),
(38, 'samuel', 'samuel', 'ec101fe7c54424dbf9976329225895c1839b42d5', 'assets/images/avatar_by_default.png', 'vilard_s@epitech.eu', 'assets/images/cover_by_default.png', '0123456789', '', '6PpWVTCMIo', '1995-04-22', 0, '', '14 rue fructidor', 1, '', '2016-02-14'),
(39, 'laura', 'laura', 'ec101fe7c54424dbf9976329225895c1839b42d5', 'assets/images/avatar_by_default.png', 'monti_l@epitech.eu', 'assets/images/cover_by_default.png', '0123456789', '', 'M74k8djsTm', '1995-04-22', 0, '', '14 rue fructidor', 1, '', '2016-02-14');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `followers`
--
ALTER TABLE `followers`
 ADD PRIMARY KEY (`id_user`,`id_follower`);

--
-- Index pour la table `hashtags`
--
ALTER TABLE `hashtags`
 ADD PRIMARY KEY (`id_tweet`,`id_tag`);

--
-- Index pour la table `likes`
--
ALTER TABLE `likes`
 ADD PRIMARY KEY (`id_user`,`id_tweet`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
 ADD PRIMARY KEY (`id_mess`);

--
-- Index pour la table `notifications`
--
ALTER TABLE `notifications`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `short_links`
--
ALTER TABLE `short_links`
 ADD PRIMARY KEY (`token`);

--
-- Index pour la table `tags`
--
ALTER TABLE `tags`
 ADD PRIMARY KEY (`id_tag`);

--
-- Index pour la table `themes`
--
ALTER TABLE `themes`
 ADD PRIMARY KEY (`id_user`);

--
-- Index pour la table `tweets`
--
ALTER TABLE `tweets`
 ADD PRIMARY KEY (`id_tweet`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
MODIFY `id_mess` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id du message';
--
-- AUTO_INCREMENT pour la table `notifications`
--
ALTER TABLE `notifications`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `tags`
--
ALTER TABLE `tags`
MODIFY `id_tag` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id du tag',AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `tweets`
--
ALTER TABLE `tweets`
MODIFY `id_tweet` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id du tweet',AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID utilisateur',AUTO_INCREMENT=40;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
