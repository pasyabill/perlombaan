-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 15, 2024 at 12:18 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pitulasan`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_lomba`
--

DROP TABLE IF EXISTS `data_lomba`;
CREATE TABLE IF NOT EXISTS `data_lomba` (
  `id_data_lomba` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `id_lomba` int NOT NULL,
  `status` enum('menang','kalah','belum') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'belum',
  PRIMARY KEY (`id_data_lomba`),
  KEY `id_user` (`id_user`),
  KEY `id_lomba` (`id_lomba`)
) ENGINE=MyISAM AUTO_INCREMENT=112 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_lomba`
--

INSERT INTO `data_lomba` (`id_data_lomba`, `id_user`, `id_lomba`, `status`) VALUES
(109, 14, 3, 'menang'),
(111, 14, 6, 'belum'),
(110, 14, 4, 'belum'),
(108, 14, 2, 'menang'),
(106, 14, 1, 'kalah'),
(105, 14, 5, 'menang');

-- --------------------------------------------------------

--
-- Table structure for table `lomba`
--

DROP TABLE IF EXISTS `lomba`;
CREATE TABLE IF NOT EXISTS `lomba` (
  `id_lomba` int NOT NULL AUTO_INCREMENT,
  `nama_lomba` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `kategori` enum('anak','remaja','dewasa') COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_lomba`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lomba`
--

INSERT INTO `lomba` (`id_lomba`, `nama_lomba`, `kategori`) VALUES
(1, 'Makan Kerupuk', 'anak'),
(2, 'Eggrang', 'remaja'),
(3, 'Tarik Tambang', 'dewasa'),
(4, 'Pensil Dalam Botol', 'anak'),
(5, 'Balap Karung', 'remaja'),
(6, 'Panjat Pinang', 'dewasa');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `nama_user` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('admin','peserta') COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `password`, `role`) VALUES
(1, 'cel', '$2y$10$OfOJjPNeSR.Nqln8AB8yxOVULVtJL4FdgI3AyrS7TdV', 'peserta'),
(2, 'cel', '$2y$10$sCp9wkzXSZpugsDSfSZFZ.b46Ro8yxI5P94rifEH31L', 'peserta'),
(3, 'yum', '$2y$10$wjvcSceAa6A9H4jR4ZwZA./VxtcMk2I2agfEIouFGdv', 'peserta'),
(4, 'rasti', '$2y$10$mH0xiAAgckv.EtmAvN45ceIc/xd7Opl2E4Q/zxohXPQ', 'peserta'),
(5, 'rasti', '$2y$10$ZNl6jbMZKoukku7MkHmJRe6XstRXSTqpd0/7VqVg.7/', 'peserta'),
(6, 'eka', '$2y$10$VsbC4lXIA7URb2ynXCLck.St/PtgJv9cuimBT2z1Y.T', 'admin'),
(7, 'zara', '$2y$10$h9EMDN72O4ruNkhAmu2FLejTkuE9pRddSRs.Pz2Xajv', 'peserta'),
(8, 'yumek', '$2y$10$Qdx.LH5lqRc7XL7p5LOHNeTBs7LBcfYE7GwgaodztIM', 'peserta'),
(9, 'slamet', '$2y$10$LiE0acyUahNdrWXNp72jr.1YlztSBm7gusjRCCAqwBN', 'peserta'),
(10, 'ekafa', '$2y$10$Gu/g0N8RMVzG5ShpQvOXL.0vAU/YcMJDA2BYsGyFiNA63OfMYQyLK', 'peserta'),
(11, 'tutik', '$2y$10$Ynr9jyBWSzVdyWHtjhf4GukO9je5/nuQcec/gUwqZiTRYfqrbmR/.', 'peserta'),
(12, 'aaa', '$2y$10$foUABTuoD0Rdca/ruzBokuTrtJoNqLxrzy9/.s6T7Cxi8NATwYUWO', 'admin'),
(13, 'aws', '$2y$10$A69WltQXyE2eKzFSt3BpdOFV.4en1b.c/34RVTo.3lfEBoLok3tU2', 'peserta'),
(14, 'aspasya', '$2y$10$AtbRdo5fzJb8l1UmV6jUUuKiNOR0bzjCAFggLn0QOJKBn0Kbp/rWm', 'peserta'),
(15, 'clo', '$2y$10$N56YIzx9v8k8pTq3ucFtuec4pqXPKc3.y0UcA2bYX39jQSYkgvsrO', 'admin'),
(16, 'aa', '$2y$10$bPEqHI8i5RiK2IBuv81v.O91btr77hiOi3Cp10/hNhZQScRIqG3oe', 'peserta'),
(17, 'mala', '$2y$10$OD7F4Yu71RUakE9TFwUB0.tMQXcRROCT8twX5QR5tOcBO8iAjW8TO', 'peserta'),
(18, 'RizzMala', '$2y$10$iNidpafRk2ILo1xv2AxjlOM52amrLEdb8mgrYzoeaxpBx1YQxMY4W', 'admin'),
(19, 'cello', '$2y$10$/Ckd2zWNNeUyeAWmgfNE6.EhmOPGTTZFr4vR.dGBKXy9nZMwRGj/u', 'peserta'),
(20, 'Aspasya Salsabila', '$2y$10$8VqRhbZqmlfRYHVzZK18VOXXYU2nt6zuBPWq61rrx/NBQU/PIdEK6', 'peserta'),
(21, 'salsabila', '$2y$10$LlAPtvSWcPXIFKqACKOOe.Pyek3eEK/N6HK8JGE2Lf00nv2l6p/US', 'admin');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
