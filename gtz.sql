-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2017 at 08:12 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gtz`
--

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE `korisnici` (
  `ime` varchar(20) COLLATE utf8_slovenian_ci NOT NULL,
  `prezime` varchar(20) COLLATE utf8_slovenian_ci NOT NULL,
  `email` varchar(30) COLLATE utf8_slovenian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`ime`, `prezime`, `email`) VALUES
('', '0', '0'),
('Mirza', '0', '0'),
('hehe', '0', '0'),
('lasdkalsdk', '0', '0'),
('hehe', 'heheh', 'eda@gmail.com'),
('lasdkalsdk', 'lkdlsakdlsakslda', 'ldksaldkas@gmail.com'),
('d', 'ds', 'ds'),
('Miki', 'Maus', 'mikimaus@gmail.com'),
('Korisnik', 'Korisnikovic', 'k@gmail.com'),
('Korisnik', 'Korisnikovic', 'k@gmail.com'),
('Enes', 'Enesovic', 'enes@gmail.com'),
('Enes', 'Enesovic', 'enes@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `nepravilnosti`
--

CREATE TABLE `nepravilnosti` (
  `email` varchar(30) COLLATE utf8_slovenian_ci NOT NULL,
  `nepravilnost` varchar(100) COLLATE utf8_slovenian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pitanja`
--

CREATE TABLE `pitanja` (
  `ime` varchar(30) COLLATE utf8_slovenian_ci NOT NULL,
  `prezime` varchar(30) COLLATE utf8_slovenian_ci NOT NULL,
  `email` varchar(30) COLLATE utf8_slovenian_ci NOT NULL,
  `pitanje` varchar(1000) COLLATE utf8_slovenian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prijedlog`
--

CREATE TABLE `prijedlog` (
  `email` varchar(30) COLLATE utf8_slovenian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `nepravilnosti`
--
ALTER TABLE `nepravilnosti`
  ADD KEY `email` (`email`);

--
-- Indexes for table `pitanja`
--
ALTER TABLE `pitanja`
  ADD KEY `email` (`email`);

--
-- Indexes for table `prijedlog`
--
ALTER TABLE `prijedlog`
  ADD PRIMARY KEY (`email`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pitanja`
--
ALTER TABLE `pitanja`
  ADD CONSTRAINT `pitanje_fk` FOREIGN KEY (`email`) REFERENCES `nepravilnosti` (`email`);

--
-- Constraints for table `prijedlog`
--
ALTER TABLE `prijedlog`
  ADD CONSTRAINT `prijedlog_fk` FOREIGN KEY (`email`) REFERENCES `nepravilnosti` (`email`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
