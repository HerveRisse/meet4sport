-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : jeu. 19 mai 2022 à 17:39
-- Version du serveur : 5.7.34
-- Version de PHP : 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `meet4sport`
--

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `id_comment` int(11) NOT NULL,
  `id_membre` int(11) NOT NULL,
  `id_event` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `text` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id_comment`, `id_membre`, `id_event`, `date`, `text`) VALUES
(2, 2, 1, '2022-04-13 00:00:00', 'premier message membre2 event1'),
(3, 2, 1, '2022-04-13 00:00:00', 'premier message membre2 event1'),
(4, 2, 1, '2022-04-13 00:00:00', 'premier message membre2 event1'),
(5, 5, 1, '2022-04-14 00:00:00', 'test test test'),
(6, 5, 1, '2022-04-14 00:00:00', 'second message membre5 event1'),
(7, 5, 1, '2022-04-14 00:00:00', 'second message membre5 event1'),
(8, 5, 1, '2022-04-15 09:14:30', 'je souhaite participer'),
(9, 7, 1, '2022-04-15 14:03:41', 'ok pas de soucis');

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id_contact` int(11) NOT NULL,
  `id_demandeur` int(11) NOT NULL,
  `id_receveur` int(11) NOT NULL,
  `statut` int(1) NOT NULL,
  `id_bloquer` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id_contact`, `id_demandeur`, `id_receveur`, `statut`, `id_bloquer`) VALUES
(36, 3, 2, 1, NULL),
(41, 4, 2, 1, NULL),
(42, 3, 5, 2, NULL),
(58, 6, 5, 1, NULL),
(61, 7, 5, 2, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `event`
--

CREATE TABLE `event` (
  `id_event` int(11) NOT NULL,
  `id_membre` int(11) NOT NULL,
  `sport` varchar(20) NOT NULL,
  `ville` varchar(40) NOT NULL,
  `adresse` varchar(60) NOT NULL,
  `nom_event` varchar(40) NOT NULL,
  `date` varchar(20) NOT NULL,
  `heure` varchar(10) NOT NULL,
  `duree` varchar(10) NOT NULL,
  `nb_participant` int(2) NOT NULL DEFAULT '0',
  `nb_place` int(2) NOT NULL,
  `texte` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `event`
--

INSERT INTO `event` (`id_event`, `id_membre`, `sport`, `ville`, `adresse`, `nom_event`, `date`, `heure`, `duree`, `nb_participant`, `nb_place`, `texte`) VALUES
(1, 1, 'fitness', 'Paris', 'test', 'test', '', '', '22:22', 0, 22, '22'),
(2, 1, 'fitness', 'Paris', 'test', 'test', '', '', '02:02', 0, 2, '2'),
(3, 1, 'fitness', 'Paris', 'rue de paris', 'match', '2022-04-03', '10:00', '20:00', 0, 10, 'le fun'),
(4, 2, 'badminton', 'Lyon', 'rue du bad', 'bad lyon', '2022-04-14', '10:42', '16:42', 0, 3, 'amener vos raquettes'),
(5, 5, 'basketball', 'Lyon', 'rue du panier', 'concours de dunk', '2022-04-14', '07:13', '21:12', 0, 22, 'le fun');

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE `membre` (
  `id_membre` int(11) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `pseudo` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `mdp` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`id_membre`, `prenom`, `nom`, `pseudo`, `email`, `mdp`) VALUES
(1, 'test', 'test', 'test', 'test@test', 'test'),
(2, 'bob', 'bob', 'bob', 'bob@bob', '$2y$10$IAiT5tG3hQLsU49cOsxA.O9wePWVEmfA0LK/dwtfDjcQE5Mf1P4xy'),
(3, 'jack', 'jack', 'jack', 'jack@jack', '$2y$10$v2CHWeRwm4TLvcR8lkY.lOmqjWigSI6RPrUAZalw7VSLOIgO5eOzW'),
(4, 'paul', 'paulo', 'marcopolo', 'paulo@paul', '$2y$10$No3nGi.GogQ6CQPR8ORi7.21ACx6ZmjJr5YoBbgHCfBKqYSceKUs2'),
(5, 'joe', 'joe', 'joe', 'joe@joe', '$2y$10$D9T8EmYGz/Ld7wyA54snBOMeeXIMmqTZO3Azm2eDGJ76D6r0rRZZK'),
(6, 'park', 'park', 'park', 'park@park', '$2y$10$JvZ5Bti/sdJ.dxP27xejwerzEHLS8yyOc15gGMkEC2WmaPI28BrX6'),
(7, 'leo', 'leo', 'leo', 'leo@leo', '$2y$10$Gdqh74fH.gBL3OqYElx96eRhmfDV3DU104Hrn0NpqNYooig2VzlYO');

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id_message` int(11) NOT NULL,
  `id_envoyeur` int(11) NOT NULL,
  `id_receveur` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `text` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id_message`, `id_envoyeur`, `id_receveur`, `date`, `text`) VALUES
(1, 5, 3, '2022-04-15 02:34:19', 'test message'),
(2, 3, 5, '2022-04-15 02:36:12', 'réponse de joe'),
(3, 5, 3, '2022-04-15 02:44:18', 'bah non c\'est moi joe'),
(4, 5, 3, '2022-04-15 09:15:28', 'coucou'),
(5, 7, 5, '2022-04-15 14:02:13', 'bonjour\r\n'),
(6, 7, 5, '2022-04-15 14:35:15', 'b'),
(7, 7, 5, '2022-04-15 14:36:10', 'b'),
(8, 7, 5, '2022-04-15 14:37:57', 't\r\n'),
(9, 7, 5, '2022-04-15 14:45:08', ' '),
(10, 7, 5, '2022-04-15 14:56:29', ' '),
(11, 5, 7, '2022-04-15 17:18:37', 'test');

-- --------------------------------------------------------

--
-- Structure de la table `participant`
--

CREATE TABLE `participant` (
  `id_participant` int(11) NOT NULL,
  `id_event` int(11) NOT NULL,
  `id_membre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id_comment`);

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id_contact`);

--
-- Index pour la table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id_event`);

--
-- Index pour la table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`id_membre`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id_message`);

--
-- Index pour la table `participant`
--
ALTER TABLE `participant`
  ADD PRIMARY KEY (`id_participant`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `id_contact` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT pour la table `event`
--
ALTER TABLE `event`
  MODIFY `id_event` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `membre`
--
ALTER TABLE `membre`
  MODIFY `id_membre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id_message` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `participant`
--
ALTER TABLE `participant`
  MODIFY `id_participant` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
