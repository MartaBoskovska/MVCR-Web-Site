-- phpMyAdmin SQL Dump
-- version 5.0.4deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : mysql.info.unicaen.fr:3306
-- Généré le : lun. 28 nov. 2022 à 22:28
-- Version du serveur :  10.5.11-MariaDB-1
-- Version de PHP : 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `22012535_bd`
--

-- --------------------------------------------------------

--
-- Structure de la table `ENDROITS`
--

CREATE TABLE `ENDROITS` (
  `id` varchar(20) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `ENDROITS`
--

INSERT INTO `ENDROITS` (`id`, `name`, `price`, `date`) VALUES
('e53d09c0cbb2743a', ' Indonesie', 8, '2023-06-21'),
('b715f673a747bbec', 'Bali', 499, '2023-07-20'),
('d0d3754bd5b4937f', 'Cappadocia', 300, '2023-05-31'),
('c29726af75a9dfd2', ' Cape Town', 498, '2023-08-20'),
('c2bd193490446930', 'Égypte', 349, '2023-12-15'),
('fcc06d028464f8f1', 'Colombie', 549, '2023-07-15'),
('cb8539fa834b93c4', 'Croatie', 450, '2023-12-17'),
('a4f62849f9fc7145', 'Montenegro', 299, '2023-06-02'),
('d5f938b49f6f133e', 'La Polynésie Française', 300, '2023-07-05'),
('e53d09c0cbb2743a', ' Indonesie', 8, '2023-06-21');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
