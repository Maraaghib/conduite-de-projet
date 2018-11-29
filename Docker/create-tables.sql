-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 22 Novembre 2018 à 00:35
-- Version du serveur :  5.7.14
-- Version de PHP :  7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `cdp2018`
--

-- --------------------------------------------------------

--
-- Structure de la table `backlog`
--

CREATE TABLE IF NOT EXISTS `backlog` (
  `projectName` varchar(50) NOT NULL,
  `id` int(11) NOT NULL,
  `description` text NOT NULL,
  `priority` int(11) DEFAULT NULL,
  `difficulty` int(11) NOT NULL,
  `idSprint` int(11) DEFAULT NULL,
  `idAI` int(11) NOT NULL COMMENT 'Id. Auto-Increment pour lier US aux Tâches'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `dependence`
--

CREATE TABLE IF NOT EXISTS `dependence` (
  `id` int(11) NOT NULL,
  `idTask` varchar(30) NOT NULL,
  `idSprint` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `linkedus`
--

CREATE TABLE IF NOT EXISTS `linkedus` (
  `idTask` int(11) NOT NULL,
  `idUS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `author` varchar(50),/* Temporary set to null since there isn't a way to add an user*/
  `idAI` int(11) NOT NULL,
  `projectName` varchar(50) NOT NULL,
  `description` text,
  `sprintDuration` int(11) NOT NULL,
  `dateProject` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `sprint`
--

CREATE TABLE IF NOT EXISTS `sprint` (
  `id` int(11) NOT NULL,
  `projectName` varchar(50) NOT NULL,
  `startDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `task`
--

CREATE TABLE IF NOT EXISTS `task` (
  `idSprint` int(11) NOT NULL,
  `idTask` varchar(30) NOT NULL,
  `idAI` int(11) NOT NULL COMMENT 'Auto-Iincrement ID',
  `description` text NOT NULL,
  `estimatedTime` decimal(10,3) NOT NULL,
  `progress` varchar(30) NOT NULL DEFAULT 'todo',
  `affectedTo` int(11) DEFAULT '1' COMMENT 'ça doit être un clé étrangère de la table "user"'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `email` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `key` varchar(32) NOT NULL,
  `active` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `backlog`
--
ALTER TABLE `backlog`
  ADD PRIMARY KEY (`projectName`,`id`),
  ADD UNIQUE KEY `idAI` (`idAI`),
  ADD KEY `FK_Sprint_Backlog` (`idSprint`);

--
-- Index pour la table `dependence`
--
ALTER TABLE `dependence`
  ADD PRIMARY KEY (`id`,`idTask`),
  ADD KEY `idTask` (`idTask`,`idSprint`),
  ADD KEY `FK_Dependance_Task_Sprint` (`idSprint`,`idTask`),
  ADD KEY `id` (`id`);

--
-- Index pour la table `linkedus`
--
ALTER TABLE `linkedus`
  ADD PRIMARY KEY (`idTask`,`idUS`),
  ADD UNIQUE KEY `idTask` (`idTask`,`idUS`),
  ADD KEY `FK_LinkedUS_BackLog` (`idUS`);

--
-- Index pour la table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`projectName`),
  ADD UNIQUE KEY `idAI` (`idAI`);

--
-- Index pour la table `sprint`
--
ALTER TABLE `sprint`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projectName` (`projectName`);

--
-- Index pour la table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`idSprint`,`idTask`),
  ADD UNIQUE KEY `idAI` (`idAI`),
  ADD KEY `idSprint` (`idSprint`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `backlog`
--
ALTER TABLE `backlog`
  MODIFY `idAI` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id. Auto-Increment pour lier US aux Tâches';
--
-- AUTO_INCREMENT pour la table `project`
--
ALTER TABLE `project`
  MODIFY `idAI` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `sprint`
--
ALTER TABLE `sprint`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `task`
--
ALTER TABLE `task`
  MODIFY `idAI` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Auto-Iincrement ID';
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `backlog`
--
ALTER TABLE `backlog`
  ADD CONSTRAINT `FK_Project_Backlog` FOREIGN KEY (`projectName`) REFERENCES `project` (`projectName`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Sprint_Backlog` FOREIGN KEY (`idSprint`) REFERENCES `sprint` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `FK_User_Project` FOREIGN KEY (`author`) REFERENCES `user` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `dependence`
--
ALTER TABLE `dependence`
  ADD CONSTRAINT `FK_Dependance_Task` FOREIGN KEY (`id`) REFERENCES `task` (`idAI`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Dependance_Task_Sprint` FOREIGN KEY (`idSprint`,`idTask`) REFERENCES `task` (`idSprint`, `idTask`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `linkedus`
--
ALTER TABLE `linkedus`
  ADD CONSTRAINT `FK_LinkedUS_BackLog` FOREIGN KEY (`idUS`) REFERENCES `backlog` (`idAI`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_LinkedUS_Task` FOREIGN KEY (`idTask`) REFERENCES `task` (`idAI`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `sprint`
--
ALTER TABLE `sprint`
  ADD CONSTRAINT `FK_Project_Project_Sprint` FOREIGN KEY (`projectName`) REFERENCES `project` (`projectName`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `FK_Task_Sprint` FOREIGN KEY (`idSprint`) REFERENCES `sprint` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
