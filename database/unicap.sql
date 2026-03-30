-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2024 at 10:48 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `unicap`
--
create Database unicap;
-- --------------------------------------------------------

--
-- Table structure for table `commande`
--

CREATE TABLE `commande` (
  `id_commande` int(11) NOT NULL,
  `quantite` int(11) DEFAULT NULL,
  `prix` varchar(10) DEFAULT NULL,
  `statut` varchar(50) DEFAULT NULL,
  `date_creation` date DEFAULT NULL,
  `id_utilisateur` int(11) DEFAULT NULL,
  `mode_paiement` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `id_image` int(11) NOT NULL,
  `id_Produit` int(11) DEFAULT NULL,
  `chemin_image` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`id_image`, `id_Produit`, `chemin_image`) VALUES
(10, 10, 'uploads/bob vibe.jpg'),
(11, 11, 'uploads/B_rose.jpg'),
(12, 12, 'uploads/bob vibe ananas.jpg'),
(13, 13, 'uploads/NY_white.jpg'),
(14, 14, 'uploads/NY_jeans.jpg'),
(15, 15, 'uploads/NY_brown.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `produit`
--

CREATE TABLE `produit` (
  `id_Produit` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prix` varchar(10) NOT NULL,
  `description` text DEFAULT NULL,
  `courte_description` varchar(255) DEFAULT NULL,
  `quantite` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produit`
--

INSERT INTO `produit` (`id_Produit`, `nom`, `prix`, `description`, `courte_description`, `quantite`) VALUES
(10, 'bob vibe', '40', 'tione apre modif', 'bob vibebob vibebob vibebob vibebob vibebob vibe', 40),
(11, 'B rose', '25', 'B_Rose B_Rose B_Rose  B_Rose B_Rose ', 'B_Rose B_Rose', 12),
(12, 'bob ananas', '44.59', 'bob ananasbob ananasbob ananasbob ananasananasbob ananas', 'bob ananasbob ananasbob ananasbob ananas', 55),
(13, 'NEWYORK WHITE', '49.99', 'NEWYORK WHITENEWYORK WHITENEWYORK WHITE', 'NEWYORK WHITENEWYORK WHITE', 50),
(14, 'NEWYORK Jeans', '44', 'NEWYORK Jeans NEWYORK Jeans NEWYORK Jeans NEWYORK Jeans ', 'NEWYORK Jeans NEWYORK Jeans', 50),
(15, 'NEWYORk BROWN', '44', 'NEWYORk BROWNNEWYORk BROWNNEWYORk BROWNNEWYORk BROWN', 'NEWYORk BROWNNEWYORk BROWN', 44);

-- --------------------------------------------------------

--
-- Table structure for table `produitcommande`
--

CREATE TABLE `produitcommande` (
  `id_Produit` int(11) DEFAULT NULL,
  `id_commande` int(11) DEFAULT NULL,
  `quantite` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id_utilisateur` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `mot_de_passe` text NOT NULL,
  `role` enum('client','admin') NOT NULL DEFAULT 'client',
  `adresse` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `nom`, `prenom`, `email`, `telephone`, `mot_de_passe`, `role`, `adresse`) VALUES
(20, 'ouadii', 'hamza', 'hamza@unicap.com', '12345678', '$2y$10$DZHkiM6XcpxncyTVSeSlk.m/WEmtWQ1bkT8akFV71Twx5byRNXbeq', 'client', '4446 Rue De La Roche'),
(25, 'tine', 'tine', 'tine@unicap.ca', '2345678', '$2y$10$JazKNPEwCjHF04K2QMNwEeUd3VVgAZK3eh2K/BTho85aePce4kKjK', 'client', '4446 Rue De La Roche'),
(26, 'tine', 'tine', 'hamza@unicap.ccc', '123456789', '$2y$10$vciOliQglBuSYrArZ..bVOW2MhoDRv8eWLhrqpyJdRGvI5QciFTXi', 'client', '4446 Rue De La Roche'),
(27, 'tine', 'tine', 'tine@gmail.com', '12345673456789', '$2y$10$nwoshQRC0TUnokecL4FebuLVb/HPxtorwE0EnMf59ZXN0iGFuwS9u', 'client', 'qwertyuiouytrdfghj'),
(28, 'Ouadii', 'Hamza', 'hamzaouadii@gmail.com', '5144340517', '$2y$10$irrS4mDc8zUqMseFPFLnXu3lN.gwciOZh3pc9RmxE1TYz4CgMXLoK', 'client', 'teccart');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id_commande`),
  ADD KEY `fk_commande_utilisateur` (`id_utilisateur`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id_image`),
  ADD KEY `fk_image_Produit` (`id_Produit`);

--
-- Indexes for table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id_Produit`);

--
-- Indexes for table `produitcommande`
--
ALTER TABLE `produitcommande`
  ADD KEY `fk_Produit_commande` (`id_Produit`),
  ADD KEY `fk_commande_Produit` (`id_commande`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_utilisateur`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `commande`
--
ALTER TABLE `commande`
  MODIFY `id_commande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `id_image` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `produit`
--
ALTER TABLE `produit`
  MODIFY `id_Produit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `fk_commande_utilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `fk_image_Produit` FOREIGN KEY (`id_Produit`) REFERENCES `produit` (`id_Produit`);

--
-- Constraints for table `produitcommande`
--
ALTER TABLE `produitcommande`
  ADD CONSTRAINT `fk_Produit_commande` FOREIGN KEY (`id_Produit`) REFERENCES `produit` (`id_Produit`),
  ADD CONSTRAINT `fk_commande_Produit` FOREIGN KEY (`id_commande`) REFERENCES `commande` (`id_commande`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
