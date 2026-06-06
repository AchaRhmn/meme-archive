-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 06, 2026 at 12:06 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `meme-archive`
--

-- --------------------------------------------------------

--
-- Table structure for table `meme`
--

CREATE TABLE `meme` (
  `judul` varchar(255) NOT NULL,
  `desk` longtext NOT NULL,
  `pic` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `ID_user` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `meme`
--

INSERT INTO `meme` (`judul`, `desk`, `pic`, `url`, `ID_user`) VALUES
('aaa', 'qty', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQv33VKsyOdDMLYSTFiMi_DFafJpJ7k-9yLKA&s', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQv33VKsyOdDMLYSTFiMi_DFafJpJ7k-9yLKA&s', 3),
('hm', 'fggvdgza', 'https://www.petanikode.com/img/c/enum/cara-membuat-enum.webp', 'https://www.petanikode.com/img/c/enum/cara-membuat-enum.webp', 3),
('ada2', 'sdaswdaws', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSyIBz3vzZszHE4dyblJPNsADwQTCdWPTgTRg&s', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSyIBz3vzZszHE4dyblJPNsADwQTCdWPTgTRg&s', 3),
('ramaaaaaaaa', 'qwertync drfhbnfrdyh', 'https://images.unsplash.com/photo-1518070588484-2b53926cba76?fm=jpg&q=60&w=3000&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8Z3VudW5nfGVufDB8fDB8fHww', 'https://images.unsplash.com/photo-1518070588484-2b53926cba76?fm=jpg&q=60&w=3000&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8Z3VudW5nfGVufDB8fDB8fHww', 4);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID_user` int NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID_user`, `nama`, `email`, `pass`) VALUES
(1, 'qwerty', '', '$2y$10$.JrS3keDtFVjtbP7UBxwReWdZwoQuEEdVuQ1Tf/rhW1oYKCNtXWA.'),
(2, 'aaa', '', '$2y$10$B3fnUDCyZSgO9goDRm.1Xuv7zn86ajbqOms9YwuocNmOn9YDQrBDO'),
(3, 'aaa', 'acharhmn@gmail.com', '$2y$10$tSATPsBlRjd59vSdKdUCTOJ7r6ivZrorCZ8oh8a4YV/FuRpwCp2Zm'),
(4, 'rama', 'rama12@gmail.com', '$2y$10$u.q2yuqhVeu64xnI8BjZDebDaEn5YVLb1aIGjIL26AJ8dseyd1Jpi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `meme`
--
ALTER TABLE `meme`
  ADD KEY `ID_user` (`ID_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `meme`
--
ALTER TABLE `meme`
  ADD CONSTRAINT `meme_ibfk_1` FOREIGN KEY (`ID_user`) REFERENCES `user` (`ID_user`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
