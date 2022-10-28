-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : ven. 28 oct. 2022 à 14:35
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
-- Structure de la table `employe`
--

CREATE TABLE `employe` (
  `idEmploye` int(4) NOT NULL,
  `prenom` varchar(20) DEFAULT NULL,
  `nom` varchar(20) DEFAULT NULL,
  `sexe` enum('m','f') NOT NULL,
  `service` varchar(30) DEFAULT NULL,
  `dateEmbauche` date DEFAULT NULL,
  `salaire` float DEFAULT NULL,
  `idSecteur` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `employe`
--

INSERT INTO `employe` (`idEmploye`, `prenom`, `nom`, `sexe`, `service`, `dateEmbauche`, `salaire`, `idSecteur`) VALUES
(7256, 'danielle', 'chevelle', 'm', 'informatique', '2010-07-05', 1800, 11),
(7369, 'julien', 'cottet', 'm', 'secretariat', '2007-01-19', 1570, 10),
(7499, 'fabrice', 'grand', 'm', 'comptabilite', '2003-02-20', 1200, 10),
(7521, 'élodie', 'fellier', 'f', 'secretariat', '2002-02-22', 1250, 10),
(7566, 'stephanie', 'lafaye', 'f', 'assistant manager', '1998-04-02', 2775, 10),
(7654, 'damien', 'durand', 'm', 'commercial', '2005-09-28', 1250, 30),
(7698, 'thomas', 'winter', 'm', 'commercial', '1998-05-03', 2550, 20),
(7782, 'laura', 'blanchet', 'f', 'direction', '1998-06-09', 3050, 10),
(7788, 'jean-pierre', 'laborde', 'm', 'direction', '1997-12-09', 5000, 10),
(7839, 'thierry', 'desprez', 'm', 'standardiste', '2009-11-17', 1100, 10),
(7844, 'emilie', 'sennard', 'f', 'commercial', '1999-09-11', 2800, 40),
(7845, 'celine', 'perrin', 'f', 'commercial', '2006-09-10', 1500, 10),
(7846, 'melanie', 'collier', 'f', 'commercial', '2000-09-08', 1900, 30),
(7847, 'chloe', 'dubar', 'f', 'commercial', '2001-09-05', 2100, 30),
(7848, 'guillaume', 'miller', 'm', 'commercial', '2006-07-02', 1700, 20),
(7876, 'nathalie', 'martin', 'f', 'juridique', '2012-01-12', 3200, 10),
(7900, 'benoit', 'lagarde', 'm', 'chef de projet', '1999-01-03', 2050, 10),
(7902, 'mathieu', 'vignal', 'm', 'informatique', '2008-12-03', 1800, 10),
(7934, 'amandine', 'thoyer', 'f', 'charge de communication', '2010-01-23', 1500, 40),
(7944, 'aziz', 'Tobbal', 'm', 'informatique', '2022-05-13', 3500, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `employe`
--
ALTER TABLE `employe`
  ADD PRIMARY KEY (`idEmploye`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `employe`
--
ALTER TABLE `employe`
  MODIFY `idEmploye` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7951;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
