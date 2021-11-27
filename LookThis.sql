-- phpMyAdmin SQL Dump
-- version 5.0.4deb2ubuntu5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : sam. 27 nov. 2021 à 18:00
-- Version du serveur :  8.0.27-0ubuntu0.21.10.1
-- Version de PHP : 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `LookThis`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id` int NOT NULL,
  `categories` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `article` varchar(1500) NOT NULL,
  `state` int NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `disabled_at` datetime DEFAULT NULL,
  `id_user` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `id` int NOT NULL,
  `comment` varchar(300) NOT NULL,
  `state` int NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `disabled_at` datetime DEFAULT NULL,
  `id_user` int NOT NULL,
  `id_article` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id` int NOT NULL,
  `subject` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `message` varchar(300) NOT NULL,
  `state` int NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `disabled_at` datetime DEFAULT NULL,
  `id_user` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id`, `subject`, `message`, `state`, `created_at`, `updated_at`, `disabled_at`, `id_user`) VALUES
(7, 'supprimer mon compte', 'delete', 1, '2021-11-08 18:53:47', '2021-11-08 19:37:22', NULL, 1),
(8, 'soummettre une idée', 'Ya de l\'idée', 1, '2021-11-08 18:56:22', '2021-11-08 19:37:22', NULL, 1),
(9, 'soummettre une idée', 'La réussite est un travail de tous les jours !\r\nqu\'en pensez-vous ?', 0, '2021-11-27 17:35:07', '2021-11-27 17:35:07', NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `pseudo` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(80) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `state` int NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `disabled_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `confirmation_token` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `pseudo`, `email`, `password`, `ip`, `state`, `created_at`, `updated_at`, `disabled_at`, `confirmation_token`) VALUES
(1, 'admin', 'admin@protonmail.com', '$2y$12$EoyekalbThIq0fZcrA9JZeS4J77TCe8ts3h4zOTB2/iI/cB4bEWzi', '127.0.0.1', 1, '2021-11-08 17:22:10', '2021-11-08 17:24:17', NULL, 'B82kXHjxH1t1Cy3mFBmZqJdkySLAgtLsaeHXHwE0whmhlAKSf6WeKuDLoW8E'),
(2, 'sylvie', 'sylvie@protonmail.com', '$2y$12$j1EKEfVxseTN7nDfBCNQI.ujADa65UNMaTdIEGqtTgSugbQ48jByq', '127.0.0.1', 1, '2021-11-09 16:59:11', '2021-11-10 14:52:43', '2021-11-10 14:52:43', 'QVpFu4EqfINq0A0CZg4pzxcsV5yWg1eE4ixvHV4Unm7MNEV8tGz8ZSAfXoAo'),
(3, 'francis', 'francis@protonmail.com', '$2y$12$3GruWORi1yfX0k1LrfIth.s9f3XLqNVLaZvO7SeAW4MTu.NLAXefi', '127.0.0.1', 1, '2021-11-09 17:00:34', '2021-11-09 17:00:34', NULL, 'o80S4pS41nACQAJkTH9CZGWGl8USgTj0VEKW39oPdZ3xQxAeALexWTUVzmC6'),
(4, 'loan', 'loan@protonmail.com', '$2y$12$Gw34Jrs/AdZT0vhI1weUieZRvGqEYQzO3ZTiMfQF1J9JBGjmF2Uby', '127.0.0.1', 0, '2021-11-09 17:01:48', '2021-11-10 14:53:13', '2021-11-10 14:53:13', 'Q0Bb5FQPEdBQdZJ1iqpGvJIcLoPOTNA1xf7f85a5hJjOzyaLwmIavu9rjJhT'),
(5, 'kelean', 'kelean@protonmail.com', '$2y$12$ta1f9f8NSrhoQwHqa.BkjOR1bn43WcV6xo3J50HJL3Jz2GvMxJ9tO', '127.0.0.1', 1, '2021-11-09 17:02:25', '2021-11-09 17:04:40', NULL, 'htlRziR9FsX5shDQ11pnPGgRszltxrcfTKGj5RbhqqeqjwLb16nZPz6HO1B8'),
(6, 'emy', 'emy@protonmail.com', '$2y$12$X/IRZhthsFLZoy8hMsq7MubD06iXF5f6cplMdmnJx7DI4cjEBh73y', '127.0.0.1', 1, '2021-11-09 17:02:59', '2021-11-09 17:02:59', NULL, 'ILw0w3J2XLv1PaWRMydHxbTUM7iJrz0rY40ileBvhKVlI8wcR4YBHyyLAuKb'),
(7, 'lydie', 'lydie@protonmail.com', '$2y$12$wm6WTTGj7fWNxcetEw8ryO9W0CKSsK5RfOtvXkUpUFtDzQrEE8wyG', '127.0.0.1', 0, '2021-11-09 17:03:42', '2021-11-09 19:40:50', NULL, 'gmgfJqtwzrp9AsoAxVClExRvjdmOLspzJjev4RPfZUoGzAC87IwX1vGQpCDo'),
(8, 'kim', 'kim@protonmail.com', '$2y$12$Y5cmRN85DOEIZ4JP4BJ14ueeiHiDK/WH3/FR37Y5Yd012cYAF0s3u', '127.0.0.1', 1, '2021-11-09 17:04:14', '2021-11-09 17:04:14', NULL, 'FoknsCrPeXivWCmA7OqAHwcnOVjmKms0ck7Rbyxq4rOmBwVNmbVwvXS5i3FL');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article_user_FK` (`id_user`);

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comment_user_FK` (`id_user`),
  ADD KEY `comment_article0_FK` (`id_article`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `message_user_FK` (`id_user`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_user_FK` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_article0_FK` FOREIGN KEY (`id_article`) REFERENCES `article` (`id`),
  ADD CONSTRAINT `comment_user_FK` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_user_FK` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
