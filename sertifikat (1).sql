-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2024 at 11:15 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sertifikat`
--

-- --------------------------------------------------------

--
-- Table structure for table `hardskill_softskill`
--

CREATE TABLE `hardskill_softskill` (
  `id` int(11) NOT NULL,
  `kegiatan` varchar(128) NOT NULL,
  `program` varchar(128) NOT NULL,
  `tanggal` date NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hardskill_softskill`
--

INSERT INTO `hardskill_softskill` (`id`, `kegiatan`, `program`, `tanggal`, `file`, `user_id`) VALUES
(1, 'tes', 'Excel', '2024-06-11', 'Azure_AI_Fundamentals1.pdf', 8),
(2, 'Microsoft Office Specialist', 'Excel', '2024-06-04', 'grace_excel_161.pdf', 9),
(3, 'Microsoft Office Specialist 2019', 'Excel', '2024-06-16', 'Excel_2019_Associate.pdf', 8),
(4, 'Microsoft Office Specialist 2019', 'Excel', '2024-06-29', 'Excel_2019_Associate2.pdf', 8),
(5, 'Microsoft Office Specialist 2019', 'Word', '2024-06-30', NULL, 0),
(6, 'Microsoft Office Specialist 2019', 'Word', '2024-07-01', NULL, 0),
(7, 'Microsoft Office Specialist 2019', 'Word', '2024-07-01', NULL, 0),
(8, 'Microsoft Office Specialist 2019', 'Word', '2024-07-01', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `seminar`
--

CREATE TABLE `seminar` (
  `id` int(11) NOT NULL,
  `kegiatan` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `seminar`
--

INSERT INTO `seminar` (`id`, `kegiatan`, `tanggal`, `kategori`, `file`, `user_id`) VALUES
(1, 'Webinar Nasional “Nasib Energi Baru Terbarukan Jika Omnibus Law Ciptaker Disahkan”', '2024-06-26', 'Nasional', 'Webinar_Nasional17.pdf', 9),
(2, 'Webinar Sharing Session Series 5 “Potensi dan Pengembangan Teknologi Energi Baru Terbarukan”', '2020-11-13', 'Wilayah', 'Webinar_Sharing7.pdf', 9),
(4, 'testing', '2024-06-25', 'Nasional', 'Azure_AI_Fundamentals.pdf', 8),
(11, 'testing', '2024-06-29', 'Nasional', 'Webinar_Sharing11.pdf', 8),
(12, 'Microsoft Office Specialist 2019', '2024-06-30', 'Nasional', 'SERTIF_LDKM_HIMAKA_GRACE.pdf', 0),
(16, 'Webinar Sharing Session Series 5 “Potensi dan Pengembangan Teknologi Energi Baru Terbarukan”', '2024-07-01', 'Nasional', NULL, 0),
(49, 'Webinar Sharing Session Series 5 “Potensi dan Pengembangan Teknologi Energi Baru Terbarukan”', '2024-07-02', 'Wilayah', NULL, 8),
(50, 'Webinar Sharing Session Series 5 “Potensi dan Pengembangan Teknologi Energi Baru Terbarukan”', '2024-07-02', 'Wilayah', NULL, 8),
(51, 'tesasda', '2024-08-02', 'Nasional', NULL, 8),
(52, '123124', '2024-07-03', 'Nasional', NULL, 8);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(8, 'Grace Augustin', 'iges16@gmail.com', 'default.jpg', '$2y$10$Fmz8Ui4mz7dEdP9RoCXR3OQvmkkKzG8eiLwZ9kkGCcLl9gZLkKbn2', 2, 1, '2024-07-01'),
(9, 'Grace Augustin Sinaga', 'graceaugustin64@gmail.com', 'default2.jpg', '$2y$10$/aCWb8gu39wauvGD1MaIxezQsjiq7HenmYBTsrkfCD65V8abN6oT.', 2, 1, '2024-07-02'),
(10, 'Grace Augustin Sinaga', 'graceaugustin64@yahoo.com', 'default.jpg', '$2y$10$tzZ1bNNxQknomqNrdpMePuAnbQ67Jj.3tyfgAt5Ets56stHUarMDW', 2, 1, '0000-00-00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hardskill_softskill`
--
ALTER TABLE `hardskill_softskill`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seminar`
--
ALTER TABLE `seminar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hardskill_softskill`
--
ALTER TABLE `hardskill_softskill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `seminar`
--
ALTER TABLE `seminar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
