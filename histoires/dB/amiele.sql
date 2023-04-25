-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : ven. 13 mai 2022 à 14:26
-- Version du serveur :  10.3.34-MariaDB-0ubuntu0.20.04.1
-- Version de PHP : 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `amiele`
--
CREATE DATABASE IF NOT EXISTS `amiele` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `amiele`;

-- --------------------------------------------------------

--
-- Structure de la table `ACTIONS`
--

DROP TABLE IF EXISTS `ACTIONS`;
CREATE TABLE `ACTIONS` (
  `ID_DEPART` int(11) NOT NULL,
  `NOM_ACTION` text NOT NULL,
  `ID_ARRIVEE` int(11) NOT NULL,
  `CONSEQUENCE` text DEFAULT NULL,
  `S_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ACTIONS`
--

INSERT INTO `ACTIONS` (`ID_DEPART`, `NOM_ACTION`, `ID_ARRIVEE`, `CONSEQUENCE`, `S_ID`) VALUES
(1, 'Abandonner', 2, NULL, 75),
(1, 'Continuer malgré ce header récalcitrant', 3, NULL, 75),
(3, '1', 1, NULL, 45),
(3, 'Mais ? Et la base de données ? Vous vous rendez compte que l&#039;histoire est à l&#039;envers !', 4, NULL, 75),
(3, 'Prenez un repos bien mérité', 5, NULL, 75),
(3, 'Lancez-vous à corps perdu dans le front !', 6, NULL, 75),
(4, '4', 4, NULL, 45),
(4, 'Lire The JSWay pendant 4 heures à la recherche du node perdu !', 7, NULL, 75),
(4, 'Cherchez inlassablement une réponse sur DelfStack', 8, NULL, 75),
(4, 'Tant pis pour le JS de toute façon python c&#039;est mieux !', 9, NULL, 75),
(4, 'KL', 490, NULL, 45),
(5, 'Prenez un repos bien mérité', 5, NULL, 75),
(6, 'Vous en oubliez la base de données, que vous auriez d&#039;ailleurs du faire en premier', 6, NULL, 75),
(7, 'En bon paranoïaque, vous lancez un audit de sécurité aux petits oignons pour éviter que Gabriel vide votre BDD', 10, NULL, 75),
(7, 'Vous vous improvisez UX designer, de toute façon vous n&#039;avez plus rien d&#039;autres à faire n&#039;est-ce pas ?', 13, NULL, 75),
(8, 'Vous voyez une vidéo très intéressante pour finir votre projet dans les temps', 11, NULL, 75),
(8, 'Vous vous concentrez sur ce que vous avez déjà pour être sûr que ça fonctionne !', 12, NULL, 75),
(9, 'Perdu', 9, NULL, 75),
(10, 'Vous vous mettez ensuite à vérifier l&#039;accessibilité', 14, NULL, 75),
(10, 'Conscient que l&#039;oral arrive vite vous commencez par faire votre diapo et mettre le site sur zzz', 15, NULL, 75),
(11, 'Manque de pot vous êtes chez SFR et vous ne pouvez pas en voir plus de cinq secondes d&#039;affilée sans que ça charge pendant 5 minutes', 11, NULL, 75),
(12, 'En bon paranoïaque, vous lancez un audit de sécurité aux petits oignons pour éviter que Gabriel vide votre BDD', 10, NULL, 75),
(12, 'Vous vous improvisez UX designer, de toute façon vous n&#039;avez plus rien d&#039;autres à faire n&#039;est-ce pas ?', 13, NULL, 75),
(13, 'Gabriel vide la BDD', 13, NULL, 75),
(14, 'oral raté', 14, NULL, 75),
(15, 'Gagné', 15, NULL, 75);

-- --------------------------------------------------------

--
-- Structure de la table `MARQUAGE`
--

DROP TABLE IF EXISTS `MARQUAGE`;
CREATE TABLE `MARQUAGE` (
  `U_ID` int(11) NOT NULL,
  `S_ID` int(11) NOT NULL,
  `P_ID` int(11) NOT NULL,
  `CHEMIN` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `MARQUAGE`
--

INSERT INTO `MARQUAGE` (`U_ID`, `S_ID`, `P_ID`, `CHEMIN`) VALUES
(8, 75, 3, '');

-- --------------------------------------------------------

--
-- Structure de la table `PARAGRAPHS`
--

DROP TABLE IF EXISTS `PARAGRAPHS`;
CREATE TABLE `PARAGRAPHS` (
  `S_ID` int(11) NOT NULL,
  `P_ID` int(11) NOT NULL,
  `text` text NOT NULL,
  `back_image` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `sound` text DEFAULT NULL,
  `nbTrophee` int(11) DEFAULT NULL,
  `Suite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `PARAGRAPHS`
--

INSERT INTO `PARAGRAPHS` (`S_ID`, `P_ID`, `text`, `back_image`, `image`, `sound`, `nbTrophee`, `Suite`) VALUES
(45, 1, '6', '', '', '', 6, 0),
(45, 2, 'JKSD', '', '', '', 20, 0),
(45, 3, 'D', '', '', '', 1, 0),
(45, 4, 'sd', '', '', '', 4, 0),
(75, 1, 'Le 8 Avril dernier nous nous lançâmes dans le projet le plus extraordinaire de notre jeune carrière ! Créer un site web qui permettrait à tous de partager des histoires sans limites matérielles !', 'logo.png', 'logo.png', NULL, 0, 2),
(75, 2, 'Vous avez abandonné ? Déjà ? Ben tant pis pour vous vous aurez 2 !', 'images.png', 'images.png', NULL, 0, 1),
(75, 3, 'Bravant les dangers du manque de sommeil et des requêtes SQL en PHP, nous avons développé un site digne de ce nom. Avec un form de contact sur la page d&#039;accueil, s&#039;il vous plaît !', '', '', NULL, 5, 2),
(75, 4, 'Vous avez bien entendu pensé à commencer par la BDD ! Elle est d&#039;ailleurs magnifique ! Vous vous essayez à JavaScript mais la tâche s&#039;avère ardue, votre NaN ne semble pas vouloir respecter les lois de l&#039;identité et vos tableaux se mergent bizarrement !', '', '', NULL, 5, 2),
(75, 5, 'Vous croyez que ça va se faire tout seul ?', '', '', NULL, 0, 1),
(75, 6, 'Vous en oubliez la base de données, que vous auriez d&#039;ailleurs du faire en premier ! Vous arrivez à l&#039;oral en sueur et sans diapo après avoir dû tout refaire en quelques jours, vous avez 9 à cause de votre accessibilité qui laisse bien trop à désirer. Du jaune fluo avec des écriture blanches ? Sérieusement ? Mme Lespinet ne serait pas fière ...', '', '', NULL, 0, 1),
(75, 7, 'Vous trouvez la science infuse dans les pages de l&#039;antique PDF ! Votre projet décolle ! Reste encore quelques bugs à vérifier mais le site est fonctionnel ! :D', '', '', NULL, 5, 2),
(75, 8, 'Vous tombez sur un lien vers la vidéo d&#039;un youtuber indien sur Xammp qui sauve votre nuit !', '', '', NULL, 5, 2),
(75, 9, 'PyScript vous aurait sans doute sauvé quelques mois plus tard, mais pour l&#039;instant il n&#039;est pas au point, vous vous retrouvez avec un site statique des années 2000.\r\n12,5 Bel effort mais peut mieux faire', '', '', NULL, 0, 1),
(75, 10, 'Votre site est tellement sécurisé que Gabriel doit s&#039;incliner au risque de griller les serveurs avec ses virus ', '', '', NULL, 7, 2),
(75, 11, 'Manque de pot vous êtes chez SFR et vous ne pouvez pas en voir plus de cinq secondes d&#039;affilée sans que ça charge pendant 5 minutes', '', '', NULL, 0, 1),
(75, 12, 'Vous avez eu le nez fin, votre site est vraiment fonctionnel et vous pouvez désormais vous tourner vers l&#039;oral avec sérénité', '', '', NULL, 5, 2),
(75, 13, 'Vous oubliez la sécurité et Gabriel prend un malin plaisir à vous laisser faire la démonstration d&#039;un site vide ! Inacceptable ! Beau joueur il vous met tout de même la moyenne, mais vous espériez mieux', '', '', NULL, 0, 1),
(75, 14, 'Vous étiez tellement pris dans la vérification de l&#039;accessibilité que vous avez oublié de mettre votre site sur le serveur ! Vous êtes obligé de revenir le matin de l&#039;oral pour le faire ! En stress complet après avoir fait votre Diapo jusqu&#039;à minuit la veille, vous ratez votre prestation orale malgré un site très qualitatif ! Dépité par votre 15/20, vous apprenez de la plus mauvaise manière que le sommeil avant un oral !', '', '', NULL, 15, 1),
(75, 15, 'Votre oral se passe à merveille grâce au sommeil réparateur que votre prévoyance a permis, vous obtenez la note exceptionnelle de 21/20 après une réunion extraordinaire du conseil d&#039;école pour savoir s&#039;il faut vous envoyer à la DGSI ou directement vous promouvoir patron de chez Thalès !', '', '', NULL, 50, 0);

-- --------------------------------------------------------

--
-- Structure de la table `STORIES`
--

DROP TABLE IF EXISTS `STORIES`;
CREATE TABLE `STORIES` (
  `S_ID` int(11) NOT NULL,
  `title` text NOT NULL,
  `desc` text NOT NULL,
  `tag` text DEFAULT NULL,
  `create_date` int(100) NOT NULL,
  `vues` int(11) NOT NULL DEFAULT 0,
  `picture` text DEFAULT NULL,
  `hidden` tinyint(1) DEFAULT 0,
  `auteur` text NOT NULL,
  `write_date` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `STORIES`
--

INSERT INTO `STORIES` (`S_ID`, `title`, `desc`, `tag`, `create_date`, `vues`, `picture`, `hidden`, `auteur`, `write_date`) VALUES
(75, 'La conquête du projet web', 'L&#039;histoire palpitante de notre projet web', 'ratio', 12052022, 53, '', 0, 'Benoît &amp; Andrea', 20220512);

-- --------------------------------------------------------

--
-- Structure de la table `USERS`
--

DROP TABLE IF EXISTS `USERS`;
CREATE TABLE `USERS` (
  `User_ID` int(11) NOT NULL,
  `login` text NOT NULL,
  `password` text NOT NULL,
  `profile_image` text DEFAULT NULL,
  `nbTrophees` int(11) DEFAULT 0,
  `P_S_1` int(11) DEFAULT NULL,
  `P_S_2` int(11) DEFAULT NULL,
  `P_S_3` int(11) DEFAULT NULL,
  `admin` tinyint(1) DEFAULT 0,
  `Nom` text NOT NULL,
  `Prenom` text NOT NULL,
  `Played` int(11) NOT NULL DEFAULT 0,
  `Won` int(11) DEFAULT 0,
  `Lost` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `USERS`
--

INSERT INTO `USERS` (`User_ID`, `login`, `password`, `profile_image`, `nbTrophees`, `P_S_1`, `P_S_2`, `P_S_3`, `admin`, `Nom`, `Prenom`, `Played`, `Won`, `Lost`) VALUES
(7, 'correcteur', '$2y$10$Z/MtAfYN4hVGKbZi9ki3fu1MlpTfXjjJUTjiDmghv4PlIy0cWy1AS', 'carbon (20).png', 144, NULL, NULL, NULL, 0, 'De la Correction', 'Correcteur', 12, 1, 12),
(8, 'correcteur_admin', '$2y$10$FvkYQHefGhzZ786Rw4cq5O1oymM7p1DW7pe3V9r/Ur0Wbgnd1zv3q', '277613869_342172324641960_3182056889120538791_n.jpg', 931, NULL, NULL, NULL, 1, 'De la Correction', 'Correcteur Admin', 48, 25, 30),
(9, 'test', '$2y$10$4zbobSjWaobmdw4FUEUMBuccPILVmO810235bNS6a18vHE4aysWLe', NULL, 1888886, NULL, NULL, NULL, 0, '&lt;script&gt;alert(&quot;prout&quot;)&lt;/script&gt;  ', 'kdfjslfkjs', 2, 0, 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `ACTIONS`
--
ALTER TABLE `ACTIONS`
  ADD PRIMARY KEY (`ID_DEPART`,`ID_ARRIVEE`,`S_ID`);

--
-- Index pour la table `MARQUAGE`
--
ALTER TABLE `MARQUAGE`
  ADD PRIMARY KEY (`U_ID`,`S_ID`);

--
-- Index pour la table `PARAGRAPHS`
--
ALTER TABLE `PARAGRAPHS`
  ADD PRIMARY KEY (`S_ID`,`P_ID`),
  ADD KEY `S_ID` (`S_ID`),
  ADD KEY `S_ID_2` (`S_ID`);

--
-- Index pour la table `STORIES`
--
ALTER TABLE `STORIES`
  ADD PRIMARY KEY (`S_ID`);

--
-- Index pour la table `USERS`
--
ALTER TABLE `USERS`
  ADD PRIMARY KEY (`User_ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `STORIES`
--
ALTER TABLE `STORIES`
  MODIFY `S_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT pour la table `USERS`
--
ALTER TABLE `USERS`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
