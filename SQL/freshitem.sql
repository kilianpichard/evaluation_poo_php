-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : ven. 28 oct. 2022 à 14:34
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
-- Base de données : `poo_factures`
--

-- --------------------------------------------------------

--
-- Structure de la table `freshitem`
--

CREATE TABLE `freshitem` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` float NOT NULL,
  `weight` float NOT NULL,
  `dlc` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `freshitem`
--

INSERT INTO `freshitem` (`id`, `name`, `price`, `weight`, `dlc`) VALUES
(1, 'Salmon', 1200, 1000, '2022-10-31'),
(2, 'Tuna', 999, 500, '2022-11-31'),
(3, 'Cod', 750, 750, '2022-11-28'),
(4, 'Haddock', 1249, 1200, '2022-11-15'),
(5, 'Swordfish', 1999, 3000, '2022-11-20'),
(6, 'Shrimp', 1299, 2000, '2022-11-01'),
(7, 'Lobster', 1350, 7000, '2022-11-12'),
(8, 'Crab', 450, 8000, '2022-11-05'),
(9, 'Mussels', 250, 9000, '2022-11-22');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `freshitem`
--
ALTER TABLE `freshitem`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `freshitem`
--
ALTER TABLE `freshitem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
