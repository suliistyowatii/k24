-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 23, 2021 at 01:46 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `akg_bep`
--

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `id` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `admin` int(1) NOT NULL,
  `member` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`id`, `username`, `admin`, `member`) VALUES
(1, 'Administrator', 1, 0),
(10, 'member@mail.com', 0, 1),
(11, 'coba@gmail.com', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(15) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `no_hp` varchar(10) NOT NULL,
  `born_date` date NOT NULL,
  `jenis_k` varchar(1) NOT NULL,
  `password` varchar(15) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `nama`, `no_hp`, `born_date`, `jenis_k`, `password`, `nik`, `created_at`, `updated_at`, `foto`) VALUES
('Administrator', '', '', '0000-00-00', '', '12345678', '', '2016-07-13 16:57:28', '2021-10-22 14:01:23', ''),
('coba@gmail.com', 'membercoba', '21414', '2021-10-12', 'P', '12345678', '12132', '2021-10-22 23:09:11', '2021-10-22 23:09:11', '7518bbdb1f874e48cd637b5bf407dbe7.png'),
('member@mail.com', 'sendiri', '3106767', '2021-10-10', 'L', 'password', '21313', '2021-10-22 21:12:47', '2021-10-22 23:02:13', 'img.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
