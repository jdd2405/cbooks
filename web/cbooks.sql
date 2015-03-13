-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 26. Sep 2014 um 17:30
-- Server Version: 5.6.11
-- PHP-Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `cbooks`
--
CREATE DATABASE IF NOT EXISTS `cbooks` DEFAULT CHARACTER SET latin1 COLLATE latin1_general_ci;
USE `cbooks`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text COLLATE latin1_general_ci NOT NULL,
  `isbn` int(11) NOT NULL,
  `author` text COLLATE latin1_general_ci NOT NULL,
  `year` int(11) NOT NULL,
  `description` text COLLATE latin1_general_ci NOT NULL,
  `owner` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `owner` (`owner`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL,
  `email` varchar(80) CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL,
  `lastname` varchar(50) CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL,
  `firstname` varchar(50) CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL,
  `street` varchar(80) CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL,
  `plz` int(4) NOT NULL,
  `city` varchar(50) CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL,
  `phone` varchar(30) CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=8 ;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `lastname`, `firstname`, `street`, `plz`, `city`, `phone`) VALUES
(1, 'jdd2405', 'test', 'jonas@daester.net', 'Däster', 'Jonas', 'Beispielstrasse', 9999, 'Hinterwald', '0800 800 800'),
(7, 'admin', 'adsf', 'name@host.ch', '', '', '', 0, '', '');

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`owner`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
