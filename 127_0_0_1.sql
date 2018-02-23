-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Ven 23 Février 2018 à 17:40
-- Version du serveur :  5.5.59-0+deb8u1
-- Version de PHP :  5.6.33-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `maxime1_favier`
--
CREATE DATABASE IF NOT EXISTS `maxime1_favier` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `maxime1_favier`;

-- --------------------------------------------------------

--
-- Structure de la table `area`
--
-- Création :  Ven 23 Février 2018 à 16:14
-- Dernière modification :  Ven 23 Février 2018 à 16:14
--

CREATE TABLE IF NOT EXISTS `area` (
`id` int(11) NOT NULL,
  `lat` float NOT NULL,
  `longi` float NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `auth`
--
-- Création :  Ven 23 Février 2018 à 12:34
--

CREATE TABLE IF NOT EXISTS `auth` (
`userid` int(11) NOT NULL,
  `login` text NOT NULL,
  `email` text NOT NULL,
  `mdp` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `positions`
--
-- Création :  Mer 31 Janvier 2018 à 14:20
-- Dernière modification :  Lun 19 Février 2018 à 19:54
-- Dernière vérification :  Mar 20 Février 2018 à 15:17
--

CREATE TABLE IF NOT EXISTS `positions` (
`id` int(11) NOT NULL,
  `idmoutton` int(11) NOT NULL,
  `datation` datetime NOT NULL,
  `lat` float NOT NULL,
  `lng` float NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `area`
--
ALTER TABLE `area`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `auth`
--
ALTER TABLE `auth`
 ADD PRIMARY KEY (`userid`);

--
-- Index pour la table `positions`
--
ALTER TABLE `positions`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `area`
--
ALTER TABLE `area`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `auth`
--
ALTER TABLE `auth`
MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `positions`
--
ALTER TABLE `positions`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=39;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
