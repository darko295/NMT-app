-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2019 at 12:29 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nmt_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `blagajnik`
--

CREATE TABLE `blagajnik` (
  `ZaposleniID` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

-- --------------------------------------------------------

--
-- Table structure for table `nacinplacanja`
--

CREATE TABLE `nacinplacanja` (
  `NacinPlacanjaID` int(100) NOT NULL,
  `Naziv` varchar(50) COLLATE utf16_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Dumping data for table `nacinplacanja`
--

INSERT INTO `nacinplacanja` (`NacinPlacanjaID`, `Naziv`) VALUES
(1, 'Cash'),
(2, 'Card');

-- --------------------------------------------------------

--
-- Table structure for table `prodavac`
--

CREATE TABLE `prodavac` (
  `ZaposleniID` int(100) NOT NULL,
  `Username` varchar(30) COLLATE utf16_bin NOT NULL,
  `Password` varchar(30) COLLATE utf16_bin NOT NULL,
  `Active` int(1) NOT NULL,
  `ProdavnicaID` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Dumping data for table `prodavac`
--

INSERT INTO `prodavac` (`ZaposleniID`, `Username`, `Password`, `Active`, `ProdavnicaID`) VALUES
(1, 'pera123', 'pera123', 1, 1),
(2, 'mika', 'mika000', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `prodavnica`
--

CREATE TABLE `prodavnica` (
  `ProdavnicaID` int(100) NOT NULL,
  `Naziv` varchar(50) COLLATE utf16_bin NOT NULL,
  `Adresa` varchar(50) COLLATE utf16_bin NOT NULL,
  `Mesto` varchar(30) COLLATE utf16_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Dumping data for table `prodavnica`
--

INSERT INTO `prodavnica` (`ProdavnicaID`, `Naziv`, `Adresa`, `Mesto`) VALUES
(1, 'NMT 1', 'Spanskih boraca 23', 'Beograd');

-- --------------------------------------------------------

--
-- Table structure for table `proizvod`
--

CREATE TABLE `proizvod` (
  `ProizvodID` int(100) NOT NULL,
  `Naziv` varchar(50) COLLATE utf16_bin NOT NULL,
  `Cena` int(10) NOT NULL,
  `VrstaProizvodaID` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Dumping data for table `proizvod`
--

INSERT INTO `proizvod` (`ProizvodID`, `Naziv`, `Cena`, `VrstaProizvodaID`) VALUES
(1, 'milka sa lesnicima 80g', 89, 1),
(2, 'milka sa jagodom 80g', 111, 1),
(3, 'next 100% orange', 149, 2),
(4, 'nektar breskva 1l', 129, 2),
(5, 'nektar kajsija 1l', 134, 2),
(6, 'rumenko', 50, 4),
(7, 'plazma slana 200g', 155, 3),
(8, 'plazma 200g', 140, 3),
(9, 'welness lesnik 180g', 110, 3);

-- --------------------------------------------------------

--
-- Table structure for table `racun`
--

CREATE TABLE `racun` (
  `RacunID` int(100) NOT NULL,
  `UkupanIznos` decimal(50,0) NOT NULL,
  `DatumKreiranja` datetime NOT NULL,
  `PoslednjeAzuriranje` datetime DEFAULT NULL,
  `Storniran` tinyint(1) NOT NULL DEFAULT 0,
  `ZaposleniID` int(100) NOT NULL,
  `NacinPlacanjaID` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Dumping data for table `racun`
--

INSERT INTO `racun` (`RacunID`, `UkupanIznos`, `DatumKreiranja`, `PoslednjeAzuriranje`, `Storniran`, `ZaposleniID`, `NacinPlacanjaID`) VALUES
(25, '267', '2019-07-09 22:45:06', '2019-07-13 15:49:20', 0, 1, 1),
(26, '110', '2019-07-09 22:46:52', NULL, 0, 1, 1),
(29, '267', '2019-07-09 23:24:17', '2019-07-13 14:58:26', 1, 2, 1),
(32, '258', '2019-07-10 21:45:56', '2019-07-13 14:56:55', 1, 1, 1),
(34, '1068', '2019-07-13 12:32:21', NULL, 0, 1, 1),
(35, '757', '2019-07-13 12:32:57', '2019-07-13 15:01:06', 0, 1, 1),
(36, '473', '2019-07-13 14:48:38', '2019-07-13 16:16:34', 1, 1, 2),
(37, '694', '2019-07-14 23:43:36', NULL, 0, 1, 1),
(38, '888', '2019-07-15 00:14:28', NULL, 0, 1, 2),
(39, '387', '2019-07-15 00:18:32', '2019-07-15 00:25:31', 1, 1, 1),
(40, '555', '2019-07-15 00:19:20', NULL, 0, 1, 1),
(41, '462', '2019-07-15 00:21:22', NULL, 0, 1, 1),
(42, '333', '2019-07-15 00:22:16', NULL, 0, 1, 1),
(43, '3515', '2019-07-15 00:22:51', '2019-07-15 00:24:48', 0, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `stavkaracuna`
--

CREATE TABLE `stavkaracuna` (
  `RacunID` int(100) NOT NULL,
  `RBStavke` int(100) NOT NULL,
  `Kolicina` int(50) NOT NULL,
  `Iznos` decimal(50,0) NOT NULL,
  `ProizvodID` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Dumping data for table `stavkaracuna`
--

INSERT INTO `stavkaracuna` (`RacunID`, `RBStavke`, `Kolicina`, `Iznos`, `ProizvodID`) VALUES
(25, 1, 3, '267', 1),
(26, 1, 1, '110', 2),
(29, 1, 3, '267', 1),
(32, 1, 2, '258', 4),
(34, 1, 12, '1068', 1),
(35, 1, 2, '298', 3),
(35, 2, 1, '149', 3),
(35, 5, 2, '310', 7),
(36, 1, 3, '333', 2),
(36, 2, 1, '140', 8),
(37, 1, 4, '516', 4),
(37, 3, 2, '178', 1),
(38, 1, 3, '333', 2),
(38, 2, 3, '333', 2),
(38, 3, 2, '222', 2),
(39, 1, 2, '258', 4),
(39, 2, 1, '129', 4),
(40, 1, 2, '222', 2),
(40, 2, 3, '333', 2),
(41, 1, 1, '129', 4),
(41, 2, 3, '333', 2),
(42, 1, 3, '333', 2),
(43, 1, 3, '447', 3),
(43, 2, 2, '258', 4),
(43, 4, 1, '134', 5),
(43, 5, 4, '620', 7),
(43, 6, 4, '516', 4),
(43, 7, 11, '1540', 8);

-- --------------------------------------------------------

--
-- Table structure for table `vrstaproizvoda`
--

CREATE TABLE `vrstaproizvoda` (
  `VrstaProizvodaID` int(100) NOT NULL,
  `Naziv` varchar(50) COLLATE utf16_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Dumping data for table `vrstaproizvoda`
--

INSERT INTO `vrstaproizvoda` (`VrstaProizvodaID`, `Naziv`) VALUES
(1, 'Cokolada'),
(2, 'Sok'),
(3, 'Keks'),
(4, 'Sladoled');

-- --------------------------------------------------------

--
-- Table structure for table `zaposleni`
--

CREATE TABLE `zaposleni` (
  `ZaposleniID` int(100) NOT NULL,
  `ImePrezime` varchar(50) COLLATE utf16_bin NOT NULL,
  `Telefon` varchar(20) COLLATE utf16_bin NOT NULL,
  `Email` varchar(30) COLLATE utf16_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Dumping data for table `zaposleni`
--

INSERT INTO `zaposleni` (`ZaposleniID`, `ImePrezime`, `Telefon`, `Email`) VALUES
(1, 'Pera Peric', '0655468844', 'pera@nmt.rs'),
(2, 'Mika Jovanovic', '0646458844', 'mika@nmt.rs');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blagajnik`
--
ALTER TABLE `blagajnik`
  ADD PRIMARY KEY (`ZaposleniID`);

--
-- Indexes for table `nacinplacanja`
--
ALTER TABLE `nacinplacanja`
  ADD PRIMARY KEY (`NacinPlacanjaID`);

--
-- Indexes for table `prodavac`
--
ALTER TABLE `prodavac`
  ADD PRIMARY KEY (`ZaposleniID`),
  ADD KEY `prodavac_prodavnica_fk` (`ProdavnicaID`);

--
-- Indexes for table `prodavnica`
--
ALTER TABLE `prodavnica`
  ADD PRIMARY KEY (`ProdavnicaID`);

--
-- Indexes for table `proizvod`
--
ALTER TABLE `proizvod`
  ADD PRIMARY KEY (`ProizvodID`),
  ADD KEY `proizvod_vrsta_proizvoda_fk` (`VrstaProizvodaID`);

--
-- Indexes for table `racun`
--
ALTER TABLE `racun`
  ADD PRIMARY KEY (`RacunID`),
  ADD KEY `racun_zaposleni_fk` (`ZaposleniID`),
  ADD KEY `racun_nacinplacanja_fk` (`NacinPlacanjaID`);

--
-- Indexes for table `stavkaracuna`
--
ALTER TABLE `stavkaracuna`
  ADD PRIMARY KEY (`RacunID`,`RBStavke`),
  ADD KEY `stavka_proizvod_fk` (`ProizvodID`);

--
-- Indexes for table `vrstaproizvoda`
--
ALTER TABLE `vrstaproizvoda`
  ADD PRIMARY KEY (`VrstaProizvodaID`);

--
-- Indexes for table `zaposleni`
--
ALTER TABLE `zaposleni`
  ADD PRIMARY KEY (`ZaposleniID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `nacinplacanja`
--
ALTER TABLE `nacinplacanja`
  MODIFY `NacinPlacanjaID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `prodavnica`
--
ALTER TABLE `prodavnica`
  MODIFY `ProdavnicaID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `proizvod`
--
ALTER TABLE `proizvod`
  MODIFY `ProizvodID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `racun`
--
ALTER TABLE `racun`
  MODIFY `RacunID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `vrstaproizvoda`
--
ALTER TABLE `vrstaproizvoda`
  MODIFY `VrstaProizvodaID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `zaposleni`
--
ALTER TABLE `zaposleni`
  MODIFY `ZaposleniID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blagajnik`
--
ALTER TABLE `blagajnik`
  ADD CONSTRAINT `blagajnik_ibfk_1` FOREIGN KEY (`ZaposleniID`) REFERENCES `zaposleni` (`ZaposleniID`);

--
-- Constraints for table `prodavac`
--
ALTER TABLE `prodavac`
  ADD CONSTRAINT `prodavac_ibfk_1` FOREIGN KEY (`ZaposleniID`) REFERENCES `zaposleni` (`ZaposleniID`),
  ADD CONSTRAINT `prodavac_prodavnica_fk` FOREIGN KEY (`ProdavnicaID`) REFERENCES `prodavnica` (`ProdavnicaID`);

--
-- Constraints for table `proizvod`
--
ALTER TABLE `proizvod`
  ADD CONSTRAINT `proizvod_vrsta_proizvoda_fk` FOREIGN KEY (`VrstaProizvodaID`) REFERENCES `vrstaproizvoda` (`VrstaProizvodaID`) ON UPDATE CASCADE;

--
-- Constraints for table `racun`
--
ALTER TABLE `racun`
  ADD CONSTRAINT `racun_nacinplacanja_fk` FOREIGN KEY (`NacinPlacanjaID`) REFERENCES `nacinplacanja` (`NacinPlacanjaID`),
  ADD CONSTRAINT `racun_zaposleni_fk` FOREIGN KEY (`ZaposleniID`) REFERENCES `zaposleni` (`ZaposleniID`);

--
-- Constraints for table `stavkaracuna`
--
ALTER TABLE `stavkaracuna`
  ADD CONSTRAINT `stavka_proizvod_fk` FOREIGN KEY (`ProizvodID`) REFERENCES `proizvod` (`ProizvodID`),
  ADD CONSTRAINT `stavkaracuna_ibfk_1` FOREIGN KEY (`RacunID`) REFERENCES `racun` (`RacunID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
