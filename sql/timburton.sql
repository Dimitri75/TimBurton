-- phpMyAdmin SQL Dump
-- version 4.5.3.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 24 Février 2016 à 17:16
-- Version du serveur :  5.7.10
-- Version de PHP :  5.6.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `timburton`
--
CREATE DATABASE IF NOT EXISTS `timburton` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `timburton`;

-- --------------------------------------------------------

--
-- Structure de la table `film`
--

DROP TABLE IF EXISTS `film`;
CREATE TABLE `film` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `resume` varchar(255) NOT NULL,
  `date` date DEFAULT NULL,
  `note` double DEFAULT NULL,
  `illustration` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Vider la table avant d'insérer `film`
--

TRUNCATE TABLE `film`;
--
-- Contenu de la table `film`
--

INSERT INTO `film` (`id`, `name`, `resume`, `date`, `note`, `illustration`) VALUES
(1, 'Edward Scissorhands', 'A gentle man, with scissors for hands, is brought into a new community after living in isolation.', '1990-12-14', 7.9, 'edward_scissorhands.png'),
(2, 'Corpse Bride', 'When a shy groom practices his wedding vows in the inadvertent presence of a deceased young woman, she rises from the grave assuming he has married her.', '2005-09-23', 7.4, 'corpse_bride.png'),
(15, 'Alice in Wonderland', 'Nineteen-year-old Alice returns to the magical world from her childhood adventure, where she reunites with her old friends and learns of her true destiny: to end the Red Queen\'s reign of terror.', '2010-03-05', 6.5, 'alice_in_wonderland.png'),
(16, 'Charlie and the Chocolate Factory', 'A young boy wins a tour through the most magnificent chocolate factory in the world, led by the world\'s most unusual candy maker.', '2005-07-15', 6.7, 'charlie_and_the_chocolate_factory.png'),
(17, 'Sweeney Todd: The Demon Barber of Fleet Street', 'The infamous story of Benjamin Barker, AKA Sweeney Todd, who sets up a barber shop down in London which is the basis for a sinister partnership with his fellow tenant, Mrs. Lovett. Based on the hit Broadway musical.', '2007-12-21', 7.4, 'sweeney_todd_the_demon_barber_of_fleet_street.png'),
(18, 'Big Fish', 'A frustrated son tries to determine the fact from fiction in his dying father\'s life.', '2004-01-09', 8, 'big_fish.png');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `login` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Vider la table avant d'insérer `user`
--

TRUNCATE TABLE `user`;
--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `email`) VALUES
(8, 'dimitri', 'admin', NULL),
(9, 'root', 'root', NULL),
(7, 'admin', 'admin', NULL);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `film`
--
ALTER TABLE `film`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
