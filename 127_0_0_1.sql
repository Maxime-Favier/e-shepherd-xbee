-- phpMyAdmin SQL Dump
-- version 3.1.5
-- http://www.phpmyadmin.net
--
-- Serveur: maxime1.favier.sql.free.fr
-- Généré le : Lun 22 Janvier 2018 à 14:43
-- Version du serveur: 5.0.83
-- Version de PHP: 5.3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de données: `maxime1_favier`
--
CREATE DATABASE `maxime1_favier` DEFAULT CHARACTER SET ;
USE `maxime1_favier`;

-- --------------------------------------------------------

--
-- Structure de la table `area`
--

CREATE TABLE IF NOT EXISTS `area` (
  `id` int(11) NOT NULL auto_increment,
  `lat` float NOT NULL,
  `longi` float NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `area`
--

INSERT INTO `area` (`id`, `lat`, `longi`) VALUES
(1, 46.6494, 6.32812),
(2, 44.6218, 8.12988),
(3, 47.8721, 21.5332),
(4, 49.3251, 12.5244);

