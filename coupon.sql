      -- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 24 Juin 2015 à 07:43
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `sbs`
--

-- --------------------------------------------------------

--
-- Structure de la table `coupon`
--

CREATE TABLE IF NOT EXISTS `coupon` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `pick` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `scope` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `scope_id` int(11) NOT NULL,
  `bookmaker` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bookmaker_id` int(11) NOT NULL,
  `odd_value` decimal(8,2) NOT NULL,
  `odd_doubleParam` double NOT NULL,
  `odd_doubleParam2` double NOT NULL,
  `odd_doubleParam3` double NOT NULL,
  `odd_participantParameter` int(11) NOT NULL,
  `odd_participantParameterName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `odd_participantParameter2` int(11) NOT NULL,
  `odd_participantParameterName2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `odd_participantParameter3` int(11) NOT NULL,
  `odd_participantParameterName3` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `odd_groupParam` double NOT NULL,
  `market` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `market_id` int(11) NOT NULL,
  `game_time` datetime NOT NULL,
  `game_id` int(11) NOT NULL,
  `game_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sport_id` int(11) NOT NULL,
  `sport_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `league_id` int(11) NOT NULL,
  `league_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `event_country_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `home_team` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `home_team_country_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `away_team` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `away_team_country_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `score` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `isLive` tinyint(1) NOT NULL,
  `isMatch` tinyint(1) NOT NULL,
  `session_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `affichage` smallint(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=64 ;

--
-- Contenu de la table `coupon`
--

INSERT INTO `coupon` (`id`, `created_at`, `updated_at`, `pick`, `scope`, `scope_id`, `bookmaker`, `bookmaker_id`, `odd_value`, `odd_doubleParam`, `odd_doubleParam2`, `odd_doubleParam3`, `odd_participantParameter`, `odd_participantParameterName`, `odd_participantParameter2`, `odd_participantParameterName2`, `odd_participantParameter3`, `odd_participantParameterName3`, `odd_groupParam`, `market`, `market_id`, `game_time`, `game_id`, `game_name`, `sport_id`, `sport_name`, `league_id`, `league_name`, `event_country_name`, `home_team`, `home_team_country_name`, `away_team`, `away_team_country_name`, `score`, `isLive`, `isMatch`, `session_id`, `affichage`) VALUES
(85, '2015-06-10 06:16:20', '2015-06-10 06:16:20', 'Neptunas Klaipeda', 'Full Time Including Overtime', 1, 'Bet365', 3000271, '1.17', -999.888, -999.888, -999.888, 43366, 'Neptunas Klaipeda', -2147483648, 'null', -2147483648, 'null', -999.888, 'Match Winner', 46, '2015-06-10 15:30:00', 213079855, 'Neptunas Klaipeda - Juventus-Lksk Utenos', 8, 'Basketball', 213025770, 'LKL 2015', '', 'Neptunas Klaipeda', '', 'Juventus-Lksk Utenos', '', 'null', 0, 0, 'f8931cec681bb1a7eb38cd963ac3dd35a2ef95cf', 1);


INSERT INTO `coupon` (`id`, `created_at`, `updated_at`, `pick`, `scope`, `scope_id`, `bookmaker`, `bookmaker_id`, `odd_value`, `odd_doubleParam`, `odd_doubleParam2`, `odd_doubleParam3`, `odd_participantParameter`, `odd_participantParameterName`, `odd_participantParameter2`, `odd_participantParameterName2`, `odd_participantParameter3`, `odd_participantParameterName3`, `odd_groupParam`, `market`, `market_id`, `game_time`, `game_id`, `game_name`, `sport_id`, `sport_name`, `league_id`, `league_name`, `event_country_name`, `home_team`, `home_team_country_name`, `away_team`, `away_team_country_name`, `score`, `isLive`, `isMatch`, `session_id`, `affichage`) VALUES
(88, '2015-06-10 06:16:20', '2015-06-10 06:16:20', 'Neptunas Klaipeda', 'Full Time Including Overtime', 0, 'Bet365', 3000271, '1.17', -999.888, -999.888, -999.888, 43366, 'Neptunas Klaipeda', -2147483648, 'null', -2147483648, 'null', -999.888, 'Match Winner', 46, '2015-06-10 15:30:00', 213079855, 'Neptunas Klaipeda - Juventus-Lksk Utenos', 0, 'Basketball', 0, 'LKL 2015', '', 'Neptunas Klaipeda', '', 'Juventus-Lksk Utenos', '', 'null', 0, 0, 'f8931cec681bb1a7eb38cd963ac3dd35a2ef95cf', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
