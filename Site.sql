-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  Dim 03 jan. 2021 à 23:21
-- Version du serveur :  5.7.31-0ubuntu0.18.04.1
-- Version de PHP :  7.2.24-0ubuntu0.18.04.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `Site`
--

-- --------------------------------------------------------

--
-- Structure de la table `Categorie`
--

CREATE TABLE `Categorie` (
  `idCategorie` int(11) NOT NULL,
  `categorie` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Categorie`
--

INSERT INTO `Categorie` (`idCategorie`, `categorie`) VALUES
(1, 'salé'),
(2, 'sucré');

-- --------------------------------------------------------

--
-- Structure de la table `Clients`
--

CREATE TABLE `Clients` (
  `idClient` int(11) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `codePostale` int(5) NOT NULL,
  `email` varchar(20) NOT NULL,
  `pseudo` varchar(20) NOT NULL,
  `motDePasse` varchar(255) NOT NULL,
  `nbCredits` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Clients`
--

INSERT INTO `Clients` (`idClient`, `nom`, `prenom`, `codePostale`, `email`, `pseudo`, `motDePasse`, `nbCredits`) VALUES
(3, 'test', 'test', 14000, 'test.test@gmail.com', 'test', '47353d3457fd917d3f132096642f83e593f83fa9203c3502930144e62f056214', 3);

-- --------------------------------------------------------

--
-- Structure de la table `Commande`
--

CREATE TABLE `Commande` (
  `IdCommande` int(11) NOT NULL,
  `idClient` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `prixTotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `CommandeCredit`
--

CREATE TABLE `CommandeCredit` (
  `idCommande` int(11) NOT NULL,
  `idClient` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `prixTotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `CommandeCredit`
--

INSERT INTO `CommandeCredit` (`idCommande`, `idClient`, `date`, `prixTotal`) VALUES
(2, 3, '2021-01-03 17:31:01', 60),
(3, 3, '2021-01-03 17:38:00', 150);

-- --------------------------------------------------------

--
-- Structure de la table `Cours`
--

CREATE TABLE `Cours` (
  `idCours` int(11) NOT NULL,
  `nom` varchar(60) NOT NULL,
  `niveau` varchar(255) NOT NULL,
  `prix` int(10) NOT NULL,
  `temps` varchar(20) NOT NULL,
  `categorie` int(11) NOT NULL,
  `description` varchar(200) NOT NULL,
  `imgCours` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Cours`
--

INSERT INTO `Cours` (`idCours`, `nom`, `niveau`, `prix`, `temps`, `categorie`, `description`, `imgCours`) VALUES
(3, 'Macarons', 'Moyen', 1, '2h30', 2, 'Apprennez à réaliser les fameux macarons. Au chocolat, aux fruits, les possibilités sont presque infinie !', 'img/macarons-5690175_1280.jpg'),
(4, 'Langoustes au sabayon de vanille', 'Facile', 1, '1h30', 1, 'Impressionez-vous à réaliser cette recette assez technique et incroyablement delicieuse.', 'img/lobster-1615616_1280.jpg'),
(5, 'Soufflés au citron', 'Difficile', 1, '1h30', 2, 'Vous ne raterez plus jamais un soufflé. On vous le garantis.', 'img/breath-1241303_1280.jpg'),
(6, 'Jarret laqué aux épices', 'Facile', 1, '2h30', 1, 'Cette recette sucrée-salée satisfera tout les palais, augmentez vos competences en cuisine et faites-vous plaisir. Profitez des précieux conseils d\'un chef.', 'img/ham-hocks-1948993_1280.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `Horaires`
--

CREATE TABLE `Horaires` (
  `idHoraire` int(11) NOT NULL,
  `idCours` int(11) NOT NULL,
  `jour` varchar(8) NOT NULL,
  `heure` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Horaires`
--

INSERT INTO `Horaires` (`idHoraire`, `idCours`, `jour`, `heure`) VALUES
(1, 3, 'Samedi', '15:00'),
(2, 5, 'Samedi', '13:00'),
(3, 4, 'Mercredi', '16:00'),
(5, 3, 'Vendredi', '16:30'),
(7, 3, 'Lundi', '15:00'),
(15, 6, 'Lundi', '15:00'),
(16, 3, 'Mardi', '14:00'),
(17, 4, 'Lundi', '15:00'),
(18, 6, 'Mardi', '14:00'),
(19, 5, 'Mardi', '14:00');

-- --------------------------------------------------------

--
-- Structure de la table `Recettes`
--

CREATE TABLE `Recettes` (
  `idRecette` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `niveau` varchar(255) NOT NULL,
  `temps` varchar(255) NOT NULL,
  `nombreDePersonne` int(11) NOT NULL,
  `ingredients` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `categorie` int(11) NOT NULL,
  `imgRecette` varchar(60) NOT NULL,
  `ImgDerouleRecette` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Recettes`
--

INSERT INTO `Recettes` (`idRecette`, `nom`, `niveau`, `temps`, `nombreDePersonne`, `ingredients`, `description`, `categorie`, `imgRecette`, `ImgDerouleRecette`) VALUES
(1, 'Tarte aux pommes', 'Facile', '1h05', 6, '200g de farine, 160g de beurre, 150g de sucre roux, 1kg de pommes, cannelle, sel', 'La fameuse tarte aux pommes, un classique.', 2, 'img/apple-pie-6007_1280.jpg', 'img/DerouleRecetteTarte.png'),
(2, 'Mousse chocolat blanc-Passion', 'Moyen', '3h', 4, '3 fruit de la passion, 100g de chocolat blanc, 15 cl de crème liquide, 50g de mascarpone, 1 feuille de gélatine, 12 framboises', 'Des petites mousses originale qui changeront de la fameuse mousse au chocolat', 2, 'img/berry-1853547_1280.jpg', 'img/DerouleRecetteMousse.png'),
(3, 'Pains au froments aux herbes', 'Facile', '2h30', 6, '25g de levure de boulanger, 400g de farine de froment, 3 C.s d\'huile d\'olive, 150g de fromage blanc, 1 gousse d\'ail, 1 bouquet de persil, 1 bouquet de ciboulette, 1 bouquet d\'aneth, 50g de beurre', 'Comment réaliser du pains original pour changer de la traditionnelle baguette', 1, 'img/bread-4957679_1280.jpg', 'img/DerouleRecettePains.png'),
(4, 'Velouté à la tomate', 'Facile', '45min', 6, '1kg de tomates mûres, 2 oignons, 1 gousse d\'ail, 30g de beurre, 4 C.s de fécule, du sucre semoule, 10 cl de crème fraîche épaisse, du cerfeuil frais,sel, poivre', 'Octueux et delicieux, ce velouté fera une entrée en même temps simple à réaliser et sophistiquée', 1, 'img/soup-1429793_1280.jpg', 'img/DerouleRecetteVeloute.png');

-- --------------------------------------------------------

--
-- Structure de la table `Reservations`
--

CREATE TABLE `Reservations` (
  `IdReservation` int(11) NOT NULL,
  `IdCommande` int(11) NOT NULL,
  `IdHoraire` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `role` varchar(60) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `role`, `username`, `password`) VALUES
(1, 'administrateur', 'admin', 'aa05e49df6220337e9002facc51d1dcf6bcaa4ec9c37cffc42a1ce140a150461');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Categorie`
--
ALTER TABLE `Categorie`
  ADD PRIMARY KEY (`idCategorie`);

--
-- Index pour la table `Clients`
--
ALTER TABLE `Clients`
  ADD PRIMARY KEY (`idClient`);

--
-- Index pour la table `Commande`
--
ALTER TABLE `Commande`
  ADD PRIMARY KEY (`IdCommande`),
  ADD KEY `idClient` (`idClient`);

--
-- Index pour la table `CommandeCredit`
--
ALTER TABLE `CommandeCredit`
  ADD PRIMARY KEY (`idCommande`),
  ADD KEY `idClient` (`idClient`);

--
-- Index pour la table `Cours`
--
ALTER TABLE `Cours`
  ADD PRIMARY KEY (`idCours`),
  ADD KEY `idCategorie` (`categorie`);

--
-- Index pour la table `Horaires`
--
ALTER TABLE `Horaires`
  ADD PRIMARY KEY (`idHoraire`),
  ADD KEY `idCours` (`idCours`);

--
-- Index pour la table `Recettes`
--
ALTER TABLE `Recettes`
  ADD PRIMARY KEY (`idRecette`),
  ADD KEY `categorie` (`categorie`);

--
-- Index pour la table `Reservations`
--
ALTER TABLE `Reservations`
  ADD PRIMARY KEY (`IdReservation`),
  ADD KEY `IdCommande` (`IdCommande`),
  ADD KEY `IdHoraire` (`IdHoraire`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Categorie`
--
ALTER TABLE `Categorie`
  MODIFY `idCategorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `Clients`
--
ALTER TABLE `Clients`
  MODIFY `idClient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `Commande`
--
ALTER TABLE `Commande`
  MODIFY `IdCommande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT pour la table `CommandeCredit`
--
ALTER TABLE `CommandeCredit`
  MODIFY `idCommande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `Cours`
--
ALTER TABLE `Cours`
  MODIFY `idCours` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `Horaires`
--
ALTER TABLE `Horaires`
  MODIFY `idHoraire` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `Recettes`
--
ALTER TABLE `Recettes`
  MODIFY `idRecette` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `Reservations`
--
ALTER TABLE `Reservations`
  MODIFY `IdReservation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Commande`
--
ALTER TABLE `Commande`
  ADD CONSTRAINT `Commande_ibfk_1` FOREIGN KEY (`idClient`) REFERENCES `Clients` (`idClient`);

--
-- Contraintes pour la table `CommandeCredit`
--
ALTER TABLE `CommandeCredit`
  ADD CONSTRAINT `CommandeCredit_ibfk_1` FOREIGN KEY (`idClient`) REFERENCES `Clients` (`idClient`);

--
-- Contraintes pour la table `Cours`
--
ALTER TABLE `Cours`
  ADD CONSTRAINT `idCategorie` FOREIGN KEY (`categorie`) REFERENCES `Categorie` (`idCategorie`);

--
-- Contraintes pour la table `Horaires`
--
ALTER TABLE `Horaires`
  ADD CONSTRAINT `idCours` FOREIGN KEY (`idCours`) REFERENCES `Cours` (`idCours`);

--
-- Contraintes pour la table `Recettes`
--
ALTER TABLE `Recettes`
  ADD CONSTRAINT `Recettes_ibfk_1` FOREIGN KEY (`categorie`) REFERENCES `Categorie` (`idCategorie`);

--
-- Contraintes pour la table `Reservations`
--
ALTER TABLE `Reservations`
  ADD CONSTRAINT `Reservations_ibfk_1` FOREIGN KEY (`IdCommande`) REFERENCES `Commande` (`IdCommande`),
  ADD CONSTRAINT `Reservations_ibfk_2` FOREIGN KEY (`IdHoraire`) REFERENCES `Horaires` (`idHoraire`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
