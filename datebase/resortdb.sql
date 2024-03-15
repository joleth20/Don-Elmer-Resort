-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2024 at 09:11 AM
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
-- Database: `resortdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(100) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img` varchar(50) NOT NULL,
  `cpassword` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `verify_token` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `firstname`, `lastname`, `email`, `password`, `img`, `cpassword`, `role`, `verify_token`, `created_at`) VALUES
(2, 'lethskie', 'ayuson', 'ayuson@gmail.com', '$2y$10$DlaZ6sudRkVao0RWBN6T1.nfx0af6WBDAd9h8L9a6MFq2rbsxUkg2', 'profile.jpg', '$2y$10$585UJR2KGkqlwlBw.nH/uO16vZzfSUKa1R8SSxTmtU6FmYjzHpwS6', '', NULL, '2023-12-24 23:04:14'),
(3, 'Alex', 'Mendeja', 'lexf129@gmail.com', '$2y$10$ecWq6./vrnTU3A8CaT6X5.YYXP0m8dKVbjm2xn.nvUmvbNS9Jv3P2', '', '$2y$10$hfQy1vn3aGK7g.8ZqdICmeeid.94UtCr1ijsbopps3lGphF46AD.6', '', '5fe28b1dfc2103227350496d42feb455', '2024-01-08 22:42:38');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `seen` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `subject`, `message`, `seen`) VALUES
(13, 'joleth', 'ayuson@gmail.com', 'ayuson', 'ayuson', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(255) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `number` bigint(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `img` varchar(50) NOT NULL,
  `cpassword` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'Customer',
  `verify_token` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `firstname`, `lastname`, `number`, `email`, `password`, `img`, `cpassword`, `role`, `verify_token`, `created_at`) VALUES
(6, 'joleth', 'ayuson', 9482934981, 'ayuson@gmail.com', '$2y$10$ephIy9dXdjF4mvUB9uJTuOZZ3ew1zfUCHjnW1QqXuO0P1EB80C/6e', 'Profile picture for online class.jpg', '$2y$10$WnIDqy4qSzJ.hgI5rzjCieJAI7huBO8DstbqDa8O6wXDPOmdtJXJu', 'Customer', '845c3009f8a909f023076a2062139e3e', '2023-12-22 09:04:48'),
(7, 'joleth', 'ayuson', 93809380, 'joleth@gmail.com', '$2y$10$MuEbanMan0cbhAj4K/PaIuPz.UZWNvr.OyRjuvw7qrxTLyPVVBp6a', 'team-4.jpg', '$2y$10$Yq4ygwRd9Ga8rWrM2z5B6O3rnrpz5YzWfLlKZ5KE.ElPZT2TbCHzS', 'Customer', NULL, '2023-12-24 08:00:57'),
(8, 'Jared', 'Labrador', 989338, 'jared@gmail.com', '$2y$10$uNf/mE5q5LQCJhQBa7lMkO/E.DrTSTKrkittT/sdyKeH9001tEEj6', 'team-1.jpg', '$2y$10$vwyFrg/DsTAL8Ah4d..Lhek2Yi1R7MQfSI9VUcyXbeLpdAe8ogFXi', 'Customer', NULL, '2023-12-24 08:11:38'),
(9, 'beth', 'ayuson', 90383983, 'beth@gmail.com', '$2y$10$dCEb88CBuksQX3Ifri2oquQagYLdKoMEVHQ3EX8wQXA6YmM/UeH.y', 'team-3.jpg', '$2y$10$qXp5qbl..Ja2xiLVsYASUuh72jgU11hTkrJqF4tRgDat1.azy3NOK', 'Customer', NULL, '2023-12-24 11:45:29'),
(10, 'Alex', 'Mendeja', 9165404033, 'lexf129@gmail.com', '$2y$10$M.b6pou9wHjo1CuQHBx37OI/UVuUKcDwisOeUOCRjepVmQjDLxnkC', '', '$2y$10$M.b6pou9wHjo1CuQHBx37OI/UVuUKcDwisOeUOCRjepVmQjDLxnkC', 'Customer', '943b447158b4bb2286ba946abec5503e', '2024-01-08 13:11:39'),
(19, 'joleth', 'ayuson', 893734, 'ayuson.joleth.bsinfotech@gmail.com', '$2y$10$s2HaXQ/6bEfj/B9q9QUWEuip3lcEHvIHSr3lU2zJMQbqovaHJyg76', '', '$2y$10$s2HaXQ/6bEfj/B9q9QUWEuip3lcEHvIHSr3lU2zJMQbqovaHJyg76', 'Customer', 'a848e526aedf35e1655e0aeffa67eb88', '2024-01-11 07:30:38');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `reservation_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `number` bigint(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `DATE` date NOT NULL,
  `check_out_date` date NOT NULL,
  `num_guests` enum('One','Two','Three','Four','Five') NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'Pending',
  `paymentMethod` varchar(50) NOT NULL,
  `referenceNumber` int(11) NOT NULL,
  `imageProof` varchar(255) NOT NULL,
  `accommodationType` varchar(50) NOT NULL,
  `seen` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`reservation_id`, `name`, `number`, `user_id`, `DATE`, `check_out_date`, `num_guests`, `status`, `paymentMethod`, `referenceNumber`, `imageProof`, `accommodationType`, `seen`) VALUES
(449, 'joleth', 348387348, 6, '2024-01-11', '2024-01-12', 'Two', 'Approved', 'Cash', 32332, 'profile.jpg', 'Cottage 1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `resortcode`
--

CREATE TABLE `resortcode` (
  `code_id` int(100) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resortcode`
--

INSERT INTO `resortcode` (`code_id`, `code`, `added_at`) VALUES
(1, '$2y$10$bSHnobC1oFJvROwQeIKui.4jX7eUmm0jDoSApFZ4OYYTHXAK4TwTS', '2023-11-12 05:48:13'),
(2, 'DER-202312', '2023-11-12 08:31:41');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `available_slots` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblexpense`
--

CREATE TABLE `tblexpense` (
  `ID` int(10) NOT NULL,
  `ExpenseDate` date DEFAULT NULL,
  `ExpenseItem` varchar(200) DEFAULT NULL,
  `ExpenseCost` varchar(200) DEFAULT NULL,
  `NoteDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblexpense`
--

INSERT INTO `tblexpense` (`ID`, `ExpenseDate`, `ExpenseItem`, `ExpenseCost`, `NoteDate`) VALUES
(4, '2023-12-24', 'Electricity', '2000', '2023-12-21 16:07:12'),
(5, '2023-12-23', 'Maintenace and repairs', '6000', '2023-12-21 16:07:27'),
(6, '2023-12-25', 'Property Taxes', '100000', '2023-12-21 16:07:37'),
(7, '2023-12-23', 'Maintenace and repairs', '4000', '2023-12-21 16:07:51'),
(8, '2023-12-25', 'Maintenace and repairs', '9000', '2023-12-21 16:08:07'),
(9, '2023-12-23', 'Gas', '9000', '2023-12-21 16:08:25'),
(10, '2023-12-25', 'Water Bill', '9000', '2023-12-21 16:08:42');

-- --------------------------------------------------------

--
-- Table structure for table `tblincome`
--

CREATE TABLE `tblincome` (
  `id_income` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `account` varchar(255) NOT NULL,
  `amount` int(255) NOT NULL,
  `date_income` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblincome`
--

INSERT INTO `tblincome` (`id_income`, `name`, `account`, `amount`, `date_income`) VALUES
(6, 'joleth', 'GCash', 8000, '2024-01-11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reservation_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `resortcode`
--
ALTER TABLE `resortcode`
  ADD PRIMARY KEY (`code_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblexpense`
--
ALTER TABLE `tblexpense`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblincome`
--
ALTER TABLE `tblincome`
  ADD PRIMARY KEY (`id_income`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=450;

--
-- AUTO_INCREMENT for table `resortcode`
--
ALTER TABLE `resortcode`
  MODIFY `code_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblexpense`
--
ALTER TABLE `tblexpense`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tblincome`
--
ALTER TABLE `tblincome`
  MODIFY `id_income` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
